<?php

namespace Apps\Core\AbstractClasses;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\Apps\Container;

/**
 * Класс AbstractController
 * @version 0.0.1
 * @package Apps\Core\AbstractClasses\AbstractController
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
abstract class AbstractController extends Container
{

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            header('Pragma: public');
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-type: " . mime_content_type($file));
            header("Content-Transfer-Encoding: binary");
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Cache-Control: must-revalidate');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            return true;
        }
        return false;
    }

}
