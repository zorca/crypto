<?php

namespace Apps\Web\Controllers;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\AbstractClasses\AbstractController;

/**
 * Класс LoadController
 * @version 0.0.1
 * @package Apps\Web\Controllers\LoadController
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class LoadController extends AbstractController
{

    public function getLoadAction(string $fileName)
    {
        $file = $this->Load->getByAlias($fileName, 1);
        if (!$file) {
            header('Location: /error/404');
        }
        $file->flag = 1;
        if ($this->loadFile($file->file)) {
            $file->update($file);
            return true;
        }
        return true;
    }

}
