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
class Sort_QuickSort extends Sort_SortAbstract
{

    /*
    * Public sort method
    * quick sort algorithm:
    * 1. choose pivot
    * 2. place before the pivot all numbers < pivot value and
    * 3. repeat for the numbers before the pivot and after te pivot
    * 4. concatenate left and right sub arrays
    * @param Array $a
    * @return Array
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
    * @return SortQuickSort
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
    * @param integer $pivot
    * @param integer $start
    * @param integer $end
    * @return Sort_QuickSort
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
}
