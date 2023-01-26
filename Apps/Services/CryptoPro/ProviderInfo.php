<?php

namespace Apps\Services\CryptoPro;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс CryptoInfo
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\CryptoInfo
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class ProviderInfo
{

    public $type;
    public $version;
    public $disable;
    public $release;
    public $kc;
    public $os;

    public function parseProvider(string $providerString)
    {
        $this->getType($providerString);
        $this->getVersion($providerString);
        $this->getKc($providerString);
        $this->getRelease($providerString);
        $this->getOs($providerString);
        $this->getCpu($providerString);
        $this->getDis($providerString);
        return $this;
    }

    private function getType($providerString)
    {
        $this->type = preg_replace('~(.+)Type:(\d+)(.+)~ui', '$2', $providerString);
        return $this->type;
    }

    private function getVersion($providerString)
    {
        $this->version = preg_replace('~(.+)Type:(.+)v([\.\d]+)(.+)~ui', '$3', $providerString);
        return $this->version;
    }

    private function getKc($providerString)
    {
        $this->kc = preg_replace('~(.+)KC(\d+)(.+)~ui', '$2', $providerString);
        return $this->kc;
    }

    private function getRelease($providerString)
    {
        $this->release = preg_replace('~(.+)Release Ver:([\.\d]+)(.+)~ui', '$2', $providerString);
        return $this->release;
    }

    private function getOs($providerString)
    {
        $this->os = trim(preg_replace('~(.+)OS:(.+)CPU(.+)~ui', '$2', $providerString));
        return $this->os;
    }

    private function getCpu($providerString)
    {
        $this->cpu = trim(preg_replace('~(.+)CPU:(.+)\.(.+)~ui', '$2', $providerString));
        return $this->cpu;
    }

    private function getDis($providerString)
    {
        $disData = explode(';', trim(preg_replace('~(.+)DISABLED:(.+)~ui', '$2', $providerString)));
        foreach ($disData as $value) {
            if ($value) {
                $this->disable[] = $value;
            }
        }
        return $this->disable;
    }

}
