<?php

require_once dirname(dirname(__FILE__)) .
    DIRECTORY_SEPARATOR . 'bootstrap' .
    DIRECTORY_SEPARATOR . 'bootstrap.php';

try {
    $config = new \Apps\Core\Config\Config();
    $di = new Apps\Core\Apps\Apps($config);
    $router = new \Apps\Core\Router\Router($di->Server);
    $result = $router->run();
    if ($result and $result !== true) {
        header('Content-type: application/json');
        echo json_encode($result);
    } elseif (preg_match('~load(.+)~ui', $router::$patch) or $result === true) {
        return true;
    } else {
        header('Location: /error/404');
    }
} catch (Exception $exc) {
    $msg = PHP_EOL . PHP_EOL . date('d.m.Y H:i:s') . ' - ' . $exc;
    $file = ROOT . 'logs' . SEP . date('d.m.Y') . SEP . 'exception.log';
    $dir = dirname($file);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    if (file_put_contents($file, $msg, LOCK_EX | FILE_APPEND)) {
        header('Location: /error/500');
    }
}
