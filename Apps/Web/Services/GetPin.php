<?php

declare(strict_types=1);

namespace Apps\Web\Services;

use Apps\Core\AbstractClasses\AbstractService;

/**
 * Класс GetPin
 * @version 0.0.1
 * @package Apps\Web\Services\GetPin
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class GetPin extends AbstractService
{

    public function get()
    {
        $pin = $this->get->get('pin');
        if (!$pin) {
            $pin = $this->post->get('pin');
        }
        return $pin;
    }

}
