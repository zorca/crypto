<?php

namespace Apps\Services\Scorings\Library;

/**
 * Трейт Books
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
trait Books
{

    public ?string $code = null;
    public ?string $name = null;

    public static function get($str)
    {
        foreach (self::$data as $key => $value) {
            if (mb_strtolower($str) === mb_strtolower($key)
                or mb_strtolower($str) === mb_strtolower($value)
            ) {
                $obj = new self();
                $obj->name = mb_strtolower($str);
                $obj->code = $value;
                return $obj;
            }
        }
        if (isset(self::$default)) {
            return self::get(self::$default);
        }
    }

    public static function getLirary()
    {
        return self::$dats;
    }

}
