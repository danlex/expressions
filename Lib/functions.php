<?php
if (!function_exists('_autoload')) {
    function _autoload ($name)
    {
        $filePath = '';
        $nameSlices = explode ('_', $name);
        $fileName = array_pop($nameSlices).'.php';
        $filePath = APP_PATH.'/Lib'.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $nameSlices).DIRECTORY_SEPARATOR.$fileName;
        include_once($filePath);
    }
}

function print_p($var)
{
    print_r ($var);
    echo ("\n");
}
