<?php

namespace Apps\Models\Load;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractModel;

/**
 * Класс Load
 * @version 0.0.1
 * @package Apps\Models\Load\Load
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Load extends AbstractModel
{

    use TableStructure,
        Factory;

    public string $className = __CLASS__;

}
