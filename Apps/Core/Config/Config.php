<?php

namespace Apps\Core\Config;

/**
 * Класс Config
 * @version 0.0.1
 * @package Apps\Core\Config\Config
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
final class Config
{

    public function __construct(string $name = '')
    {
        if ($name) {
            $this->get($name);
        }
    }

    public function get(string $configFileName)
    {
        $file = ROOT . 'config' . SEP . $configFileName . '.json';
        foreach ((new Json())->get($file) as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public function set(object $data, string $configFileName)
    {
        $file = ROOT . 'config' . SEP . $configFileName . '.json';
        return (new Json())->set($file, $data);
    }

}
