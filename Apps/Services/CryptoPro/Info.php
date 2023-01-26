<?php

namespace Apps\Services\CryptoPro;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс Info
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Info
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Info extends Bin
{

    /**
     *
     * @return type
     */
    public function licinse()
    {
        return (new License())->view();
    }

    /**
     * Просмотр доступных носителей
     * @return array|false
     */
    public function viewMedia()
    {
        $command = 'sudo -u www-data ' . self::$sbin_patch . 'cpconfig' . ' -hardware media -view | iconv -f cp1251';
        $data = $this->command($command);
        return $this->result((new Media())->parse($data[0]));
    }

    /**
     * Просмотреть доступные типы криптопровайдеров
     * @return array|false
     */
    public function viewProviders()
    {
        $data = [];
        $providers = (new Provider())->getProviders();
        foreach ($providers as $provider) {
            if (isset($provider->separator)) {
                unset($provider->separator);
            }
            $data[] = $provider;
        }
        return $data;
    }

    public function viewContainers()
    {
        $command = 'sudo -u www-data ' . self::bin_patch . 'csptest' . ' -keyset -enum_cont -fqcn -verifyc';
        $data = $this->command($command);
        $count = count($data[0]);
        unset($data[0][0], $data[0][1], $data[0][$count - 1], $data[0][$count - 2], $data[0][$count - 3]);
        $containers = explode('|', implode('|', $data[0]));
        $info = [];
        foreach ($containers as $container) {
            $info[] = (new Container())->view($container);
        }
        return $info;
    }

}
