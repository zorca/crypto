<?php

namespace Apps\Web\Services;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Main
 * @version 0.0.1
 * @package Apps\Web\Services\Main
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Main extends \Apps\Core\AbstractClasses\AbstractService
{

    public function getLicense()
    {
        $text = substr(preg_replace('~(\W+)~ui', '', $this->post->license), 0, 25);
        $license = preg_replace('~^(\w{5})(\w{5})(\w{5})(\w{5})(\w{5})$~ui', '$1-$2-$3-$4-$5', $text);
        return $license;
    }

    public function setLicense(string $license)
    {
        $newLicense = (new \Apps\Services\CryptoPro\License())->set($license);
        if ($newLicense) {
            unset($newLicense->separator);
            return $newLicense;
        }
        return false;
    }

}
