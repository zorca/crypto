<?php

namespace Apps\Core\AbstractClasses;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\Factories\Names;
use Apps\Core\Apps\Container;
use Apps\Core\Interfaces\ModelFactoryInterface;

/**
 * Класс AbstractFactory
 * @version 0.0.1
 * @package Apps\Core\AbstractClasses\AbstractFactory
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
abstract class AbstractFactoryModel extends Container implements ModelFactoryInterface
{

    use Names;

    public function getFactory()
    {
        if (isset($this->factory) and $this->factory) {
            return $this->factory;
        }
        return false;
    }

}
