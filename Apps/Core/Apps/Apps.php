<?php

namespace Apps\Core\Apps;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\Config\Config;

/**
 * Класс Apps
 * @version 0.0.1
 * @package Apps\Core\Apps\Apps
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Apps
{

    private static Config $config;
    private static array $data = [];

    public function __construct()
    {
        self::$config = new Config();
        $this->load();
    }

    private function load(): void
    {
        $di = new Container();
        foreach (self::$config->get('apps') as $key => $value) {
            self::$data[$key] = $value;
            $di::$data[$key] = $value;
        }
    }

    public static function getApps()
    {
        return self::$data;
    }

    public function __get(string $name)
    {
        if (isset(self::$data[$name]) and class_exists(self::$data[$name])) {
            $class = self::$data[$name];
            return new $class();
        }
        return false;
    }

    public function __set(string $name, $value): void
    {
        if (!isset(self::$data[$name])) {
            self::$data[$name] = $value;
        }
    }

}
