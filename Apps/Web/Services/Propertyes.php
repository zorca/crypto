<?php

declare(strict_types=1);

namespace Apps\Web\Services;

/**
 * Трейт Propertyes
 * @version 0.0.1
 * @package Apps\Web\Services
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
trait Propertyes
{

    use Traits\Close,
        Traits\Active;

    public bool $client = false;
    public bool $history = false;
    public ?string $error = null;

    /**
     * Значение кредитной оценки
     * @var int
     */
    public int $bkiscoring = 0;

}
