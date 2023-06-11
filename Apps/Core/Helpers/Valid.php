<?php

namespace Apps\Core\Helpers;

if ( ! defined('ROOT')) {
    exit();
}

/**
 * Класс Helper
 * @version 0.0.1
 * @package Apps\Core\functions\Helper
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class Valid
{

    public static function hasEmail(?string $email = null)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }
        return false;
    }

    public static function phoneFormat(string $phone)
    {
        $str = preg_replace(
            [
                '~([^\d])~ui',
                '~^(\d)?(\d{3})?(\d{3})(\d{2})(\d{2})$~ui',
                '~^(7)(.+)~ui'
            ],
            [
                '',
                '$1-$2-$3-$4-$5',
                '8$2'
            ],
            $phone
        );
        return $str;
    }

}
