<?php

namespace Apps\Services\CryptoPro;

if ( ! defined('ROOT')) {
    exit();
}

class License extends Bin
{

    public string $license;
    public string $expires;
    public string $type;

    public function set(string $license)
    {
        $setUserLicense = ' ' . self::$sbin_patch . 'cpconfig -license -setlocal ' . mb_strtoupper(trim($license));
        $this->command($setUserLicense);
        return $this->result($this->view());
    }

    public function view()
    {
        $command = ' ' . self::$sbin_patch . 'cpconfig -license -view';
        $data = $this->command($command);
        return $this->result($this->parseLicinseInfo($data[0]));
    }

    private function parseLicinseInfo($data)
    {
        $this->license = $data[1];
        $this->expires = trim(preg_replace('~Expires:(.+)~ui', '$1', $data[2]));
        $this->type = trim(trim(preg_replace('~License type:(.+)~ui', '$1', $data[3])), '.');
        return $this;
    }

}
