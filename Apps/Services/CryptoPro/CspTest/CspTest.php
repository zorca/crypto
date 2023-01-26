<?php

namespace Apps\Services\CryptoPro\CspTest;

if (!defined('ROOT')) {
    exit();
}

use Apps\Models\Users\Users;
use Apps\Services\CryptoPro\Bin;

/**
 * Класс CspTest
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\CspTest\CspTest
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class CspTest extends Bin
{

    public function generateKeys(Users $user)
    {
        $contName = $this->getContainerName($user);
        $command = 'sudo -u www-data ' . self::bin_patch . "csptest -keyset -newkeyset -cont '\\\\.\\HDIMAGE\\" . $contName . "'";
        $this->command($command);
        return false;
    }

    private function getContainerName(Users $user)
    {
        $name = '';
        $array = str_split(hash('sha256', json_encode($user)));
        for ($i = 0; $i < 8; $i++) {
            $name .= $array[array_rand($array)];
        }
        $name .= '.000';

        return $name;
    }

}
