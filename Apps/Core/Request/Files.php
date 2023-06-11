<?php

namespace Apps\Core\Request;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Files
 * @version 0.0.1
 * @package Apps\Core\Request\Request
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Files
{

    use RequestTrait;

    public function __construct()
    {
        foreach ($_FILES as $key => $value) {
            $this->$key = $this->getValue($value);
        }
    }

    private function getValue(array $value)
    {
        $data = new \stdClass();
        foreach ($value as $key => $param) {
            $data->$key = trim($param);
        }
        return $data;
    }

}
