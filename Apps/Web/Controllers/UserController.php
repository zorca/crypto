<?php

namespace Apps\Web\Controllers;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Services\CryptoPro\Certificate as Cert;
use Apps\Services\CryptoPro\Curl\Curl as CryptoCurl;
use Apps\Core\Config\Config;
use Apps\Services\CryptoPro\Certificates;
use Apps\Web\Services\Certificate;
use Apps\Web\Services\File;
use Apps\Web\Services\KeysContainer;
use Apps\Services\Scorings\Scorings\Individual;
use Apps\Web\Services\Scorings;
use Apps\Web\Services\Users;
use Apps\Web\Services\GetPin;
use Apps\Core\Request\Put;
use Apps\Web\Services\EquifaxScoringResult;

/**
 * Класс UserController
 * @version 0.0.1
 * @package Apps\Web\Controllers\UserController
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class UserController
{

    public function postContainerAction()
    {
        $pin = GetPin::instance()->get();
        $container = KeysContainer::instance()->setContainer();
        $certificate = Certificate::instance()->getCertificate();
        if ($certificate and $container) {
            $certInfo = (new Cert())->associate($certificate, $container, $pin);
            $certInfo->user = Users::createNewUserByCertificate($certInfo);
            unset(
                $certInfo->user->bindParam,
                $certInfo->user->DB,
                $certInfo->user->className,
                $certInfo->user->tableStructure,
                $certInfo->user->factory,
                $certInfo->user->count
            );
            return $certInfo->user;
        }
        $data['error'] = true;
        if ( ! $certificate) {
            $data['msg'][] = 'Файл сертификата не отправлен';
        }
        if ( ! $container) {
            $data['msg'][] = 'Ключевой контейнер не отправлен';
        }
        return $data;
    }

    public function getListAction()
    {
        $list = (new Certificates())->getList();
        return $list;
    }

    public function putCreateRequestForCertificateAction()
    {
        $patchUser = Users::instance()->createUserForRequestCertificate();
        $dn = Users::instance()->getDn($patchUser);
        $user = Users::instance()->createNewUserByCertRequest($patchUser);
        $data = File::instance()->createCertRequest($dn, $user);
        $result = [
            'request' => $data['request'],
            'container' => File::instance()->createArchive($data['container'])
        ];
        return File::instance()->add($result);
    }

    public function putScoringAction(?string $putch = null)
    {
        $method = Scorings::getMethod($putch);
        $user = Users::instance()->scoringUser();
        $xmlString = null;
        if ($user instanceof Put) {
            $xmlFile = call_user_func_array([new Individual(), $method], [$user]);
            $certificate = new Cert();
            $certificate->sha1 = (new Config())->get('equifax')->certSha1;
            $response = str_replace("\n", ' ', (new CryptoCurl())->send($certificate, $xmlFile));
            if ($response) {
                $xmlString = Scorings::getXml($response);
            }
            return new EquifaxScoringResult($xmlString);
        }
        return $user;
    }

    public function getViewUserAction()
    {
        $user = Users::instance()->getUser();
        $certificates = Certificates::instance()->getCertsList();
        foreach ($certificates as $certificate) {
            if ($certificate->sha1 === $user->thumbprint) {
                $user->certInfo = $certificate;
                unset(
                    $user->DB, $user->count, $user->factory,
                    $user->bindParam, $user->className,
                    $user->tableStructure, $user->certInfo->separator,
                    $user->certInfo->provider->separator
                );
                return $user;
            }
        }
        return ['error' => true, 'message' => 'Не найден пользователь или сертификат'];
    }

}
