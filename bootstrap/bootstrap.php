<?php

define('SEP', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)) . SEP);
define('TMP', ROOT . 'tmp' . SEP);

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
#ini_set('error_reporting', E_ALL);

session_start();

function memoryUsage()
{
    $size = memory_get_usage(true);
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
    return PHP_EOL . @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2)
        . ' ' . $unit[$i] . PHP_EOL;
}

function dd()
{
    $count = 0;
    echo '<PRE style="padding: 20px; color: green; background: black; font-size: 14px; border:solid 2px #2A3838;">';
    foreach (func_get_args() as $arg) {
        if ($count > 0) {
            echo '<hr>';
        }
        print_r($arg);
        $count++;
    }
    echo "</PRE>";
    return print_r(func_get_args(), true);
}

spl_autoload_register(function ($className) {
    $file = ROOT . str_replace('\\', SEP, $className) . '.php';
    if (is_file($file)) {
        include_once $file;
    }
});
