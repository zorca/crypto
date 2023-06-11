<?php

namespace Apps\Services\Scorings\Library;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс PeriodicityOfIncome
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\PeriodicityOfIncome
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class PeriodicityOfIncome
{

    use Books;

    private static int $default = 3;
    private static array $data = [
        'Ежегодно' => 0,
        'Раз в полгода' => 1,
        'Ежеквартально' => 2,
        'Ежемесячно' => 3,
        'Раз в две недели' => 4,
        'Еженедельно' => 5
    ];

}
