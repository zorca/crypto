<?php

namespace Apps\Core\Request;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Post
 * @version 0.0.1
 * @package Apps\Core\Request\Request
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Post
{

    use RequestTrait;

    public function __construct()
    {
        foreach ($_POST as $key => $value) {
            $this->setValue($value, $key);
        }
    }

}
