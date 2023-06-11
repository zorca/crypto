<?php

namespace Apps\Services\Scorings\Library;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс HowToApplyForLoan
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\HowToApplyForLoan
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class HowToApplyForLoan
{

    use Books;

    private static int $default = 2;
    private static array $data = ['Посреднический (через агента, через брокера)' => 1,
        'Посредник' => 1,
        'через брокера' => 1,
        'через агента' => 1,
        'Посреднический' => 1,
        'Дистанционный (с использование средств телекоммуникации)' => 2,
        'Дистанционный' => 2,
        'Дистанционно' => 2,
        'отделение' => 3,
        'обращение в отделение или офис' => 3,
        'обращение в отделение' => 3,
        'обращение в офис' => 3,
        'Прямой (непосредственное обращение прямое обращение в отделение или офис Партнера)' => 3,
        'офис' => 3,
        'в отделении или офисе' => 3,
    ];

}
