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
 * @subpackage : Binary Tree Sort
 * @copyright  : Copyright (C) 2012, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $1$
 */
class Sort_BinaryTree extends Sort_SortAbstract
{
    private $root = NULL;
    private $sortedArr = array();

    /**
    *
    * @param Array $arr
    * @return Array
    */
    public function sort(Array $arr)
    {
        $this->createBinaryTreeFromArray($arr);
        $this->traverse($this->root);

        return $this->sortedArr;
    }

    /**
    * Create Binary Search Tree from given Array
    *
    * @param Array $arr
    */
    private function createBinaryTreeFromArray(Array $arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            $this->insert($arr[$i]);
        }
    }

    /**
    * Insert new node with the given value
    *
    * @param integer $value
    */
    private function insert($value)
    {
        if (is_null($this->root)) {
            $this->root = new Sort_BinaryTreeNode($value);
        } else {
            $this->insertRec($this->root, $value);
        }
    }

    /**
    * Insert new node with the given value in the subtree
    *
    * @param Sort_BinaryTreeNode $node
    * @param integer $value
    */
    private function insertRec(Sort_BinaryTreeNode $node, $value)
    {
        if ($value < $node->getValue()) {
            if (is_null($node->getLeftNode())) {
                $node->setLeftNode(new Sort_BinaryTreeNode($value));
            } else {
                $this->insertRec($node->getLeftNode(), $value);
            }
        } else {
            if (is_null($node->getRightNode())) {
                $node->setRightNode(new Sort_BinaryTreeNode($value));
            } else {
                $this->insertRec($node->getRightNode(), $value);
            }
        }
    }

    /**
    * Traverse subtree of given node
    *
    * @param Sort_BinaryTreeNode $node
    */
    private function traverse (Sort_BinaryTreeNode $node = NULL)
    {
        if ($node !== NULL) {
            $this->traverse($node->getLeftNode());
            array_push($this->sortedArr, $node->getValue());
            $this->traverse($node->getRightNode());
        }
    }
}
