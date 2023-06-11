<?php

namespace Apps\Services\CryptoPro;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Provider
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Provider
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Provider extends Bin
{

    public function getProviders()
    {
        $command = self::$sbin_patch . 'cpconfig' . ' -defprov -view_type';
        $data = $this->command($command);
        return $this->result($this->parseProviders($data[0]));
    }

    public function parseProviders($data)
    {
        $providers = [];
        unset($data[0], $data[1], $data[2]);
        foreach ($data as $key => $value) {
            $providers[$key] = new self();
            $providers[$key]->fullInfo = trim(preg_replace('~(\s+)~ui', ' ', trim($value)));
            $providers[$key]->code = trim(preg_replace('~^(\d{1,3})(.+)$~ui', '$1', trim($value)));
            $providers[$key]->type = trim(preg_replace('~^(\d{1,3})(.+)$~ui', '$2', trim($value)));
        }
        return $providers;
    }

}
