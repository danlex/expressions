<?php
 /**
 * Expression tree
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
 
class Expression_Tree{
    private $_root = NULL;
    public function __construct(){
        
    }
    
    public function setRoot($node){
        $this->_root = $node; return $this;
    }
    
    public function getRoot(){
        return $this->_root;
    }
}