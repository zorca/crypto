<?php

namespace Apps\Web\Services;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractService;
use Apps\Services\CryptoPro\Container;
use Apps\Services\CryptoPro\Info;
use ZipArchive;

/**
 * Класс KeysContainer
 * @version 0.0.1
 * @package Apps\Web\Services\KeysContainer
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class KeysContainer extends AbstractService
{

    private static $self;
    private $container;

    public static function instance(): self
    {
        if (!self::$self) {
            self::$self = new self();
        }
        return self::$self;
    }

    public function getContainer()
    {
        return $this->run();
    }

    public function setContainer()
    {
        $archive = $this->files->container;
        $zip = new ZipArchive;
        $dir = Container::getKeyRepo();
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (isset($archive->tmp_name) and $archive->tmp_name and $zip->open($archive->tmp_name) === true) {
            $zip->extractTo($dir);
            $zip->extractTo(dirname($dir));
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $entity = $zip->getNameIndex($i);
                $file = $dir . SEP . $entity;
                if (is_dir($file)) {
                    $containerName = trim(trim($entity, SEP), '.000');
                    $this->container = $this->getContainerInfo($containerName);
                }
            }
            $zip->close();
            return $this->container;
        }
    }

    private function getContainerInfo($containerName)
    {
        $containersData = new Info();
        $containers = $containersData->viewContainers();
        foreach ($containers as $container) {
            if (preg_match('~(.+)?' . $containerName . '(.+)?~ui', $container->containerName)) {
                return $container;
            }
        }
    }

}
