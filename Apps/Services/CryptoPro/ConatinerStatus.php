<?php

namespace Apps\Services\CryptoPro;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс ConatinerStatus
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\ConatinerStatus
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class ConatinerStatus extends Bin
{

    public function parseStatus($status)
    {
        $data = explode($this->separator, $status);
        foreach ($data as $value) {
            $this->parse($value);
        }
        return $this;
    }

    private function parse($status)
    {
        $data = explode(':', $status);
        $name = str_replace(' ', '_', trim($data[0]));
        if (isset($data[1]) and $data[1]) {
            $this->$name = trim($data[1]);
        }
    }

}
