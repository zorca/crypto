<?php

namespace Apps\Services\CryptoPro;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс Issuer
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Issuer
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Issuer
{

    public $data;

    public function __construct(string $data)
    {
        $this->data = $data;
        $this->parseData();
    }

    private function parseData()
    {
        foreach (explode(',', $this->data) as $value) {
            $matches = [];
            preg_match('~^(?<key>.+)=(?<value>.+)$~', trim($value), $matches);
            if (isset($matches['key']) and isset($matches['value'])) {
                $this->set($matches['key'], $matches['value']);
            }
        }
    }

    public function set($key, $value)
    {
        switch (mb_strtolower(trim($key))) {
            case 't':
                $this->official = trim($value);
                break;
            case 'sn':
                $this->last_name = trim($value);
                break;
            case 's':
                $this->region = trim($value);
                break;
            case 'g':
                $this->name = trim($value);
                break;
            case 'o':
                $this->name_company = trim($value);
                break;
            case 'cn':
                $this->full_name_company = trim($value);
                break;
            case 'c':
                $this->country = trim($value);
                break;
            case 'l':
                $this->city = trim($value);
                break;
            case 'e':
                $this->email = trim($value);
                break;
            default:
                $this->{mb_strtolower(trim($key))} = trim($value);
        }
    }

}
