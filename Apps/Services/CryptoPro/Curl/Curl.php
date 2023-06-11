<?php

namespace Apps\Services\CryptoPro\Curl;

if ( ! defined('ROOT')) {
    exit();
}

use \Apps\Services\CryptoPro\Bin;
use \Apps\Services\CryptoPro\Certificate;

/**
 * Класс Curl
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Curl\Curl
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class Curl extends Bin
{

    private static string $outFile = self::tmpDir . 'curl_result.txt';
    private static string $dumpFile = self::tmpDir . 'curl_dump.txt';
    private static string $cryptoCurl = self::bin_patch . 'curl' . self::ext;

    public function send(Certificate $certificate, string $file,
        string $headers = 'Content-Type:application/octet-stream; charset=windows-1251'
    ): string
    {
        $config = (new \Apps\Core\Config\Config)->get('equifax');
        if ($config->test) {
            $url = 'https://bki-b2b-test.scoring.ru/cr4.php';
        } else {
            $url = $config->url;
        }
        $result = false;
        $sign = " " . self::bin_patch .
            'cryptcp -sign -thumbprint ' . $certificate->sha1 . ' -der ' .
            $file . ' ' . $file . '.sig';
        exec($sign);
        $command = " " . self::$cryptoCurl . " -X POST -E {$certificate->sha1} {$url} -o " .
            self::$outFile . " -v --header '{$headers}' --trace-ascii " .
            self::$dumpFile . " --data-binary @'{$file}.sig'";
        exec($command);
        if (is_file(self::$outFile)) {
            $result = file_get_contents(self::$outFile);
            unlink(self::$outFile);
            #unlink($file);
            unlink($file . '.sig');
        }
        return $result;
    }

}
