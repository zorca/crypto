<?php

namespace Apps\Services\CryptoPro\CrypTCP;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Models\Users\Users;
use Apps\Services\CryptoPro\Bin;

/**
 * Класс CrypTCP
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\CrypTCP\CrypTCP
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class CrypTCP extends Bin
{

    static private array $arrayInput = [
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
        'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P',
        'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z',
        'X', 'C', 'V', 'B', 'N', 'M',
        'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p',
        'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z',
        'x', 'c', 'v', 'b', 'n', 'm'
    ];
    public $hash,
        $crypt,
        $file,
        $sgn,
        $addSignf,
        $decr,
        $msg;
    private Users $user;

    public function __construct(string $file, Users $user)
    {
        parent::__construct();
        $this->user = $user;
        $this->file = $file;
    }

    public function enCrypt(string $format = '', $pin = false)
    {
        $f = $this->getFormat($format);
        $ext = 'p7e';
        $newFile = $this->file . '.' . $ext;
        $command = ' ' . self::bin_patch . "cryptcp -encr " .
            $f . " -thumbprint " . $this->user->thumbprint . " '" .
            $this->file . "' '" . $newFile . "'";
        if ($pin) {
            $command .= " -pin " . $pin;
        }
        $this->proc($command, 'Y');
        if ( ! $this->error[$command] and file_exists($newFile) and file_exists($this->file)) {
            $this->crypt = $newFile;
        }
        return $this;
    }

    public function deCrypt($pin = false)
    {
        $this->crypt = $this->file;
        $newFile = preg_replace('~(.+)\.(\w+)$~ui', '$1', $this->file);
        $command = ' ' . self::bin_patch . "cryptcp" .
            " -decr -thumbprint " . $this->user->thumbprint . " '" . $this->file . "' '" . $newFile . "'";
        if ($pin) {
            $command .= " -pin " . $pin;
        }
        $this->command($command);
        $this->proc($command, 'Y');
        if ( ! $this->error[$command] and file_exists($newFile) and file_exists($this->file)) {
            $this->file = $newFile;
        }
        return $this;
    }

    public function createHash()
    {
        $newFile = $this->file . '.hsh';
        $command = ' ' . self::bin_patch . "cryptcp -hash -provtype 75 -dir '" . dirname($this->file) . "' '" . $this->file . "'";
        $this->command($command);
        if ( ! $this->error[$command] and file_exists($newFile) and file_exists($this->file)) {
            $this->hash = $newFile;
        }
        return $this;
    }

    public function createSingf($pin = false)
    {
        $newFile = $this->file . '.sgn';
        $command = ' ' . self::bin_patch . "cryptcp" . self::ext .
            " -signf -dir '" . dirname($this->file) .
            "' -thumbprint " . $this->user->thumbprint . " '" . $this->file . "'";
        if ($pin) {
            $command .= " -pin " . $pin;
        }
        $this->proc($command, 'Y');
        if ( ! $this->error[$command] and file_exists($newFile) and file_exists($this->file)) {
            $this->sgn = $newFile;
        }
        return $this;
    }

    public function createSing($pin = false)
    {
        $newFile = $this->file . '.sig';
        $command = ' ' . self::bin_patch . "cryptcp" . self::ext .
            " -sign -dir '" . dirname($this->file) .
            "' -thumbprint " . $this->user->thumbprint . " '" . $this->file . "'";
        if ($pin) {
            $command .= " -pin " . $pin;
        }
        $this->proc($command, 'Y');
        if ( ! $this->error[$command] and file_exists($newFile) and file_exists($this->file)) {
            $this->sig = $newFile;
            $this->msg = $newFile;
        }
        return $this;
    }

    public function addSignf($pin = false)
    {
        $command = ' ' . self::bin_patch . "cryptcp" . self::ext .
            " -addsignf -dir '" . dirname($this->file) .
            "' -thumbprint " . $this->user->thumbprint . " '" . $this->file . "'";
        if ($pin) {
            $command .= " -pin " . $pin;
        }
        $this->proc($command, 'Y');
        if ( ! $this->error[$command] and file_exists($this->file)) {
            $this->addSignf = true;
        }
        return $this;
    }

    public function addSign($pin = false)
    {
        $command = ' ' . self::bin_patch . "cryptcp" . self::ext .
            " -addsign -m -dir '" . dirname($this->file) .
            "' -thumbprint " . $this->user->thumbprint . " '" . $this->file . "'";
        if ($pin) {
            $command .= " -pin " . $pin;
        }
        $this->command($command);
        if ( ! $this->error[$command] and file_exists($this->file)) {
            $this->addSign = true;
        }
        return $this;
    }

    public function toArray()
    {
        unset($this->user, $this->error, $this->separator);
        return (array)$this;
    }

    public function createCertRequest($dn)
    {
        $container = $this->getRandContainer($this->user->Containers);
        $containerName = $container->patch;
        $command = ' ' . self::bin_patch . "cryptcp" .
            ' -creatrqst ' . $this->file .
            ' -both -km -cont \'' . $containerName .
            '\' -nokeygen -dn ' . $dn;
        $this->command($command);
        return $this->result(['request' => $this->file, 'container' => $container], $command);
    }

    private function getRandContainer(array $containers)
    {
        $countCounainers = count($containers);
        if (($countCounainers - 1) === 0) {
            $containerIndex = 0;
        } else {
            $containerIndex = rand(0, ($countCounainers - 1));
        }
        return $containers[$containerIndex];
    }

    private function contNameGenerate()
    {
        $name = '';
        for ($i = 0; $i < 8; $i ++) {
            $name .= $this->getRand();
        }
        $name .= '.000';
        return $name;
    }

    function getRand()
    {
        return self::$arrayInput[array_rand(self::$arrayInput)];
    }

    public function __destruct()
    {

    }

}
