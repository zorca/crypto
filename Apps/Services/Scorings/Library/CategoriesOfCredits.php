<?php

namespace Apps\Services\Scorings\Library;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс CategoriesOfCredits
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\CategoriesOfCredits
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class CategoriesOfCredits
{

    use Books;

    private static int $default = 201;
    private static array $data = [
        'автомобили с пробегом от 0 до 1000 км' => 101,
        'автомобили с пробегом свыше 1000 км' => 102,
        'Потребительские займы (кредиты) с лимитом кредитования (по сумме лимита кредитования на день заключения договора) до 30 тыс. руб.' => 201,
        'Потребительские займы (кредиты) с лимитом кредитования (по сумме лимита кредитования на день заключения договора) свыше 300 тыс. руб.' => 204,
        'Потребительские займы (кредиты) с лимитом кредитования (по сумме лимита кредитования на день заключения договора) от 30 тыс. руб. до 300 тыс. руб' => 205,
        'Целевые потребительские займы (кредиты), предоставляемые путем перечисления заёмных средств торгово-сервисному предприятию в счет оплаты товаров (услуг) при наличии соответствующего договора с ТСП (POS-кредиты) без обеспечения до 1 года, до 30 тыс. руб.' => 301,
        'Целевые потребительские займы (кредиты), предоставляемые путем перечисления заёмных средств торгово-сервисному предприятию в счет оплаты товаров (услуг) при наличии соответствующего договора с ТСП (POS-кредиты) без обеспечения до 1 года, от 30 тыс. руб. до 100 тыс. руб.' => 302,
        'Целевые потребительские займы (кредиты), предоставляемые путем перечисления заёмных средств торгово-сервисному предприятию в счет оплаты товаров (услуг) при наличии соответствующего договора с ТСП (POS-кредиты) без обеспечения до 1 года, свыше 100 тыс. руб.' => 303,
        'Целевые потребительские займы (кредиты), предоставляемые путем перечисления заёмных средств торгово-сервисному предприятию в счет оплаты товаров (услуг) при наличии соответствующего договора с ТСП (POS-кредиты) без обеспечения Свыше 1 года, до 30 тыс. руб.' => 304,
        'Целевые потребительские займы (кредиты), предоставляемые путем перечисления заёмных средств торгово-сервисному предприятию в счет оплаты товаров (услуг) при наличии соответствующего договора с ТСП (POS-кредиты) без обеспечения Свыше 1 года, от 30 тыс. руб. до 100 тыс. руб.' => 305,
        'Целевые потребительские займы (кредиты), предоставляемые путем перечисления заёмных средств торгово-сервисному предприятию в счет оплаты товаров (услуг) при наличии соответствующего договора с ТСП (POS-кредиты) без обеспечения Свыше 1 года, свыше 100 тыс. руб.' => 306,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности до 1 года, до 30 тыс. руб.' => 401,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности до 1 года, от 30 тыс. руб. до 100 тыс. руб.' => 402,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности до 1 года, от 100 тыс. руб. до 300 тыс. руб.' => 403,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности до 1 года, свыше 300 тыс. руб.' => 404,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности свыше 1 года, до 30 тыс. руб.' => 405,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности свыше 1 года, от 30 тыс. руб. до 100 тыс. руб.' => 406,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности свыше 1 года, от 100 тыс. руб. до 300 тыс. руб.' => 407,
        'Нецелевые потребительские займы (кредиты), целевые потребительские кредиты без залога (кроме POS-кредитов), потребительские займы (кредиты) на рефинансирование задолженности свыше 1 года, свыше 300 тыс. руб.' => 408,
        'Ипотека (заём (кредит), обязательства заёмщика, по которому обеспечены ипотекой)' => 501,
        'Кредит на развитие бизнеса (заём (кредит), предоставленный физическому лицу в целях, связанных с осуществлением им предпринимательской деятельности)' => 601,
        'Потребительские кредиты, предоставляемые при условии получения заемщиком регулярных выплат на свой банковский счет' => 701,
        'Неизвестный (другой) тип займа (кредита)' => 999
    ];

}
