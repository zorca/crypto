<?php

namespace Apps\Web\Services;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractService;
use Apps\Models\Users\Users;
use Apps\Services\CryptoPro\CrypTCP\CrypTCP;
use ZipArchive;

/**
 * Класс File
 * @version 0.0.1
 * @package Apps\Web\Services\File
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class File extends AbstractService
{

    private $file = false;
    private string $name = 'file';
    private string $dir = ROOT . 'private' . SEP . 'request' . SEP;

    public function getFile(string $name = 'file')
    {
        $this->name = $name;
        return $this->run();
    }

    public function run()
    {
        $this->getFilesFile();
        $this->getPostFile();
        return $this->file;
    }

    protected function getFilesFile()
    {
        $file = $this->files->{$this->name};
        if ($file) {
            $filePatch = ROOT . 'private' . SEP . $this->name . SEP . date('d.m.Y') . SEP . $file->name;
            if ( ! is_dir(dirname($filePatch))) {
                mkdir(dirname($filePatch), 0777, true);
            }
            if (move_uploaded_file($file->tmp_name, $filePatch)) {
                $this->file = $filePatch;
                return true;
            }
        }
        return false;
    }

    private function getPostFile()
    {
        $file = $this->post->file;
        $fileName = $this->post->file_name;
        if ($file and $fileName) {
            $filePatch = ROOT . 'private' . SEP . $this->name . SEP . $fileName;
            if ( ! is_dir(dirname($filePatch))) {
                mkdir(dirname($filePatch), 0777, true);
            }
            if (file_put_contents($filePatch, base64_decode($file))) {
                $this->file = $filePatch;
                return true;
            }
        }
        return false;
    }

    public function add($crypt)
    {
        $data = [];
        $link = strtolower('https://' . $this->server->SERVER_NAME . '/');
        foreach ($crypt as $key => $value) {
            if ($value !== true and $value) {
                $alias = $this->generateUniString();
                $file = new \Apps\Models\Load\Load();
                $file->type = $key;
                $file->file = $value;
                $file->alias = $alias;
                $file->flag = 0;
                if (file_exists($file->file)) {
                    $newFile = $file->save();
                    $data[$key] = $link . 'load/' . $newFile->alias;
                }
            }
        }
        return $data;
    }

    public function createCertRequest(string $dn, Users $user)
    {
        $this->file = $this->dir . date("d.m.Y") . SEP . md5(json_encode($user)) . '.csr';
        $dir = dirname($this->file);
        if ( ! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $user->Containers = (new \Apps\Services\CryptoPro\Info())->viewContainers();
        $result = (new CrypTCP($this->file, $user))->createCertRequest($dn, $user);
        return $result;
    }

    public function createArchive($container)
    {
        $patch = $container->dir;
        $name = basename($patch);
        $files = scandir($patch);
        $archive = $this->dir . date("d.m.Y") . SEP . $name . '.zip';
        $zip = new ZipArchive();
        if ($zip->open($archive, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($files as $file) {
                $zipFile = $patch . SEP . $file;
                if (is_file($zipFile)) {
                    $zip->addFile($zipFile, $name . SEP . $file);
                }
            }
            $zip->close();
            if (is_file($archive)) {
                return $archive;
            }
        }
        return false;
    }

}
