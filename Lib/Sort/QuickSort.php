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
class Sort_QuickSort
{
    private static $_instance = NULL;
    private $_debug = false;

    private function __construct()
    {
    }

    /**
    * Quick Sort singleton
    * @return Sort_QuickSort
    */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Sort_QuickSort();
        }

        return self::$_instance;
    }

    /*
    * Set debug mode
    * @param boolean $debug
    * @return Sort_QuickSort
    */
    public function setDebug($debug = true)
    {
        $this->_debug = $debug;

        return $this;
    }

    /*
    * Print debug variable
    * @param mixed $var
    */
    private function debug($var)
    {
        if ($this->_debug) {
            if (is_array($var)) {
                print_r($var);
            } else {
                echo($var);
            }
            echo (PHP_EOL);
        }
    }

    /*
    * Public sort method
    * quick sort algorithm:
    * 1. choose pivot
    * 2. place before the pivot all numbers < pivot value and
    * 3. repeat for the numbers before the pivot and after te pivot
    * 4. concatenate left and right sub arrays
    * @param Array $a
    */
    public function sort(Array $a)
    {
        $this->quickSortRec($a, 0, count($a) - 1);
        return $a;
    }

    /*
    * Recursive quick sort
    *
    * @param Array $a
    * @param integer $start
    * @param integer $end
    */
    private function quickSortRec(Array &$a, $start, $end)
    {
        if ($end - $start < 1) {
           return $this;
        }

        $pivot = $start + floor(($end + 1 - $start) / 2);
        $this->reposition ($a, $pivot, $start, $end)
             ->quickSortRec($a, $start, $pivot - 1)
             ->quickSortRec($a, $pivot + 1, $end);

        return $this;
    }

    /*
    * Reposition elements of the array
    * Place before the pivot all numbers < pivot value and
    * 
    * @param Array $a
    * @param integer $start
    * @param integer $end
    */
    private function reposition(Array &$a, &$pivot, $start, $end)
    {
        if ($end - $start < 1) {
           return $this;
        }
        $pivotValue = $a[$pivot];
        $this->swap ($a[$pivot], $a[$end]);
        $store = $start; 
        for ($i = $start; $i <= $end; $i ++) {
            if ($pivotValue > $a[$i] && $store <= $pivot) {
                $this->swap ($a[$i], $a[$store]);
                $store ++;
            }
        }
        $this->swap ($a[$store], $a[$end]);
        $pivot = $store;

        return $this;
    }

    /*
    * Exchange values between 2 parameters
    *
    * @param mixed value $a
    * @param mixed $b
    */
    private function swap (&$a, &$b)
    {
        if ($a === $b){
            return true; 
        }
        $tmp = $a;
        $a = $b;
        $b = $tmp;

        return true;
    }
}
