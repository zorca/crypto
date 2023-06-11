<?php

namespace Apps\Models\Users;

if ( ! defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractModel;

/**
 * Класс Users
 * @version 0.0.1
 * @package Apps\Models\Users\Users
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Users extends AbstractModel
{

    use TableStructure,
        Factory;

    public string $className = __CLASS__;

}
