<?php

declare(strict_types=1);

namespace Apps\Web\Services;

use CloudCastle\FileSystem\File;
use ZipArchive;

/**
 * Класс Archive
 * @version 0.0.1
 * @package Apps\Web\Services
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
final class Archive
{

    public ?File $file = null;
    public $zip = null;

    public function __construct(string $file)
    {
        $this->file = File::info($file);
        $this->zip = new ZipArchive();
    }

    public function create()
    {
        $fileName = $this->file->path . SEP . preg_replace('~([^\w\.])~ui', '_', str_replace($this->file->extension, '', $this->file->basename)) . 'zip';
        $this->zip->file = false;
        $archive = $this->zip->open($fileName, ZipArchive::CREATE);
        if ($archive) {
            $this->zip->addFile($this->file->realPath, $this->file->basename);
            $this->zip->close();
            $this->zip->file = File::info($fileName);
        }
        return $this->zip;
    }

}
