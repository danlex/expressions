<?php
/**
 * Quick Sort using 2 pivots
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
class Sort_QuickSort2Pivot extends Sort_SortAbstract
{

    /*
    * Public sort method
    * quick sort algorithm with 2 pivots:
    * 1. choose pivot1 and pivot2
    * 2. place before the pivot1 all numbers < pivot1,
    * place before pivot 2 all numbers < pivot 2
    * array1 (0 ,pivot 1)
    * array2 (pivot 1, pivot 2)
    * array3 (pivot 2, n)
    * 3. repeat from step 2 for the 3 subarrays
    * 4. concatenate the 3 subarrays
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
    * @return Sort_QuickSort2pivot
    */
    private function quickSortRec(Array &$a, $start, $end)
    {
        if ($end - $start < 1) {
           return $this;
        } elseif ($end - $start < 2) {
           if ($a[$start] > $a[$end]) {
               $this->swap ($a[$start], $a[$end]);
           }

           return $this;
        }

        $pivot1 = $start + floor(($end + 1 - $start) / 3);
        $pivot2 = $pivot1 + floor(($end + 1 - $start) / 3);
        $this->reposition ($a, $pivot1, $pivot2, $start, $end)
             ->quickSortRec($a, $start, $pivot1 - 1)
             ->quickSortRec($a, $pivot1 + 1, $pivot2 - 1)
             ->quickSortRec($a, $pivot2 + 1, $end);

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
    * @return Sort_QuickSort2Pivot
    */
    private function reposition(Array &$a, &$pivot1, &$pivot2, $start, $end)
    {
        if ($end - $start < 1) {
           return $this;
        }
        //store pivot value
        $pivotValue = $a[$pivot1];

        //move the pivot item at the end of the list
        $this->swap ($a[$pivot1], $a[$end]);

        //all items < pivot1 value will be repostion at the biggining of the list
        $store = $start;
        for ($i = $start; $i <= $end; $i ++) {
            if ($a[$i] < $pivotValue) {
                $this->swap ($a[$i], $a[$store]);
                $store ++;
                continue;
            }

            if ($store === $pivot1) {
                break;
            }
        }
        $this->swap ($a[$store], $a[$end]);
        $pivot1 = $store;

        //store pivot value
        $pivotValue = $a[$pivot2];

        //move the pivot item at the end of the list
        $this->swap ($a[$pivot2], $a[$end]);

        //all items after pivot 1 with value <  pivot 2 value  will be repostion after pivot 1
        $store = $start;
        for ($i = $store; $i <= $end; $i ++) {
             if ($a[$i] < $pivotValue) {
                $this->swap ($a[$i], $a[$store]);
                $store ++;
                continue;
            }

            if ($store === $pivot2) {
                break;
            }
        }
        $this->swap ($a[$store], $a[$end]);
        $pivot2 = $store;

        return $this;
    }
}
