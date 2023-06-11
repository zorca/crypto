<?php

namespace Apps\Core\Request;

/**
 * Трейт RequestTrait
 * @version 0.0.1
 * @package Apps\Core\Request
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
trait RequestTrait
{

    protected static $obj;

    /**
     * Список допустимых типов к которым можно привести свойство объекта
     * @var array
     */
    protected static array $types = [
        'boolean',
        'bool',
        'integer',
        'int',
        'float',
        'double',
        'string',
        'array',
        'object',
        'null'
    ];

    public static function instance()
    {
        $className = get_called_class();
        if ( ! isset(self::$obj[$className])) {
            self::$obj[$className] = new self();
        }
        return self::$obj[$className];
    }

    /**
     * Вернуть false при отсутствии объекта
     * @param string $name
     * @return false
     */
    public function __get(string $name): bool
    {
        unset($name);
        return false;
    }

    /**
     * Получить значение свойства объекта $name и привести его к типу $type
     * @param string $name Наименование свойства объекта
     * @param string $type Заданный тип свойства объекта
     * @return   Значение свойства $name с типом $type
     */
    public function get(string $name, string $type = 'string')
    {
        if (isset($this->$name) and in_array(mb_strtolower($type), self::$types)) {
            #settype($this->$name, $type);
            return $this->$name;
        }
        return false;
    }

    protected function setValue($value, $key)
    {
        if (is_string($value)) {
            $this->$key = trim($value);
        } else {
            $this->$key = $value;
        }
    }

}
