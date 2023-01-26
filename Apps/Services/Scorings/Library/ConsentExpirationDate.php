<?php

namespace Apps\Services\Scorings\Library;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс ConsentExpirationDate
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\ConsentExpirationDate
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class ConsentExpirationDate
{

    use Books;

    private static int $default = 3;
    private static array $data = [
        'в течение 6 месяцев со дня оформления' => 1,
        '6 месяцев' => 1,
        'пол года' => 1,
        'в течение 1 года со дня оформления' => 2,
        '1 год' => 2,
        'год' => 2,
        'в течение срока действия согласия с субъектом КИ были заключены договор займа (кредита), договор лизинга, договор залога, договор поручительства, выдана независимая гарантия' => 3
    ];

}
