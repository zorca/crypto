<?php

namespace Apps\Web\Services;

if ( ! defined('ROOT')) {
    exit();
}

use \SimpleXMLElement;

/**
 * Класс Scorings
 * @version 0.0.1
 * @package Apps\Web\Services\Scorings
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class Scorings
{

    private static $dir = ROOT . 'private' . SEP . 'xml' . SEP . 'result' . SEP;

    public static function getXml(string $signString)
    {
        $validString = str_replace(["\n", "\t"], ' ', $signString);
        $validXml = stristr(stristr($validString, '<?xml'), '</bki_response>', true) . '</bki_response>';
        if ($validXml) {
            $xmlObj = new SimpleXMLElement($validXml);
            self::saveResult($validXml);
            return $xmlObj;
        }
        return false;
    }

    public static function getMethod(?string $putch = null): string
    {
        if (mb_strtolower($putch) === 'info') {
            return 'info';
        }
        return 'scoring';
    }

    private static function saveResult($content)
    {
        $file = self::$dir . date('d.m.Y') . SEP . time() . rand() . '.xml';
        $dir = dirname($file);
        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($file, $content);
        return $file;
    }

}
