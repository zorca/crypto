<?php

namespace Apps\Web\Services;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractService;
use Apps\Core\Request\Patch;

/**
 * Класс Users
 * @version 0.0.1
 * @package Apps\Web\Services\Users
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Users extends AbstractService
{

    static $obj;
    private $user;
    private $id;
    private $phone;
    private $uid;
    private $email;

    public static function instance(): self
    {
        if ( ! self::$obj) {
            self::$obj = new self();
        }
        return self::$obj;
    }

    public static function createNewUserByCertificate($certInfo)
    {
        $cert = false;
        $user = new \Apps\Models\Users\Users();
        foreach (\Apps\Services\CryptoPro\Certificates::instance()->getList() as $cert) {
            if (mb_strtoupper($cert->subject->data) === mb_strtoupper($certInfo->subject->data)) {
                $certInfo = $cert;
                break;
            }
        }
        if ( ! $cert) {
            $cert = $certInfo;
        }
        $user->container = $cert->container->containerName;
        $user->thumbprint = $cert->sha1;
        foreach ($certInfo->subject as $key => $value) {
            $user->$key = $value;
        }
        return $user->save();
    }

    public function getUser()
    {
        $this->run();
        if ($this->id) {
            return $this->Users->getById($this->id, 1);
        }
        if ($this->email) {
            return $this->Users->getByEmail($this->email, 1);
        }
        if ($this->uid) {
            return $this->Users->getByUid($this->uid, 1);
        }
        if ($this->phone) {
            return $this->Users->getByPhone($this->phone, 1);
        }
    }

    public function run()
    {
        $this->setEmail();
        $this->setId();
        $this->setPhone();
        $this->setUid();
    }

    private function setEmail()
    {
        $email = $this->post->email;
        if ( ! $email) {
            $email = $this->get->email;
        }
        $this->email = $email;
    }

    private function setId()
    {
        $id = $this->post->get('user_id', 'int');
        if ( ! $id) {
            $id = $this->get->get('user_id', 'int');
        }
        $this->id = $id;
    }

    private function setPhone()
    {
        $phone = $this->post->phone;
        if ( ! $phone) {
            $phone = $this->get->phone;
        }
        $this->phone = $this->phoneFormat($phone);
    }

    private function setUid()
    {
        $uid = $this->post->uid;
        if ( ! $uid) {
            $uid = $this->get->uid;
        }
        $this->uid = $uid;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUid()
    {
        return $this->uid;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function createUserForRequestCertificate()
    {
        return $this->patch;
    }

    public function getDn(Patch $user): string
    {
        $str = '';
        ! empty($user->country)?$str .= 'C="' . $user->country . '"':null;
        ! empty($user->region)?$str .= ', S="' . $user->region . '"':null;
        ! empty($user->city)?$str .= ', L="' . $user->city . '"':null;
        ! empty($user->street)?$str .= ', STREET="' . $user->street . '"':null;
        ! empty($user->name_company)?$str .= ', O="' . $user->name_company . '"':null;
        ! empty($user->full_name_company)?$str .= ', CN="' . $user->full_name_company . '"':null;
        ! empty($user->name)?$str .= ', G="' . $user->name . '"':null;
        ! empty($user->last_name)?$str .= ', SN="' . $user->last_name . '"':null;
        ! empty($user->official)?$str .= ', T="' . $user->official . '"':null;
        #!empty($user->snils) ? $str .= ', СНИЛС="' . $user->snils . '"' : null;
        #!empty($user->ogrn) ? $str .= ', ОГРН="' . $user->ogrn . '"' : null;
        #!empty($user->inn_yl) ? $str .= ', "ИНН ЮЛ"="' . $user->inn_yl . '"' : null;
        ! empty($user->INN)?$str .= ', ИНН="' . $user->INN . '"':null;
        ! empty($user->email)?$str .= ', E="' . $user->email . '"':null;
        return $this->getDnValue($str);
    }

    private function getDnValue($value)
    {
        return json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function createNewUserByCertRequest(Patch $patchUser)
    {
        $user = new \Apps\Models\Users\Users();
        foreach ($patchUser as $key => $value) {
            $user->$key = $value;
        }
        return $user;
    }

    private static array $userPutFilds = [
        'last',
        'first',
        'middle',
        'gender',
        'doc',
        'birthday'
    ];

    public function scoringUser()
    {
        $error = [];
        $user = new \Apps\Core\Request\Put();
        foreach (self::$userPutFilds as $value) {
            if ( ! $user->get($value)) {
                $error[] = 'не указано свойство ' . $value;
            }
        }
        if ($error) {
            return $error;
        }
        return $user;
    }

}
