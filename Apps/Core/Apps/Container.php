<?php

namespace Apps\Core\Apps;

if ( ! defined('ROOT')) {
    exit();
}

use Cocur\Slugify\Slugify;
use stdClass;

/**
 * Класс Container
 * @version 0.0.1
 * @package Apps\Core\AbstractClasses\Container
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Container
{

    use Headers;

    public static array $data;

    public function __get(string $name)
    {
        if (isset(self::$data[$name])) {
            $class = self::$data[$name];
            $obj = new $class();
            return $obj;
        }
        return false;
    }

    public function __set(string $name, $value)
    {
        if ( ! isset(self::$data[$name])) {
            self::$data[$name] = $value;
            return self::$data[$name];
        }
        return false;
    }

    public function __call(string $name, array $args)
    {
        if (isset(self::$data[$name])) {
            $class = self::$data[$name];
            return call_user_func_array([new $class, '__construct'], $args);
        }
        return new stdClass();
    }

    public function __isset(string $name): bool
    {
        if ( ! isset(self::$data[$name])) {
            return false;
        }
        return true;
    }

    public function __clone()
    {
        return $this;
    }

    public function __toString(): string
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }

    public function __serialize(): array
    {
        return (array)$this;
    }

    public function __unserialize(array $data = [])
    {
        $self = new self();
        foreach ($data as $key => $value) {
            $self->$key = $value;
        }
        return $self;
    }

    public function slug($string, $separator = "_")
    {
        $slugify = new Slugify();
        return $slugify->slugify($string, $separator);
    }

}
