<?php

namespace Apps\Core\Config;

/**
 * Класс Env
 * @version 0.0.1
 * @package Apps\Core\Config\Env
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Env
{

    /**
     *
     * @var Env
     */
    private static $_instance = false;
    private string $envPatch = ROOT . '.env';

    public static function instance(): self
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function load()
    {
        $data = [];
        $keyPattern = '(?<keys>\w+)';
        $valuePattern = '("|\')?(?<values>[\w\d\pL=_()&?/:;.,-]+)("|\')?';
        $commentPattern = '(([#|//|#!])(?<comments>.+))';
        $pattern = '~^([\s]+)?' .
            $keyPattern . '([\s]+)?=(\s+)?' .
            $valuePattern . '(\s+)?' .
            $commentPattern . '?$~uim';
        preg_match_all($pattern, $this->getEnvContent(), $data);
        if (isset($data['keys']) and isset($data['values'])) {
            for ($i = 0; $i < count($data['keys']); $i++) {
                $key = $data['keys'][$i];
                $value = $data['values'][$i];
                $this->$key = $value;
                putenv($key . '=' . $value);
            }
        }
        return $this;
    }

    private function getEnvContent(): string
    {
        if (file_exists($this->getEnvPatch())) {
            return file_get_contents($this->getEnvPatch());
        }
        return '';
    }

    public function getEnvPatch()
    {
        return $this->envPatch;
    }

    public function setEnvPatch(string $patch)
    {
        $this->envPatch = $patch;
    }

    public function toArray()
    {
        return (array)$this;
    }

    public function __get(string $envName): string
    {
        return $this->get($envName);
    }

    public function get(string $envName): string
    {
        return getenv($envName);
    }

}
