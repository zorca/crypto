<?php

namespace Apps\Web\Services;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractService;

/**
 * Класс Message
 * @version 0.0.1
 * @package Apps\Web\Services\Message
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Message extends AbstractService
{

    private static $self;

    public static function instance(): self
    {
        if ( ! self::$self) {
            self::$self = new self();
        }
        return self::$self;
    }

    public function getMessage($name = 'txt')
    {
        $messageFile = ROOT . 'private' . SEP . 'messages' . SEP . date('i:H-d.m.Y') . SEP . time() . '.' . $name;
        $dir = dirname($messageFile);
        $message = $this->post->message;
        if ( ! empty($message)) {
            if ( ! is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            if (file_put_contents($messageFile, $message)) {
                return $messageFile;
            }
        }
        return false;
    }

}
