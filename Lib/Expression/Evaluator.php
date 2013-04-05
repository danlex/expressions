<?php
/**
 * Expression evaluator
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

class Expression_Evaluator
{
    private static $_convertor = NULL;
    private static $_evaluator = NULL;

    private function __construct()
    {
        $this->_convertor = Expression_Convertor::getInstance();
    }

    /**
     * Expression Evaluator singleton
     *
     * @return Expression_Evaluator
     */
    public static function getInstance()
    {
        if (is_null(self::$_evaluator)) {
            self::$_evaluator = new Expression_Evaluator();
        }

        return self::$_evaluator;
    }

    public function getConvertor()
    {
        return $this->_convertor;
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
     * Evaluate postfix stack
     *
     * @param  string $stackPostfix
     * @return number
     */
    public function evaluateStackPostfix($stackPostfix)
    {
        $result = NULL;
        $stackEvaluate = array();
        while (!empty($stackPostfix)) {
            $element = array_shift($stackPostfix);
            if (!$this->_isOperator($element)) {
                array_push($stackEvaluate, $element);
            } else {
                $operand1 = array_pop($stackEvaluate);
                $operand2 = array_pop($stackEvaluate);
                $result = $this->_evaluateOperation($operand1, $element, $operand2);
                array_push($stackEvaluate, $result);
            }
        }

        return $result;
    }

    /**
     * Evaluate postfix string format
     *
     * @param  string $strPostfix
     * @return number
     */
    public function evaluateStrPostfix($strPostfix)
    {
        $stackPostfix = $this->getConvertor()->strPostfixToStackPostfix($strPostfix);
        $result = $this->evaluateStackPostfix($stackPostfix);

        return $result;
    }

    /**
     * Evaluate expression tree
     *
     * @param  Expression_Tree $tree
     * @return int
     */
    public function evaluateExpressionTree(Expression_Tree $tree)
    {
        return $this->_evaluateExpressionTreeDsr($tree->getRoot());
    }

    private function _evaluateExpressionTreeDsr (Expression_TreeNode $node)
    {
        if ($node !== NULL) {
            $nodeLeft = $node->getLeftNode();
            $nodeRight = $node->getRightNode();
            if ($nodeLeft !== NULL && $nodeRight !== NULL) {
                return  $this->_evaluateOperation($this->_evaluateExpressionTreeDsr($nodeLeft), $node->toString(), $this->_evaluateExpressionTreeDsr($nodeRight));
            } else {
                return  $node->getOperand();
            }
        } else {
            return 0;
        }
    }

    private function _evaluateOperation ($operand1, $operator, $operand2)
    {
        switch ($operator) {
            case '+':
                $val = $operand1 + $operand2;
                break;
            case '-':
                $val = $operand1 - $operand2;
                break;
            case '*':
                $val = $operand1 * $operand2;
                break;
            case '/':
                $val = $operand2 / $operand1;
                break;
            default:
                throw ExpressionException ('Unknown operator '.$operator);
        }

        return $val;
    }
}
