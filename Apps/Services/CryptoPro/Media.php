<?php

namespace Apps\Services\CryptoPro;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс Media
 * @version 0.0.1
 * @package Apps\Services\CryptoPro\Media
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич. Все права защищены.
 * Запрещено для комерческого использования без соглосования с автором проекта
 */
class Media
{

    public function parse($data)
    {
        $group = [];
        for ($i = 0, $q = 0; $i < count($data); $i++) {
            if (!isset($group[$q])) {
                $group[$q] = '';
            }
            $group[$q] .= $data[$i] . ';';
            if (!$data[$i]) {
                $q++;
            }
        }
        foreach ($group as $key => $element) {
            if (!empty(trim($element))) {
                $media[$key] = new self();
                $media[$key]->nickName = trim(preg_replace('~^Nick name:([\w\d\s]+);(.+)~ui', '$1', $element));
                $media[$key]->connectName = trim(preg_replace('~^(.+);Connect name:([\w\d\s]+)?;(.+)~ui', '$2', $element));
                $media[$key]->mediaName = trim(preg_replace('~^(.+);Media name:([\w\d\s]+)(.+)$~ui', '$2', $element));
            }
        }
        return $media;
    }

}
