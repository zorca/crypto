<?php

namespace Apps\Services\Scorings\Library;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс RegionCodes
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\RegionCodes
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class RegionCodes
{

    use Books;

    private static $default = '00';
    private static array $data = [
        'АЛТАЙСКИЙ КРАЙ' => '01',
        'КРАСНОДАРСКИЙ КРАЙ' => '03',
        'КРАСНОЯРСКИЙ КРАЙ' => '04',
        'Таймырский район' => '04',
        'Долгано-Ненецкий' => '04',
        'Эвенкийский район' => '04',
        'ПРИМОРСКИЙ КРАЙ' => '05',
        'СТАВРОПОЛЬСКИЙ КРАЙ' => '07',
        'ХАБАРОВСКИЙ КРАЙ' => '08',
        'АМУРСКАЯ ОБЛАСТЬ' => 10,
        'АРХАНГЕЛЬСКАЯ ОБЛАСТЬ' => 11,
        'Ненецкий АО' => 11,
        'АСТРАХАНСКАЯ ОБЛАСТЬ' => 12,
        'БЕЛГОРОДСКАЯ ОБЛАСТЬ' => 14,
        'БРЯНСКАЯ ОБЛАСТЬ' => 15,
        'ВЛАДИМИРСКАЯ ОБЛАСТЬ' => 17,
        'ВОЛГОГРАДСКАЯ ОБЛАСТЬ' => 18,
        'ВОЛОГОДСКАЯ ОБЛАСТЬ' => 19,
        'ВОРОНЕЖСКАЯ ОБЛАСТЬ' => 20,
        'НИЖЕГОРОДСКАЯ ОБЛАСТЬ' => 22,
        'ИВАНОВСКАЯ ОБЛАСТЬ' => 24,
        'ИРКУТСКАЯ ОБЛАСТЬ' => 25,
        'Усть-Ордынский Бурятский округ' => 25,
        'РЕСПУБЛИКА ИНГУШЕТИЯ' => 26,
        'КАЛИНИНГРАДСКАЯ ОБЛАСТЬ' => 27,
        'ТВЕРСКАЯ ОБЛАСТЬ' => 28,
        'КАЛУЖСКАЯ ОБЛАСТЬ' => 29,
        'КАМЧАТСКИЙ КРАЙ' => 30,
        'Корякский округ' => 30,
        'КЕМЕРОВСКАЯ ОБЛАСТЬ' => 32,
        'КИРОВСКАЯ ОБЛАСТЬ' => 33,
        'КОСТРОМСКАЯ ОБЛАСТЬ' => 34,
        'САМАРСКАЯ ОБЛАСТЬ' => 36,
        'РЕСПУБЛИКА КРЫМ' => 35,
        'КУРГАНСКАЯ ОБЛАСТЬ' => 37,
        'КУРСКАЯ ОБЛАСТЬ' => 38,
        'САНКТ-ПЕТЕРБУРГ' => 40,
        'ЛЕНИНГРАДСКАЯ ОБЛАСТЬ' => 41,
        'ЛИПЕЦКАЯ ОБЛАСТЬ' => 42,
        'МАГАДАНСКАЯ ОБЛАСТЬ' => 44,
        'МОСКВА' => 45,
        'МОСКОВСКАЯ ОБЛАСТЬ' => 46,
        'МУРМАНСКАЯ ОБЛАСТЬ' => 47,
        'НОВГОРОДСКАЯ ОБЛАСТЬ' => 49,
        'НОВОСИБИРСКАЯ ОБЛАСТЬ' => 50,
        'ОМСКАЯ ОБЛАСТЬ' => 52,
        'ОРЕНБУРГСКАЯ ОБЛАСТЬ' => 53,
        'ОРЛОВСКАЯ ОБЛАСТЬ' => 54,
        'БАЙКОНУР' => 55,
        'ПЕНЗЕНСКАЯ ОБЛАСТЬ' => 56,
        'ПЕРМСКИЙ КРАЙ' => 57,
        'Коми-Пермяцкий округ' => 57,
        'ПСКОВСКАЯ ОБЛАСТЬ' => 58,
        'РОСТОВСКАЯ ОБЛАСТЬ' => 60,
        'РЯЗАНСКАЯ ОБЛАСТЬ' => 61,
        'САРАТОВСКАЯ ОБЛАСТЬ' => 63,
        'САХАЛИНСКАЯ ОБЛАСТЬ' => 64,
        'СВЕРДЛОВСКАЯ ОБЛАСТЬ' => 65,
        'СМОЛЕНСКАЯ ОБЛАСТЬ' => 66,
        'СЕВАСТОПОЛЬ' => 67,
        'ТАМБОВСКАЯ ОБЛАСТЬ' => 68,
        'ТОМСКАЯ ОБЛАСТЬ' => 69,
        'ТУЛЬСКАЯ ОБЛАСТЬ' => 70,
        'ТЮМЕНСКАЯ ОБЛАСТЬ' => 71,
        'Ханты-Мансийский АО' => 71,
        'Ханты-Мансийский АО - Югра' => 71,
        'Югра' => 71,
        'Ямало-Ненецкий АО' => 71,
        'УЛЬЯНОВСКАЯ ОБЛАСТЬ' => 73,
        'ЧЕЛЯБИНСКАЯ ОБЛАСТЬ' => 75,
        'ЗАБАЙКАЛЬСКИЙ КРАЙ' => 76,
        'Агинский Бурятский округ' => 76,
        'ЧУКОТСКИЙ АВТОНОМНЫЙ ОКРУГ' => 77,
        'ЯРОСЛАВСКАЯ ОБЛАСТЬ' => 78,
        'РЕСПУБЛИКА АДЫГЕЯ (АДЫГЕЯ)' => 79,
        'РЕСПУБЛИКА АДЫГЕЯ' => 79,
        'АДЫГЕЯ' => 79,
        'РЕСПУБЛИКА БАШКОРТОСТАН' => 80,
        'РЕСПУБЛИКА БУРЯТИЯ' => 81,
        'РЕСПУБЛИКА ДАГЕСТАН' => 82,
        'КАБАРДИНО-БАЛКАРСКАЯ РЕСПУБЛИКА' => 83,
        'РЕСПУБЛИКА АЛТАЙ' => 84,
        'РЕСПУБЛИКА КАЛМЫКИЯ' => 85,
        'РЕСПУБЛИКА КАРЕЛИЯ' => 86,
        'РЕСПУБЛИКА КОМИ' => 87,
        'РЕСПУБЛИКА МАРИЙ ЭЛ' => 88,
        'РЕСПУБЛИКА МОРДОВИЯ' => 89,
        'РЕСПУБЛИКА СЕВЕРНАЯ ОСЕТИЯ-АЛАНИЯ' => 90,
        'АЛАНИЯ' => 90,
        'РЕСПУБЛИКА СЕВЕРНАЯ ОСЕТИЯ' => 90,
        'КАРАЧАЕВО-ЧЕРКЕССКАЯ РЕСПУБЛИКА' => 91,
        'РЕСПУБЛИКА ТАТАРСТАН (ТАТАРСТАН)' => 92,
        'ТАТАРСТАН' => 92,
        'РЕСПУБЛИКА ТАТАРСТАН' => 92,
        'РЕСПУБЛИКА ТЫВА' => 93,
        'УДМУРТСКАЯ РЕСПУБЛИКА' => 94,
        'РЕСПУБЛИКА ХАКАСИЯ' => 95,
        'ЧЕЧЕНСКАЯ РЕСПУБЛИКА' => 96,
        'ЧУВАШСКАЯ РЕСПУБЛИКА - ЧУВАШИЯ' => 97,
        'ЧУВАШСКАЯ РЕСПУБЛИКА' => 97,
        'ЧУВАШИЯ' => 97,
        'РЕСПУБЛИКА САХА (ЯКУТИЯ)' => 98,
        'РЕСПУБЛИКА САХА' => 98,
        'ЯКУТИЯ' => 98,
        'ЕВРЕЙСКАЯ АВТОНОМНАЯ ОБЛАСТЬ' => 99,
        'Неизвестно' => '00'
    ];

}
