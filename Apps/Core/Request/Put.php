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
class Put
{

    use RequestTrait;

    public function __construct()
    {
        $patch = json_decode(file_get_contents('php://input'));
        if ($patch) {
            $class = new PhpInput();
            foreach ($patch as $key => $value) {
                $this->set($key, $value, $class);
            }
            foreach ($class as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    private function set($name, $value, $class)
    {
        if (!is_object($value)) {
            $class->$name = $value;
        } else {
            $newClass = new PhpInput();
            foreach ($value as $key => $objValue) {
                $data = $this->set($key, $objValue, $newClass);
            }
            $class->$name = $data;
        }
        return $class;
    }

}
