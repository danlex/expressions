<?php
/**
 * Insertion Sort
 *
 * Insertion sort iterates, consuming one input element each repetition, and growing a sorted output list
 * On a repetition, insertion sort removes one element from the input data, finds the location it belongs
 * within the sorted list, and inserts it there. It repeats until no input elements remain.
 *
 * $1$
 * $Alexandru Dan <dan_lex@yahoo.com>$
 * $2012-07-22$
 *
 * @category   : Math Algorithms
 * @package    : Sort
 * @subpackage : Insertion Sort
 * @copyright  : Copyright (C) 2012, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $1$
 */
class Sort_Insertion extends Sort_SortAbstract
{

    /**
    * Insertion sort
    *
    * @param Array $a
    * @return Array
    */
    public function sort(Array $a)
    {
        for ($j = 1; $j < count($a); $j++) {
            $tmp = $a[$j];
            $i = $j;
            while (($i > 0) && ($a[$i-1] > $tmp)) {
                $a[$i] = $a[$i-1];
                $i--;
            }
            $a[$i] = $tmp;
        }

        return $a;
    }
}
