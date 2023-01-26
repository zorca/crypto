<?php

declare(strict_types=1);

namespace Apps\Web\Services;

use Apps\Core\Config\Config;
use Apps\Services\CryptoPro\Bin;

/**
 * Класс Signaiter
 * @version 0.0.1
 * @package Apps\Web\Services
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
final class Signaiter
{

    public ?string $file = null;
    public ?string $binPatch = null;
    public ?string $sgn = null;
    public ?string $certHash = null;
    private ?Config $config = null;
    private ?string $crypCertSha1 = null;

    public function __construct(string $file)
    {
        $this->bin = 'sudo -u www-data ' . Bin::bin_patch . 'cryptcp' . Bin::ext;
        $this->binPatch = 'sudo -u www-data ' . Bin::bin_patch;
        $this->file = $file;
        $this->config = new Config('equifax');
        if ($this->config->test) {
            $this->crypCertSha1 = $this->config->cryptTestCertSha1;
        } else {
            $this->crypCertSha1 = $this->config->cryptProdCertSha1;
        }
    }

    public function sign(): self
    {
        if ($this->file) {
            $newFile = $this->file . '.sgn';
            $command = $this->bin . " -sign "
                . "-thumbprint " . $this->config->certSha1 . " -nochain "
                . "-der '" . $this->file . "' '" . $newFile . "'";
            exec($command);
            unlink($this->file);
            $this->sgn = $newFile;
        }
        return $this;
    }

    public function encrypt(): self
    {
        if ($this->sgn) {
            $newFile = $this->sgn . '.enc';
            $command = $this->bin . " -encr " . " -thumbprint " . $this->crypCertSha1 . " -der '" .
                $this->sgn . "' '" . $newFile . "'";
            exec($command);
            $this->file = $newFile;
            unlink($this->sgn);
        }
        return $this;
    }

}
