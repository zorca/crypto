<?php

namespace Apps\Core\Display;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\Apps\Container;

/**
 * Класс Display
 * @version 0.0.1
 * @package Apps\Core\Display\Display
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Display extends Container
{

    private static array $vars = [];

    public function __set(string $name, $value)
    {
        if (!isset(self::$vars[$name])) {
            self::$vars[$name] = $value;
            return true;
        }
        throw new Exception('Имя переменной уже используется!!! ' .
            'Выберите другое наименование переменной или используйте ' .
            'метод ' . __CLASS__ . '::set($name, $value)'
        );
    }

    public function assign($name, $value = false)
    {
        if (is_string($name)) {
            return $this->$name = $value;
        } elseif (is_array($name) and is_array($value) and count($name) === count($value)) {
            for ($i = 0; $i < count($name); $i++) {
                $this->$name[$i] = $value[$i];
            }
            return true;
        } elseif (is_object($name)) {
            foreach ($name as $key => $value) {
                $this->$key = $value;
            }
        }
        return false;
    }

    public function set($name, $value)
    {
        self::$vars[$name] = $value;
    }

}
