<?php

namespace Apps\Services\Scorings\Library;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс FamilyStatus
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\FamilyStatus
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class FamilyStatus
{

    use Books;

    private static int $default = 1;
    private static array $data = [
        'Холост / Не замужем' => 0,
        'Холост' => 0,
        'Не замужем' => 0,
        'Женат / Замужем' => 1,
        'Замужем' => 1,
        'Женат' => 1,
        'Разведен / Разведена' => 2,
        'Разведена' => 2,
        'Разведен' => 2,
        'Вдовец / Вдова' => 3,
        'Вдова' => 3,
        'Вдовец' => 3
    ];

}
