<?php

namespace Apps\Core\Request;

use stdClass;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс PhpInput
 * @version 0.0.1
 * @package Apps\Core\Request\PhpInput
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class PhpInput extends stdClass
{

    public function __get(string $name)
    {
        return false;
    }

    public function __set(string $name, $value)
    {
        $this->$name = $value;
    }

}
