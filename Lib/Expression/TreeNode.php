<?php
 /**
 * Expression tree node
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

class Expression_TreeNode
{
    private $_leftNode = NULL;
    private $_rightNode = NULL;
    private $_operand = NULL;
    private $_operator = NULL;

    public function __construct()
    {
    }

    public function setLeftNode(Expression_TreeNode $node = NULL)
    {
        $this->_leftNode = $node; return $this;
    }

    public function getLeftNode()
    {
        return $this->_leftNode;
    }

    public function setRightNode(Expression_TreeNode $node = NULL)
    {
        $this->_rightNode = $node; return $this;
    }

    public function getRightNode()
    {
        return $this->_rightNode;
    }

    public function setOperand($operand)
    {
        $this->_operand = $operand; return $this;
    }

    public function getOperand()
    {
        return $this->_operand;
    }

    public function setOperator($operator)
    {
        $this->_operator = $operator; return $this;
    }

    public function getOperator()
    {
        return $this->_operator;
    }

    public function toString()
    {
        $str = '';
        $operator = $this->getOperator();
        if (!is_null($operator)) {
            $str .= $operator;
        }
        $operand = $this->getOperand();
        if (!is_null($operand)) {
            $str .= $operand;
        }

        return $str;
    }
}
