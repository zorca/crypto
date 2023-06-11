<?php

namespace Apps\Services\CryptoPro;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Algoritm
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Algoritm
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Algoritm extends Bin
{

    public function parseAlgoritm($algoritm)
    {
        $this->getType($algoritm);
        $this->getName($algoritm);
        $this->getLong($algoritm);
        $this->getDefLen($algoritm);
        $this->getMinLen($algoritm);
        $this->getMaxLen($algoritm);
        $this->getPort($algoritm);
        $this->getAlgId($algoritm);

        return $this;
    }

    public function getType($algoritm)
    {
        $this->type = trim(preg_replace('~(.+)Type:(.+)Name:(.+)~ui', '$2', $algoritm));
    }

    public function getName($algoritm)
    {
        $this->name = trim(preg_replace('~(.+)Name:(.+)Long:(.+)~ui', '$2', $algoritm));
    }

    public function getLong($algoritm)
    {
        $this->long = trim(trim(preg_replace('~(.+)Long:([^\|]+)(.+)~ui', '$2', $algoritm), '-'));
    }

    public function getDefLen($algoritm)
    {
        $this->defaultLen = trim(preg_replace('~(.+)DefaultLen:(\d+)(.+)~ui', '$2', $algoritm));
    }

    public function getMinLen($algoritm)
    {
        $this->minLen = trim(preg_replace('~(.+)MinLen:(\d+)(.+)~ui', '$2', $algoritm));
    }

    public function getMaxLen($algoritm)
    {
        $this->maxLen = trim(preg_replace('~(.+)MaxLen:(\d+)(.+)~ui', '$2', $algoritm));
    }

    public function getPort($algoritm)
    {
        $this->port = trim(preg_replace('~(.+)Prot:(\d+)(.+)~ui', '$2', $algoritm));
    }

    public function getAlgId($algoritm)
    {
        $this->algId = trim(preg_replace('~(.+)Algid:(\d+)(.+)~ui', '$2', $algoritm));
    }

}
