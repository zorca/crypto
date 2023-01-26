<?php

namespace Apps\Web\Services;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractService;

/**
 * Класс Certificate
 * @version 0.0.1
 * @package Apps\Web\Services\Certificate
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Certificate extends AbstractService
{

    private static $self;
    private $certificate;

    public static function instance()
    {
        if (!self::$self) {
            self::$self = new self();
        }
        return self::$self;
    }

    public function getCertificate()
    {
        $certificate = $this->files->certificate;
        if ($certificate) {
            $certFile = ROOT . 'private' . SEP . 'certificates' . SEP . $certificate->name;
            $dir = dirname($certFile);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            if (move_uploaded_file($certificate->tmp_name, $certFile)) {
                $this->certificate = $certFile;
                return $this->certificate;
            }
        }
    }

}
