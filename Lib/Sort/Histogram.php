<?php
/**
 * Histogram Sort
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
class Sort_Histogram extends Sort_SortAbstract
{

    /**
    * Histogram sort
    *
    * @param Array $a
    * @return Array
    */
    public function sort(Array $a)
    {
        $max = $a[0];
        for ($i = 1; $i < count($a); $i ++) {
            if ($a[$i] > $max) {
                $max = $a[$i];
            }
        }

        $hist = array();
        for ($i = 0; $i < $max; $i ++) {
            $hist[$i] = 0;
        }

        for ($i = 0; $i < count($a); $i ++) {
            $hist[$a[$i]] ++;
        }

        $j = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($hist[$i] > 0) {
                $a[$j++] = $i;
            }
        }

        return $a;
    }
}
