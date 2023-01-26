<?php

namespace Apps\Services\Scorings\Library;

if (!defined('ROOT')) {
    exit();
}

/**
 * Класс GroundsForTheTransferOfConsent
 * @version 0.0.1
 * @package Apps\Services\Scorings\Library\GroundsForTheTransferOfConsent
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class GroundsForTheTransferOfConsent
{

    use Books;

    private static int $default = 1;
    private static array $data = [
        'правопреемник' => 1,
        'согласие субъекта КИ передано правопреемнику по заключенному договору займа (кредита) или иному договору, информация об обязательствах, по которым передается в БКИ' => 1,
        'согласие субъекта КИ передано кредитной организации, осуществляющей обслуживание денежных требований по договору займа (кредита), уступленных специализированному финансовому обществу или ипотечному агенту' => 2,
        'коолектор' => 2
    ];

}
