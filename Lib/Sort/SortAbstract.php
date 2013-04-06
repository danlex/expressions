<?php

abstract class Sort_SortAbstract
{
    /**
     * Instance
     *
     * @var Singleton
     */
    protected static $instance;


    /**
    * Debug Mode
    *
    * @var DebugMode
    */
    protected $debug = false;

    /**
     * Constructor
     *
     * @return void
     */
    protected function __construct() {}

    /**
     * Get instance
     *
     * @return Singleton
     */
    public final static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /*
    * Set debug mode
    * @param boolean $debug
    * @return Sort_QuickSort
    */
    public function setDebug($debug = true)
    {
        $this->debug = $debug;

        return $this;
    }

    /*
    * Print debug variable
    * @param mixed $var
    */
    protected function debug($var)
    {
        if ($this->debug) {
            if (is_array($var)) {
                print_r($var);
            } else {
                echo($var);
            }
            echo (PHP_EOL);
        }

        return $this;
    }

    /*
    * Exchange values between 2 parameters
    *
    * @param mixed value $a
    * @param mixed $b
    */
    protected function swap (&$a, &$b)
    {
        if ($a === $b){
            return true;
        }
        $tmp = $a;
        $a = $b;
        $b = $tmp;

        return true;
    }

    /*
    * Abstract sort method
    *
    * @param Array $a
    */
    abstract public function sort (Array $a);
}
