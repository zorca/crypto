<?php

namespace Apps\Services\CryptoPro;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Certificates
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Certificates
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Certificates extends Bin
{

    public function getList()
    {
        $command = ' ' . self::bin_patch . 'certmgr' . ' -list';
        $data = $this->command($command, 'certmgr');
        $certsInfo = $data[0];
        $countElements = count($certsInfo);
        unset($certsInfo[0], $certsInfo[1], $certsInfo[2], $certsInfo[$countElements - 1], $certsInfo[$countElements - 2], $certsInfo[$countElements - 3]);
        $certs = self::parseCerts(implode("\n", $certsInfo));
        return $certs;
    }

    public static function parseCerts(string $certsString): array
    {
        $data = [];
        $separator = self::instance()->separator;
        $certsArrayString = explode($separator, preg_replace('~^(\d+)(-+)~uim', $separator, $certsString));
        unset($certsArrayString[0]);
        foreach ($certsArrayString as $certString) {
            $data[] = new Certificate($certString);
        }
        return $data;
    }

    public static function instance()
    {
        return new self();
    }

    public function export(string $store = self::store)
    {
        $patch = ROOT . 'certificates' . SEP;
        $filePatch = $patch . $store . '.p7b';
        $command = ' ' . self::bin_patch . 'certmgr' . ' -export -cert -store ' . $store . ' -all -dest ' . $filePatch;
        if ( ! is_dir($patch)) {
            mkdir($patch, 0777, true);
        }
        if ( ! file_exists($filePatch)) {
            $result = $this->command($command);
        } else {
            $filePatch = $patch . time() . rand() . '.p7b';
            $result = $this->command($command);
        }
        if ( ! $result[1]) {
            return $filePatch;
        }
        return false;
    }

    public function import(string $certificate, string $store = self::store)
    {
        if (mb_strtolower($store) === 'ca') {
            $storeCommand = '-crl -store CA ';
        } elseif (mb_strtolower($store) === 'root') {
            $storeCommand = '-store root';
        }
        $command = ' ' . self::bin_patch . 'certmgr' . self::$env . ' -inst -all ' . $storeCommand . ' -file ' . $certificate;
        $result = $this->command($command);
        if ( ! $result[1]) {
            return $this->getCertsList($store);
        }
        return false;
    }

    public function getCertsList(string $store = self::store)
    {
        $command = ' ' . self::bin_patch . 'certmgr' . ' -list -store ' . $store;
        $data = $this->command($command);
        $count = count($data[0]);
        unset($data[0][$count - 1], $data[0][$count - 2], $data[0][$count - 3], $data[0][0], $data[0][1], $data[0][2]);
        $certs = self::parseCerts(implode("\n", $data[0]));
        foreach ($certs as $key => $cert) {
            $cert->extended = [];
            $certs[$key] = $cert;
        }
        return $certs;
    }

}
