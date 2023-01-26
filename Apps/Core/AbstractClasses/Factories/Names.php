<?php

namespace Apps\Core\AbstractClasses\Factories;

/**
 * Трейт Names
 * @version 0.0.1
 * @package Apps\Core\AbstractClasses\Factories
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
trait Names
{

    protected static array $names = [
        ''
    ];

    protected function getName()
    {
        return array_rand(self::$names);
    }

}
