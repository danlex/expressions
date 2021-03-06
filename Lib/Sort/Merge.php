<?php
/**
 * Merge Sort
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
class Sort_Merge extends Sort_SortAbstract
{

    /**
    * public sort method
    *
    * @return Array
    */
    public function sort(Array $arr)
    {
        $this->devide ($arr, 0, count($arr) - 1);

        return $arr;
    }

    /**
    * Devide and conquer
    *
    * The method devides the array in two subarrays in order
    * to have 2 elements or only one in the subarray to sort
    * @return
    */
    private function devide(Array &$arr, $start, $end)
    {
        if ($start < $end) {
            $middle = floor(($end + $start)/2);
            $this->devide($arr, $start, $middle);
            $this->devide($arr, $middle + 1, $end);
            $this->merge($arr, $start, $middle, $end);
        }
    }

    /**
    * Merge the 2 ordered subarrays in one ordered array
    *
    * @return
    */
    private function merge(Array &$arr, $start, $middle, $end)
    {
        $leftArr = array();
        for ($i = 0; $i <= $middle - $start ; $i++) {
            $leftArr[$i] = $arr[$start + $i];
        }
        $leftArr[$i] = PHP_INT_MAX;

        $rightArr = array();
        for ($i = 0; $i <= $end - $middle - 1; $i++) {
            $rightArr[$i] = $arr[$middle + 1 + $i];
        }
        $rightArr[$i] = PHP_INT_MAX;

        $i = 0;
        $j = 0;
        for ($k = $start; $k <= $end; $k++) {
            if ($leftArr[$i] <= $rightArr[$j]) {
                $arr[$k] = $leftArr[$i];
                $i++;
            } else {
                $arr[$k] = $rightArr[$j];
                $j++;
            }
        }
    }
}
