<?php

namespace Apps\Core\Request;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс Patch
 * @version 0.0.1
 * @package Apps\Core\Request\Patch
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Patch
{

    use RequestTrait;

    public function __construct()
    {
        $patch = json_decode(file_get_contents('php://input'));
        if ($patch) {
            foreach ($patch as $key => $value) {
                $this->setValue($value, $key);
            }
        }
    }

}
