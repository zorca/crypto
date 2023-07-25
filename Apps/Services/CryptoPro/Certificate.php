<?php

namespace Apps\Services\CryptoPro;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс Certificate
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Certificate
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Certificate extends Bin
{

    private static $setParamsData = [
        'Издатель' => 'setIssuer',
        'Issuer' => 'setIssuer',
        'Субъект' => 'setSubject',
        'Subject' => 'setSubject',
        'Серийный номер' => 'setSerial',
        'Serial' => 'setSerial',
        'SHA1 отпечаток' => 'setSHA1',
        'SHA1 Thumbprint' => 'setSHA1',
        'Идентификатор ключа' => 'setSubjKeyID',
        'SubjKeyID' => 'setSubjKeyID',
        'Выдан' => 'setValidBefore',
        'Not valid before' => 'setValidBefore',
        'Истекает' => 'setValidAfter',
        'Not valid after' => 'setValidAfter',
        'Алгоритм подписи' => 'setSignAlg',
        'Signature Algorithm' => 'setSignAlg',
        'Алгоритм откр. кл.' => 'setPublicKeyAlgorithm',
        'PublicKey Algorithm' => 'setPublicKeyAlgorithm',
        'Ссылка на ключ' => 'setKeyLink',
        'PrivateKey Link' => 'setKeyLink',
        'Контейнер' => 'setContainer',
        'Container' => 'setContainer',
        'Имя провайдера' => 'setProviderName',
        'Provider Name' => 'setProviderName',
        'Инфо о провайдере' => 'setProvider',
        'Provider Info' => 'setProvider',
        'Тип идентификации' => 'setIdentificationKind',
        'Identification Kind' => 'setIdentificationKind',
        'URL сертификата УЦ' => 'setCaUrl',
        'CA cert URL' => 'setCaUrl',
        'OCSP URL' => 'setCdp',
        'URL списка отзыва' => 'setCdp',
        'CDP'
        ,
        'Назначение/EKU',
        'Extended Key Usage'
    ];
    public $issuer,
        $subject,
        $serial = false,
        $sha1 = false,
        $subjKeyID = false,
        $signature = false,
        $publicKey = false,
        $providerName,
        $privateKey = false,
        $valid_before = false,
        $valid_after = false,
        $container = false,
        $ocsp_url = false;
    public array $ca = [],
        $cdp = [],
        $extended = [];

    public function __construct(string $certInfo = '')
    {
        parent::__construct();
        if ($certInfo) {
            $this->parseCert($certInfo);
        }
    }

    private function parseCert(string $certInfo)
    {
        $this->certData = $certInfo;
        $certData = explode("\n", $this->certData);
        foreach (self::$setParamsData as $key => $method) {
            foreach ($certData as $string) {
                if (preg_match('~(.+)?' . $key . '(.+)?~ui', $string) and method_exists($this, $method)) {
                    $this->$method(trim(preg_replace('~([\w\s\.]+):(.+)~ui', '$2', $string)));
                }
            }
        }
    }

    public function setCaUrl($data)
    {
        if ($this->hasUrl($data)) {
            $this->ca[] = $data;
        }
    }

    public function hasUrl($url)
    {
        $pattern = '~^[http|https](.+)$$~ui';
        if (preg_match($pattern, $url)) {
            return $url;
        }
        return false;
    }

    public function setCdp($data)
    {
        if ($this->hasUrl($data)) {
            $this->cdp[] = $data;
        }
    }

    /**
     * @return bool
     */
    public function isPrivateKey(): bool
    {
        return $this->privateKey;
    }

    public function exportToContainet(string $certFile, $numberContainer = null)
    {
        $exportResult = $this->proc('sudo -u www-data ' . self::bin_patch .
            'certmgr' . ' -export -dest ' . $certFile, $numberContainer);
        $export = str_replace("\n", ';', $exportResult);
        $cert = explode($this->separator,
            preg_replace(['~^(.+)Exporting:(.+)~ui', "~;~ui", '~(={10,})~uim'],
                ['$2', "\n", $this->separator],
                $export)
        );
        unset($cert[0], $cert[2]);
        $certInfo = Certificates::parseCerts($cert[1]);
        return $this->result($certInfo[0], $cert);
    }

    public function viewInStore(string $sn, string $store = self::store)
    {
        $command = 'sudo -u www-data ' . self::bin_patch . 'certmgr' .
            ' -list -store ' . $store . ' -dn SN=' . $sn;
        $data = $this->command($command);
        $count = count($data[0]);
        unset($data[0][$count], $data[0][$count - 1], $data[0][$count - 2], $data[0][$count - 3]);
        $certs = (Certificates::parseCerts(implode("\n", $data[0])))[0];
        return $this->result($certs, $command);
    }

    /**
     * Удалить сертификат
     * @param type $sn
     * @param string $store
     * @return type
     */
    public function delete($sn, string $store = self::store)
    {
        $command = 'sudo -u www-data ' . self::bin_patch . 'certmgr' .
            ' -delete -store ' . $store . ' -dn SN=' . $sn;
        $this->command($command);
        return $this->result(true, $command);
    }

    /**
     * Добавить сертификат в хранилище
     * @param string $certPatch
     * @param string $store
     * @return type
     */
    public function addCert(string $certPatch, string $store = self::store)
    {
        $command = 'sudo -u www-data ' . self::bin_patch . 'certmgr' .
            ' -inst -store ' . $store . ' --file=' . $certPatch;
        $this->command($command);
        return $this->result(true, $command);
    }

    /**
     * экспортировать сертификат в хранилище
     * @param string $certFile
     * @param string $cn
     * @param string $store
     * @return type
     */
    public function export(string $certFile, string $cn, string $store = self::store)
    {
        $command = 'sudo -u www-data ' . self::bin_patch . 'certmgr' .
            ' -export -cert -store ' . $store . ' -dest ' . $certFile .
            ' -dn CN=' . $cn;
        $this->command($command);
        $data = Certificates::instance()->getCertsList($store);
        return $this->result($data, $command);
    }

    /**
     * проверить сертификат
     * @param string $certFile
     * @return type
     */
    public function verify(string $certFile)
    {
        $command = 'sudo -u www-data ' . self::bin_patch . 'cryptcp' .
            ' -verify -errchain -f ' . $certFile;
        $this->command($command);
        return $this->result(true, $command);
    }

    /**
     * Установить сертификат и ассоцыировать его с контейнером
     * @param type $cert
     * @param type $container
     * @return type
     */
    public function associate(string $cert, Container $container, $pin = false)
    {
        $command = 'sudo -u www-data ' . self::bin_patch .
            "certmgr --inst -file '" . $cert . "' -cont '" .
            $container->containerName . "'";
        if ($pin) {
            $command .= " -pin " . $pin;
        }
        $certInfo = ($this->command($command))[0];
        $count = count($certInfo);
        unset($certInfo[$count - 1], $certInfo[$count - 2], $certInfo[$count - 3]);
        $certInf = (Certificates::parseCerts(implode("\n", $certInfo)))[0];
        $this->installRootCerts($certInf->ca);
        #$this->installRootCerts($certInf->cdp);
        $certInf->container = $container;
        return $certInf;
    }

    public function installRootCerts($ca)
    {
        foreach ($ca as $cert) {
            $url = $this->hasUrl($cert);
            if ($url) {
                $this->installRootCert($url);
            }
        }
    }

    public function installRootCert($url)
    {
        $newName = preg_replace('~^(.+)\/([\w\d-]+)\.(\w{3,5})$~ui', '$2.$3', $url);
        $newFile = ROOT . 'private' . SEP . 'certificates' . SEP . 'root' . SEP . $newName;
        $dir = dirname($newFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($newFile)) {
            $get = "cd " . $dir . " && wget " . $url;
            exec($get);
            $this->install($newFile);
        }
    }

    /**
     * Установить сертификат без контейнера
     * @param type $cert
     * @return type
     */
    public function install($cert)
    {
        $command = 'sudo -u www-data ' . self::bin_patch .
            "certmgr --inst -file '" . $cert;
        $this->command($command);
        return $this->result(true, $command);
    }

    private function setProvider($data)
    {
        $this->provider = new Provider();
        $this->provider->type = preg_replace('~(\d+)~ui', '$1', $data[2]);
        $this->provider->flag = trim($data[3]);
    }

    private function setProviderName($data)
    {
        $this->providerName = $data;
    }

    private function setKeyLink($data)
    {
        if ($data === 'Есть' or $data === 'Yes') {
            $this->privateKey = true;
        }
    }

    private function setSignAlg($data)
    {
        $this->signature = trim($data);
    }

    private function setPublicKeyAlgorithm($data)
    {
        $this->publicKey = trim($data);
    }

    private function setContainer($data)
    {
        $this->container = '\\\\.\\' . trim($data);
    }

    private function setIssuer($data)
    {
        $this->issuer = new Issuer($data);
    }

    private function setSubject($data)
    {
        $this->subject = new Subject($data);
    }

    private function setValidBefore($data)
    {
        $this->valid_before = date('Y-m-d H:i:s', strtotime(str_replace('/', '.', $data)));
    }

    private function setValidAfter($data)
    {
        $this->valid_after = date('Y-m-d H:i:s', strtotime(str_replace('/', '.', $data)));
    }

    private function setSHA1($data)
    {
        $this->sha1 = trim($data);
    }

    private function setSerial($data)
    {
        $this->serial = trim($data);
    }

    private function setSubjKeyID($data)
    {
        $this->subjKeyID = trim($data);
    }

    private function setCa($data)
    {
        if ($data !== 'Personal presence') {
            $url = $this->hasUrl(trim($data));
            if ($url) {
                $this->ca[] = $url;
            }
        }
    }

    private function setExtended($data)
    {
        $patterns = ['~(\s+)~ui', '~(.+)Extended([\w\s]+)?:(.+)~ui'];
        $replaces = [' ', '$3'];
        $string = preg_replace($patterns, $replaces, str_replace("\n", ';', $data));
        $arrayData = explode(';', $string);
        foreach ($arrayData as $value) {
            $str = trim($value);
            if ($str) {
                $this->extended[] = trim($value);
            }
        }
    }

    public static function setPfxContainer(string $pfxFile, string $cert, ?string $pin = null): ?self
    {
        $certInfo = false;
        exec(self::bin_patch.'certmgr -list -f "'.$cert.'"', $output, $resultCode);
        if(!$resultCode){
            $certInfo = (Certificates::parseCerts(implode("\n", $output)))[0];
            unset($output);
            $command = ' ' . self::bin_patch .'certmgr -install -pfx -file "'.$pfxFile.'"';
            if($pin){
                $command .= ' -pin '.$pin;
            }
            $command .= ' -silent';
            exec($command, $output, $resultCode);
        }
        if(!$resultCode && $certInfo){
            unset($output);
            $command = self::bin_patch.'certmgr -list -chain -thumbprint '.$certInfo->sha1;
            exec($command, $output, $resultCode);
            $certPfx = (Certificates::parseCerts(implode("\n", $output)))[0];
            $certPfx->subject = $certInfo->subject;
            $certPfx->issuer = $certInfo->issuer;
            return $certPfx;
        }
        return null;
    }

}
