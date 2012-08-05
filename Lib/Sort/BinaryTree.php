<?php 
/**
 * Binary Tree Sort
 *
 * $1$
 * $Alexandru Dan <dan_lex@yahoo.com>$
 * $2012-07-22$
 *
 * @category   : Math Algorithms
 * @package    : Sort
 * @subpackage : 
 * @copyright  : Copyright (C) 2012, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $1$
 */
class Sort_BinaryTree{
	private static $_instance = NULL;
	private $_root = NULL;
	private $_sortedArr = array();
	
	private function __construct(){
        
    }
	
    /**
     * Binary Tree Sort singleton
     *
     * @return Sort_BinaryTree
     */
	public static function getInstance(){
        if (is_null(self::$_instance)){
            self::$_instance = new Sort_BinaryTree();
        }
        
        return self::$_instance;
    }
    
	public function sort(Array $arr) {
	    $this->_createBinaryTreeFromArray($arr);
	    $this->_traverse($this->_root);
	    return $this->_sortedArr;
	}
	
	private function _createBinaryTreeFromArray(Array $arr){
		for($i = 0; $i < count($arr); $i++) {
	        $this->_insert($arr[$i]);
	    }
	}
	
	private function _insert($value){
		if (is_null($this->_root)){
			$this->_root = new Sort_BinaryTreeNode($value);
		} else {
			$this->_insertInternal($this->_root, $value);
		}
	}
	
	private function _insertInternal(Sort_BinaryTreeNode $node, $value){
		if ($value < $node->getValue()) {
	        if (is_null($node->getLeftNode())) {
	            $node->setLeftNode(new Sort_BinaryTreeNode($value));  
	        }else{
	            $this->_insertInternal($node->getLeftNode(), $value);
	        }
	    }else{
	        if (is_null($node->getRightNode())) {
	            $node->setRightNode(new Sort_BinaryTreeNode($value));
	        }else{
	            $this->_insertInternal($node->getRightNode(), $value);
	        }       
	    }
	}
	
	private function _traverse (Sort_BinaryTreeNode $node = NULL){
        if ($node !== NULL){
        	$this->_traverse($node->getLeftNode());
        	array_push($this->_sortedArr, $node->getValue());
        	$this->_traverse($node->getRightNode());
        }
    }
}