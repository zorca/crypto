<?php

namespace Apps\Services\CryptoPro;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Container
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Container
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Container extends Bin
{

    public function view(string $containerName)
    {
        $command = ' ' . self::bin_patch . "csptestf" . self::ext . " -keyset -container '" . $containerName . "' -info";
        $data = $this->command($command);
        $container = $this->parseContainer($data[0]);
        $container->patch = $containerName;
        $repo = $this->getKeyRepo() . SEP;
        $container->dir = preg_replace(
            '~' . $repo . '(\w+)(.+)~ui',
            $repo . '$1.000',
            str_replace('\\\\.\\HDIMAGE\\', $repo, $containerName)
        );
        return $container;
    }

    private function parseContainer($container)
    {
        $data = implode($this->separator, $container);
        $info = new self();
        $info->cryptoProvider = (new ProviderInfo())->parseProvider($container[0]);
        $info->algorithms = $this->parseAlgoritms($data);
        $info->status = $this->parseStatus($data);
        $info->containerName = $this->parseContainerName($data);
        return $info;
    }

    private function parseAlgoritms($data)
    {
        $info = [];
        $algoritms = explode($this->separator . $this->separator, preg_replace('~(.+)CSP algorithms info:(.+)Status:(.+)~ui', '$2', $data));
        foreach ($algoritms as $algoritm) {
            $info[] = (new Algoritm())->parseAlgoritm($algoritm);
        }
        return $info;
    }

    private function parseStatus($data)
    {
        $status = preg_replace('~(.+)Status:(.+)Key pair info:(.+)~ui', '$2', $data);
        return (new ConatinerStatus())->parseStatus($status);
    }

    private function parseContainerName($data)
    {
        return '\\\\.\HDIMAGE\\' . preg_replace('~(.+)Container name: "([@\w\d\.-]+)"(.+)~ui', '$2', $data);
    }

    public static function getKeyRepo()
    {
        $obj = new self();
        $user = $obj->command('echo $USER');
        if ( ! $user[0][0]) {
            $user = 'www-data';
        } else {
            $user = $user[0][0];
        }
        $dir = self::$keys_patch . $user;
        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $command = 'cd ' . $dir . ' && pwd';
        $pwd = $obj->command($command);
        return $pwd[0][0];
    }

}
