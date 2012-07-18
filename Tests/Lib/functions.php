<?php
function _autoload($name) {
    $filePath = '';
    $nameSlices = explode ('_', $name);
    $fileName = array_pop($nameSlices).'.php';
    
    switch (true) {        
        case strpos ( $name, 'Test' ) !== false :
            $filePath = APP_PATH.'/Tests/Unit/Lib'.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $nameSlices).DIRECTORY_SEPARATOR.$fileName;
            require_once($filePath);
            break;
        
        default :
            $filePath = APP_PATH.'/Lib'.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $nameSlices).DIRECTORY_SEPARATOR.$fileName;
            require_once($filePath);
            break;
            break;
    }
}

function print_p($var){
    print_r ($var);
    echo ("\n");
}