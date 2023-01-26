<?php

namespace Apps\Web\Controllers;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractController;
use Apps\Services\CryptoPro\CspTest\CspTest;
use Apps\Services\CryptoPro\Info;
use Apps\Web\Services\Main;
use Apps\Web\Services\Users;

/**
 * Класс MainController
 * @version 0.0.1
 * @package Apps\Web\Controllers\MainController
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class MainController extends AbstractController
{

    public function getIndexAction()
    {
        $main = Main::instance();
        $url = strtolower('https://' . $main->server->SERVER_NAME . '/');
        include_once ROOT . 'templates/main/main.php';
        unset($url);
        return true;
    }

    public function getViewLicenceAction()
    {
        $license = (new Info())->licinse();
        unset($license->separator);
        return $license;
    }

    public function getViewContainersAction()
    {
        return (new Info())->viewContainers();
    }

    public function postSetLicenseAction()
    {
        $main = Main::instance();
        $license = $main->getLicense();
        if ($license) {
            return $main->setLicense($license);
        }
        return true;
    }

    public function getViewProvidersAction()
    {
        return (new Info())->viewProviders();
    }

    public function putKeyGenerateAction()
    {
        $patchUser = Users::instance()->createUserForRequestCertificate();
        $user = Users::instance()->createNewUserByCertRequest($patchUser);
        return (new CspTest())->generateKeys($user);
    }

}
