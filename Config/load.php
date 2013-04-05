<?php
include 'config.php';
include APP_PATH.'/Lib/functions.php';

$autoloadCallbacks = spl_autoload_functions();
if (!$autoloadCallbacks) {
    $toRegister = true;
} else {
    $toRegister = !in_array('_autoload', $autoloadCallbacks);
}

if ($toRegister) {
    spl_autoload_register('_autoload');
}
