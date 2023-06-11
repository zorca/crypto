<?php

namespace Apps\Services\Scorings\Library;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс GenderOfSubject
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\GenderOfSubject
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class GenderOfSubject
{

    use Books;

    private static int $default = 9;
    private static array $data = [
        "муж" => 1,
        "муж." => 1,
        "мужской" => 1,
        "м" => 1,
        "мужчина" => 1,
        "жен" => 2,
        "жен." => 2,
        "ж" => 2,
        "женский" => 2,
        "женщина" => 2,
    ];

}
