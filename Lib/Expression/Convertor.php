<?php
/**
 * Expression convertor
 *
 * $Rev$
 * $LastChangedBy$
 * $LastChangedDate$
 *
 * @category   : Math Algorithms
 * @package    : Expression
 * @subpackage :
 * @copyright  : Copyright (C) 2012, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $Id$
 */

class Expression_Convertor
{
    private static $_convertor = NULL;

    private function __construct()
    {
    }

    /**
     * Expression Convertor singleton
     *
     * @return Expression_Convertor
     */
    public static function getInstance()
    {
        if (is_null(self::$_convertor)) {
            self::$_convertor = new Expression_Convertor();
        }

        return self::$_convertor;
    }

    /**
     * Verify character is operator
     * Operators are +, -, *, /
     *
     * @param  string  $chr
     * @return boolean
     */
    private function _isOperator ($chr)
    {
        return (0 + preg_match ('/^[\+\-\*\/]/', $chr) > 0);
    }

    /**
     * Verify character is digit 0-9
     *
     * @param  string  $chr
     * @return boolean
     */
    private function _isDigit ($chr)
    {
        return (0 + preg_match ('/^[0-9]/', $chr) > 0);
    }

    /**
     * Verify character is space, tab, end of line
     *
     * @param  string  $chr
     * @return boolean
     */
    private function _isSpace ($chr)
    {
        return (0 + preg_match ('/^[\s]/', $chr) > 0);
    }

    /**
     * Calculate operator priority
     * Operators are +, -, *, /
     *
     * @param  string $chr
     * @return number
     */
    private function _priority($chr)
    {
        $pri = 0;
        if ($chr === '*' || $chr === '/' || $chr === '%') {
            $pri = 2;
        }

        if ($chr === '+' || $chr === '-') {
            $pri = 1;
        }

        return $pri;
    }

    /**
     * Convert expression in infix format to postfix format
     *
     * @param  string $strInfix
     * @return string
     */
    public function strInfixToStrPostfix($strInfix)
    {
        $stack = array();
        $stackPostfix = array();
        $charInfix = NULL;
        if (strlen($strInfix) === 0) {
            return '';
        }

        $i = 0;
        while ($i < strlen($strInfix)) {
            $charInfix = $strInfix[$i];
            if ($this->_isSpace($charInfix)) {
                $i++;
                continue;
            }

            if ($this->_isDigit($charInfix)) {
                $number = 0 + $charInfix;
                while (true) {
                    $i++;
                    if (isset($strInfix[$i])) {
                        if ($this->_isDigit($charInfix = $strInfix[$i])) {
                            $number = 10 * $number + $charInfix;
                        } else {
                            if (!$this->_isSpace($charInfix)) {
                                break;
                            }
                        }
                    } else {
                        break;
                    }
                }
                array_push ($stackPostfix, $number);
            }

            if ($this->_isOperator($charInfix)) {
                if (empty($stack)) {
                    array_push($stack, $charInfix);
                } else {
                    $charTopStack = array_pop($stack);
                    while ($this->_priority($charTopStack) >= $this->_priority($charInfix)) {
                        array_push ($stackPostfix, $charTopStack);
                        $charTopStack = array_pop($stack);
                    }

                    if (!is_null($charTopStack)) {
                        array_push($stack, $charTopStack);
                    }
                    array_push($stack, $charInfix);
                }
                $i++;
                continue;
            }

            if ($charInfix === '(') {
                array_push ($stack, $charInfix);
                $i++;
                continue;
            }

            if ($charInfix === ')') {
                $charInfix = array_pop($stack);

                $iterationsParantesis = 0;
                while ($charInfix !== '(') {
                    array_push ($stackPostfix, $charInfix);
                    $charInfix = array_pop($stack);
                }
                $i++;
            }
        }

        while (!empty($stack)) {
            $charInfix = array_shift($stack);
            array_push ($stackPostfix, $charInfix);
        }

        return implode (' ', $stackPostfix);
    }

     /**
     * Convert expression in postfix string format to postfix stack format
     *
     * @param  string $strInfix
     * @return array  stack
     */
    public function strPostfixToStackPostfix($strPostfix)
    {
        $stackPostfix = array();
        $charPostfix = NULL;
        if (strlen($strPostfix) === 0) {
            return '';
        }

        $i = 0;
        while ($i < strlen($strPostfix)) {
            $charPostfix = $strPostfix[$i];
            if ($this->_isSpace($charPostfix)) {
                $i++;
                continue;
            }

            if ($this->_isDigit($charPostfix)) {
                $number = 0 + $charPostfix;
                while (true) {
                    $i++;
                    if (isset($strPostfix[$i])) {
                        if ($this->_isDigit($charPostfix = $strPostfix[$i])) {
                            $number = 10 * $number + $charPostfix;

                            break;
                        } else {
                            break;
                        }
                    } else {
                        break;
                    }
                }
                array_push ($stackPostfix, $number);
                $i++;
                continue;
            }

            if ($this->_isOperator($charPostfix)) {
                array_push($stackPostfix, $charPostfix);
                $i++;
                continue;
            }

            throw new ExpressionException ('Unknown character #'.$charPostfix.'#');
        }

        return $stackPostfix;
    }

    /**
     * Convert expression in psotfix stack format to expression tree
     *
     * @param  string          $stackPostfix
     * @return Expression_Tree
     */
    public function stackPostfixToExpressionTree($stackPostfix)
    {
        $result = NULL;
        $stackEvaluate = array();
        while (!empty($stackPostfix)) {
            $element = array_shift($stackPostfix);
            if ($this->_isOperator($element)) {
                $nodeOperand1 = array_pop($stackEvaluate);
                $nodeOperand2 = array_pop($stackEvaluate);

                $node = new Expression_TreeNode();
                $node->setOperator($element);
                $node->setLeftNode($nodeOperand1);
                $node->setRightNode($nodeOperand2);
                array_push($stackEvaluate, $node);
            } else {
                $node = new Expression_TreeNode();
                $node->setOperand($element);
                array_push($stackEvaluate, $node);
            }
        }

        $expressionTree = new Expression_Tree();
        if (!empty($stackEvaluate)) {
           $expressionTree->setRoot(array_pop($stackEvaluate));
        }

        return $expressionTree;
    }

    /**
     * Convert expression in infix string format to expression tree
     *
     * @param  string $strInfix
     * @return tree
     */
    public function strInfixToExpressionTree($strInfix)
    {
        $strPostfix = $this->strInfixToStrPostfix($strInfix);
        $stackPostfix = $this->strPostfixToStackPostfix($strPostfix);
        $tree = $this->stackPostfixToExpressionTree($stackPostfix);

        return $tree;
    }

    /**
     * Convert expression tree to postfix string expression
     *
     * @param  Expression_Tree $tree
     * @return int
     */
    public function expressionTreeToStrPostfix (Expression_Tree $tree)
    {
        return $this->_expressionTreeToStrPostfixDsr($tree->getRoot());
    }

    /**
     * Calculate postfix string expression
     * The tree is covered going in the order right, left, root
     *
     * @param  Expression_TreeNode $node
     * @return string
     */
    private function _expressionTreeToStrPostfixDsr (Expression_TreeNode $node)
    {
        if ($node !== NULL) {
            $nodeLeft = $node->getLeftNode();
            $nodeRight = $node->getRightNode();
            if ($nodeLeft !== NULL && $nodeRight !== NULL) {
                return $this->_expressionTreeToStrPostfixDsr($nodeRight).' '.$this->_expressionTreeToStrPostfixDsr($nodeLeft).' '.$node->toString();
            } else {
                return  $node->getOperand();
            }
        } else {
            return '';
        }
    }
}
