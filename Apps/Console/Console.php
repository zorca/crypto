<?php

namespace Apps\Console;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\Apps\Container;

/**
 * Класс Console
 * @version 0.0.1
 * @package Apps\Console\Console
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Console extends Container
{

    public function getModel()
    {
        $args = func_get_args();
        $className = $args[0];
        $actionName = $args[1];
        unset($args[0], $args[1]);
        $params = $this->getConsoleParams($args[2]);
        $obj = $this->$className;
        if (is_object($obj)) {
            $data = call_user_func_array([$obj, $actionName], $params);
            return $data;
        }
        return false;
    }

    public function getConsoleParams($param)
    {
        $params = [];
        foreach (explode(' ', $param) as $key => $value) {
            if ($value) {
                if (stripos($value, '||')) {
                    $params[$key] = explode('||', trim($value));
                } else {
                    $params[$key] = trim($value);
                }
            }
        }
        return $params;
    }

}
