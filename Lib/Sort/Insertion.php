<?php 
/**
 * Insertion Sort
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
class Sort_Insertion{
	private static $_instance = NULL;
	
	private function __construct(){
        
    }
	
    /**
     * Insertion Sort singleton
     *
     * @return Sort_Insertion
     */
	public static function getInstance(){
        if (is_null(self::$_instance)){
            self::$_instance = new Sort_Insertion();
        }
        
        return self::$_instance;
    }
    
	public function sort($arr) {
	    for($j = 1; $j < count($arr); $j++) {
	        $tmp = $arr[$j];
	        $i = $j;
	        while(($i > 0) && ($arr[$i-1] > $tmp)) {
	            $arr[$i] = $arr[$i-1];
	            $i--;
	        }
	        $arr[$i] = $tmp;
	    }
	    
	    return $arr;
	}
}