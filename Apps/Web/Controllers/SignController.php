<?php

namespace Apps\Web\Controllers;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractController;
use Apps\Services\CryptoPro\CrypTCP\CrypTCP;
use Apps\Web\Services\File;
use Apps\Web\Services\GetPin;
use Apps\Web\Services\Message;
use Apps\Web\Services\Users;

/**
 * Класс SignController
 * @version 0.0.1
 * @package Apps\Web\Controllers\SignController
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class SignController extends AbstractController
{

    public function postSignFileAction()
    {
        $pin = GetPin::instance()->get();
        $format = File::instance()->get->get('format', 'string');
        $user = Users::instance()->getUser();
        $file = File::instance()->getFile('file');
        if ($file and $user) {
            $crypt = new CrypTCP($file, $user);
            $data = $crypt->enCrypt($format, $pin)
                ->createHash($pin)
                ->createSingf($pin)
                ->createSing($pin)
                ->addSign($pin)
                ->addSignf($pin)
                ->toArray();
            return File::instance()->add($data);
        }
        $data['error'] = true;
        if (!$user) {
            $data['msg'][] = 'Не передан или не верно указан id пользователя';
        }
        if (!$file) {
            $data['msg'][] = 'Не передан файл для подписи';
        }
        return $data;
    }

    public function postExtractFileAction()
    {
        $pin = GetPin::instance()->get();
        $user = Users::instance()->getUser();
        $file = File::instance()->getFile('file');
        if ($file and $user) {
            $crypt = new CrypTCP($file, $user);
            $data = $crypt->deCrypt($pin)
                ->createHash($pin)
                ->createSingf($pin)
                ->createSing($pin)
                ->addSign($pin)
                ->addSignf($pin)
                ->toArray();
            return File::instance()->add($data);
        }
        $data['error'] = true;
        if (!$user) {
            $data['msg'][] = 'Не передан или не верно указан id пользователя';
        }
        if (!$file) {
            $data['msg'][] = 'Не передан файл для расшифровки';
        }
        return $data;
    }

    public function postExtractMessageAction()
    {
        $pin = GetPin::instance()->get();
        $message = Message::instance()->getMessage();
        $user = Users::instance()->getUser();
        if ($message and $user) {
            $crypt = new CrypTCP($message, $user);
            $data = $crypt->deCrypt($pin)
                ->createHash($pin)
                ->createSingf($pin)
                ->createSing($pin)
                ->addSign($pin)
                ->addSignf($pin)
                ->toArray();
            return File::instance()->add($data);
        }
        $data['error'] = true;
        if (!$user) {
            $data['msg'][] = 'Не передан или не верно указан id пользователя';
        }
        if (!$message) {
            $data['msg'][] = 'Не передано сообщение для подписи';
        }
        return $data;
    }

    public function postSignMessageAction()
    {
        $pin = GetPin::instance()->get();
        $format = Message::instance()->get->get('format', 'string');
        $message = Message::instance()->getMessage('msg');
        $user = Users::instance()->getUser();
        if ($message and $user) {
            $crypt = new CrypTCP($message, $user);
            $data = $crypt->enCrypt($format, $pin)
                ->createHash($pin)
                ->createSingf($pin)
                ->createSing($pin)
                ->addSign($pin)
                ->addSignf($pin)
                ->toArray();
            return File::instance()->add($data);
        }
        $data['error'] = true;
        if (!$user) {
            $data['msg'][] = 'Не передан или не верно указан id пользователя';
        }
        if (!$message) {
            $data['msg'][] = 'Не передано сообщение для расшифровки';
        }
        return $data;
    }

}
