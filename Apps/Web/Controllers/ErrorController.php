<?php

namespace Apps\Web\Controllers;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractController;

/**
 * Класс ErrorController
 * @version 0.0.1
 * @package Apps\Web\Controllers\ErrorController
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class ErrorController extends AbstractController
{

    public function getErrorAction($code = 404)
    {
        return [false, 'error' => true, 'code' => $code, 'msg' => self::$headers[$code]];
    }

}
