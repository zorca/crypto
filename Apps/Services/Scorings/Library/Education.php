<?php

namespace Apps\Services\Scorings\Library;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс Education
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\Education
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class Education
{

    use Books;

    private static int $default = 9;
    private static array $data = [
        'Начальная школа' => 0,
        'Средняя школа' => 1,
        'Специализированная средняя школа' => 2,
        'Незаконченное высшее образование' => 3,
        'Высшее образование' => 4,
        'Два и более высших образования' => 5,
        'Ученая степень' => 6,
        'Другое' => 8,
        'Неизвестно' => 9
    ];

}
