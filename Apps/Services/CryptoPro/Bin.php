<?php

namespace Apps\Services\CryptoPro;

use Apps\Core\Config\Config;

/**
 * Трейт Bin
 * @version 0.0.1
 * @package Apps\Services\CryptoPro
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
abstract class Bin
{

    const tmpDir = TMP . 'crypto-pro' . SEP;
    const store = 'uMy';

    public static $errorFile = self::tmpDir . 'e.txt';
    public static $keys_patch = '/var/opt/cprocsp/keys/';
    public static $env;

    const bin_patch = '/opt/cprocsp/bin/amd64/';

    protected static $sbin_patch = '/opt/cprocsp/sbin/amd64/';

    const ext = '';

    protected static array $data;
    public string $separator = '--|||--';
    protected $error;

    public function __construct()
    {
        $string = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
        self::$data = str_split($string);
        $config = new Config();
        $setting = $config->get('cryptopro-service');
        foreach ($setting as $key => $value) {
            if (isset(self::${$key})) {
                self::${$key} = $value;
            }
        }
        if ( ! is_dir(self::tmpDir)) {
            mkdir(self::tmpDir, 0777, true);
        }
        self::$env = \Apps\Core\Config\Env::instance()->load()->toArray();
        file_put_contents(self::$errorFile, '');
    }

    public function proc($command, $input = null)
    {
        $pipes = [];
        $descriptorspec = array (
            0 => ["pipe", "r+"],
            1 => ["pipe", "w+"],
            2 => ["file", self::$errorFile, "a"]
        );
        $process = proc_open($command, $descriptorspec, $pipes, self::tmpDir, self::$env);
        if (is_resource($process)) {
            fwrite($pipes[0], $input);
            fclose($pipes[0]);
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            proc_close($process);
            $this->error[$command] = (bool)file_get_contents(self::$errorFile);
            return $output;
        }
        return false;
    }

    public function getFormat($format)
    {
        if ($format) {
            return '-der';
        }
        return '';
    }

    public function __destruct()
    {
        $command = 'sudo chmod 777 -R ' . self::$keys_patch;
        $this->command($command);
        $msg = PHP_EOL . PHP_EOL . date('d.m.Y H:i:s') . ' - ';
        foreach ($this->error as $key => $value) {
            $msg .= $key . ' - ' . $value . PHP_EOL;
        }
        $file = ROOT . 'logs' . SEP . date('d.m.Y') . SEP . 'error_crypto.log';
        $dir = dirname($file);
        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($file, $msg, LOCK_EX | FILE_APPEND);
    }

    public function command(string $command)
    {
        $output = false;
        $resultCode = 10000;
        exec($command, $output, $resultCode);
        $this->error[$command] = $resultCode;
        return [$output, $resultCode];
    }

    protected function result($data = true, $command = false)
    {
        if ( ! isset($this->error[$command]) or ! $this->error[$command]) {
            return $data;
        }
        return false;
    }

}
