<?php
 /**
 * Sort tree node
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
 
class Sort_BinaryTreeNode{
    private $_leftNode = NULL;
    private $_rightNode = NULL;
    private $_value = NULL;
    
    public function __construct($value){
        $this->setValue($value);
    }
    
    public function setLeftNode(Sort_BinaryTreeNode $node = NULL){
        $this->_leftNode = $node; return $this;
    }
    
    public function getLeftNode(){
        return $this->_leftNode;
    }
    
    public function setRightNode(Sort_BinaryTreeNode $node = NULL){
        $this->_rightNode = $node; return $this;
    }
    
    public function getRightNode(){
        return $this->_rightNode;
    }
    
    public function setValue($value){
        $this->_value = $value; return $this;
    }
    
    public function getValue(){
        return $this->_value;
    }
    
    public function toString(){
        return $this->getValue();
    }
}