<?php

namespace Apps\Console;

use Apps\Core\Apps\Container;

/**
 * Класс Server
 * @version 0.0.1
 * @package Apps\Console\Server
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
final class Server extends Container
{

    public function start()
    {
        $config = $this->Config->get('developer');
        $command = $config->phpBinFile . ' -S ' .
            $config->host . ':' .
            $config->port . ' -t ' . ROOT . 'public' . SEP;
        return exec($command);
    }

    public function open()
    {
        $config = $this->Config('apps');
    }

}
