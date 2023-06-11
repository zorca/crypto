<?php

namespace Apps\Services\CryptoPro;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Models\Users\Users;

/**
 * Класс Signaiter
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Signaiter
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Signaiter extends Bin
{

    public function signFile(string $file, Users $user)
    {
        if (file_exists($file)) {
            $ext = 'sig';
            $command = ' ' . self::bin_patch . 'cryptcp' . ' -sign' .
                $this->getComandString('fullInfo', $user) . ' -der ' .
                " '" . $file . "' '" . $file . "." . $ext . "'";
            $this->proc($command);
            if ( ! $this->error[$command] and is_file($file . '.' . $ext)) {
                return ['file' => $file, 'sign' => $file . '.' . $ext];
            }
        }
        return false;
    }

    private function getComandString($dataName, $user)
    {
        switch (mb_strtolower($dataName)) {
            case 'family':
                return "-dn 'SN=" . $user->{'last_name'} . "'";
            case 'fullname':
                return "-dn 'CN=" . $user->{'full_name_company'} . "'";
            case 'email':
                return "-dn 'E=" . $user->email . "'";
            case 'fullinfo':
                return "-dn 'SN=" . $user->{'last_name'} . ","
                    . "CN=" . $user->{'full_name_company'} . ","
                    . "G=" . $user->{'name'}
                    . "'";
            default:
                $string = "-thumbprint " . $user->thumbprint;
                return $string;
        }
    }

    public function verify(string $file)
    {
        $command = ' ' . self::bin_patch . 'cryptcp' . " -verify '" . $file . "'";
        $this->command($command);
        return $this->result(true, $command);
    }

    public function extractFile(string $signFile)
    {
        $newFile = str_replace(['.sig', '.msg'], '', $signFile);
        $command = ' ' . self::bin_patch . 'cryptcp' . " -verify '" . $signFile . "' '" . $newFile . "'";
        $this->command($command);
        if ( ! $this->error[$command] and is_file($newFile)) {
            return ['file' => $newFile, 'sign' => $signFile];
        }
    }

    public function extractMessage(string $signFile, Users $user)
    {
        $newFile = $signFile . '.msg';
        $command = ' ' . self::bin_patch . 'cryptcp' . " -verify -thumbprint " . $user->thumbprint . " '" . $signFile . "' '" . $newFile . "'";
        $this->command($command);
        if ( ! $this->error[$command] and is_file($newFile)) {
            return ['msg' => $newFile, 'crypt' => $signFile];
        }
    }

    public function signMessage(string $fileMessage, Users $user, string $format = 'der')
    {
        $newFile = $fileMessage . '.msg';
        if (mb_strtoupper($format) === 'DER') {
            $format = '-DER';
        } else {
            $format = '';
        }
        $command = ' ' . self::bin_patch . 'cryptcp' . " -sign -thumbprint " . $user->thumbprint . " " .
            " '" . $fileMessage . "' '" . $newFile . "'";
        $this->proc($command);
        if ( ! $this->error[$command] and is_file($newFile)) {
            return ['msg' => $fileMessage, 'sign' => $newFile];
        }
    }

}
