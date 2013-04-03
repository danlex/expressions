<?php 
/**
 * Quick Sort
 *
 * $1$
 * $Alexandru Dan <dan_lex@yahoo.com>$
 * $2013-04-01$
 *
 * @category   : Math Algorithms
 * @package    : Sort
 * @subpackage : 
 * @copyright  : Copyright (C) 2012, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $1$
 */
class Sort_QuickSort{
    private static $_instance = NULL;
    private $_debug = false; 
	
    private function __construct(){

    }
	
    /**
    * Quick Sort singleton
    * 
    * @return Sort_QuickSort
    */
    public static function getInstance(){
        if (is_null(self::$_instance)){
            self::$_instance = new Sort_QuickSort();
        }
        
        return self::$_instance;
    }

    public function setDebug($debug = true){
        $this->_debug = $debug;
    }

    private function _debug($var){
        if($this->_debug){
            if (is_array($var)){
                print_r($var);
            } else {
                echo($var);
            }
            echo (PHP_EOL);
        }
    }
    
    /**
    * public sort method
    * quick sort algorithm:
    * 1. choose pivot
    * 2. place before the pivot all numbers < pivot value and 
    * 3. repeat for the numbers before the pivot and after te pivot
    * 4. concatenate left and right sub arrays
    * @return Array
    */
    public function sort(Array &$arr) {
        $this->_arr = $arr;
        $this->_quickSortRec(0, count($arr));
        $arr = $this->_arr;
    }

    private function _quickSortRec($start, $end){
        $this->_debug($start . '|'. $end);
        if ($end - $start <= 1){
           return;
        }
        $pivot = $start + floor(($end - $start) / 2);
        $pivotValue = $this->_arr[$pivot];
        $this->_swap ($pivot, $end - 1);
        $this->_debug($start . '|'. $end . '|' . $pivot. '|'. $pivotValue);
        $this->_debug('before reposition: ');
        $this->_debug($this->_arr);
        $store = $start;
        for ($i = $start; $i < $end; $i ++){
            if ($pivotValue > $this->_arr[$i]){
                $this->_swap ($i, $store);
                $store ++; 
            }
        }
        $this->_debug('after reposition: ');
        $this->_debug($this->_arr);
        $this->_swap ($store, $end - 1);
        $this->_debug($this->_arr);
        $this->_quickSortRec($start, $pivot);
        $this->_quickSortRec($pivot + 1, $end);
    }

    private function _swap ($a, $b){
        $tmp = $this->_arr[$a];
        $this->_arr[$a] = $this->_arr[$b];
        $this->_arr[$b] = $tmp;
   } 
}
