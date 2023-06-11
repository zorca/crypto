<?php

namespace Apps\Core\AbstractClasses;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\Apps\Container;
use Apps\Core\Request\Files;
use Apps\Core\Request\Get;
use Apps\Core\Request\Patch;
use Apps\Core\Request\Post;
use Apps\Core\Request\Request;
use Apps\Core\Request\Server;

/**
 * Класс AbstractService
 * @version 0.0.1
 * @package Apps\Core\AbstractClasses\AbstractService
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
abstract class AbstractService extends Container
{

    private static array $obj;
    public Request $request;
    public Server $server;
    public Files $files;
    public Patch $patch;
    public Post $post;
    public Get $get;

    public function __construct()
    {
        $this->request = Request::instance();
        $this->server = Server::instance();
        $this->files = Files::instance();
        $this->patch = Patch::instance();
        $this->post = Post::instance();
        $this->get = Get::instance();
    }

    public static function instance()
    {
        $className = get_called_class();
        if ( ! isset(self::$obj[$className])) {
            self::$obj[$className] = new $className();
        }
        return self::$obj[$className];
    }

    public function phoneFormat(string $phone = '')
    {
        if ( ! empty(trim($phone))) {
            $phone = preg_replace('~([^\d])~ui', '', $phone);
        }
        return $phone;
    }

    public function generateUniString()
    {
        $lenght = rand(30, 40);
        $array = str_split("QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890");
        $str = '';
        for ($i = 0;
            $i < $lenght;
            $i ++) {
            $str .= $array[array_rand($array)];
        }
        return $str;
    }

}
