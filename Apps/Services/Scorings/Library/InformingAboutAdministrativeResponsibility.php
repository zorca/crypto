<?php

namespace Apps\Services\Scorings\Library;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс InformingAboutAdministrativeResponsibility
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\InformingAboutAdministrativeResponsibility
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class InformingAboutAdministrativeResponsibility
{

    use Books;

    private static int $default = 1;
    private static array $data = [
        'Пользователь КИ проинформирован об административной ответственности' => 1,
        'проинформирован' => 1,
        'Посреднический (через агента, через брокера)' => 2,
        'Посредник' => 2,
        'через брокера' => 2,
        'через агента' => 2,
        'Посреднический' => 2,
        'Дистанционный (с использование средств телекоммуникации)' => 3,
        'Дистанционный' => 3,
        'Дистанционно' => 3,
        'отделение' => 4,
        'обращение в отделение или офис' => 4,
        'обращение в отделение' => 4,
        'обращение в офис' => 4,
        'Прямой (непосредственное обращение прямое обращение в отделение или офис Партнера)' => 4,
        'офис' => 4,
        'в отделении или офисе' => 4,
        'Прямой' => 4
    ];

}
