<?php

declare(strict_types=1);

namespace Apps\Web\Services\Traits;

/**
 * Трейт Activ
 * @version 0.0.1
 * @package Apps\Web\Services\Traits
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
trait Active
{

    /**
     * Масимальная сумма платежей за последние количество дней по типу
     * @var int
     */
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_3 = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_3 = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_3 = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_3 = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_3 = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_3 = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_3 = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_all = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_other = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_all = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_other = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_all = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_all = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_all = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_all = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_all = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_other = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_other = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_other = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_other = 0;
    protected int $max_amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_other = 0;

    /**
     * Общая сумма платежей за последние количество дней по типу
     * @var int
     */
    protected int $amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_3 = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_3 = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_3 = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_3 = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_3 = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_3 = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_3 = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_all = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_other = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_all = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_other = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_all = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_all = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_all = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_all = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_all = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_other = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_other = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_other = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_other = 0;
    protected int $amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_other = 0;

    /**
     * Минимальная сумма платежей за последние количество дней по типу
     * @var int
     */
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_3 = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_3 = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_3 = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_3 = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_3 = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_3 = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_3 = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_all = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_other = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_more_days_for_type_all = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_365_days_for_type_other = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_all = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_all = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_all = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_all = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_all = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_180_days_for_type_other = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_90_days_for_type_other = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_60_days_for_type_other = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_30_days_for_type_other = 0;
    protected int $min_amount_of_payments_under_active_contracts_for_the_last_5_days_for_type_other = 0;

    /**
     * Количество активных контрактов за последнее количество дней по типу
     * @var int
     */
    protected int $count_of_active_contracts_in_the_last_365_days_by_type_3 = 0;
    protected int $count_of_active_contracts_in_the_last_180_days_by_type_3 = 0;
    protected int $count_of_active_contracts_in_the_last_90_days_by_type_3 = 0;
    protected int $count_of_active_contracts_in_the_last_60_days_by_type_3 = 0;
    protected int $count_of_active_contracts_in_the_last_30_days_by_type_3 = 0;
    protected int $count_of_active_contracts_in_the_last_5_days_by_type_3 = 0;
    protected int $count_of_active_contracts_in_the_last_365_days_by_type_all = 0;
    protected int $count_of_active_contracts_in_the_last_180_days_by_type_all = 0;
    protected int $count_of_active_contracts_in_the_last_90_days_by_type_all = 0;
    protected int $count_of_active_contracts_in_the_last_60_days_by_type_all = 0;
    protected int $count_of_active_contracts_in_the_last_30_days_by_type_all = 0;
    protected int $count_of_active_contracts_in_the_last_5_days_by_type_all = 0;
    protected int $count_of_active_contracts_in_the_last_365_days_by_type_other = 0;
    protected int $count_of_active_contracts_in_the_last_180_days_by_type_other = 0;
    protected int $count_of_active_contracts_in_the_last_90_days_by_type_other = 0;
    protected int $count_of_active_contracts_in_the_last_60_days_by_type_other = 0;
    protected int $count_of_active_contracts_in_the_last_30_days_by_type_other = 0;
    protected int $count_of_active_contracts_in_the_last_5_days_by_type_other = 0;
    protected int $count_of_active_contracts_in_the_last_more_days_by_type_other = 0;
    protected int $count_of_active_contracts_in_the_last_more_days_by_type_all = 0;
    protected int $count_of_active_contracts_in_the_last_more_days_by_type_3 = 0;

    /**
     * Количество открытых контрактов за период по типу
     * @var int
     */
    protected int $count_active_contracts_with_age_0_deliqto_5_type_3 = 0;
    protected int $count_active_contracts_with_age_0_deliqto_5_type_other = 0;
    protected int $count_active_contracts_with_age_0_deliqto_5_type_all = 0;
    protected int $count_active_contracts_with_age_5_deliqto_30_type_3 = 0;
    protected int $count_active_contracts_with_age_5_deliqto_30_type_other = 0;
    protected int $count_active_contracts_with_age_5_deliqto_30_type_all = 0;
    protected int $count_active_contracts_with_age_30_deliqto_60_type_3 = 0;
    protected int $count_active_contracts_with_age_30_deliqto_60_type_other = 0;
    protected int $count_active_contracts_with_age_30_deliqto_60_type_all = 0;
    protected int $count_active_contracts_with_age_60_deliqto_90_type_3 = 0;
    protected int $count_active_contracts_with_age_60_deliqto_90_type_other = 0;
    protected int $count_active_contracts_with_age_60_deliqto_90_type_all = 0;
    protected int $count_active_contracts_with_age_90_deliqto_180_type_3 = 0;
    protected int $count_active_contracts_with_age_90_deliqto_180_type_other = 0;
    protected int $count_active_contracts_with_age_90_deliqto_180_type_all = 0;
    protected int $count_active_contracts_with_age_180_deliqto_365_type_3 = 0;
    protected int $count_active_contracts_with_age_180_deliqto_365_type_other = 0;
    protected int $count_active_contracts_with_age_180_deliqto_365_type_all = 0;
    protected int $count_active_contracts_with_age_365_and_more_type_3 = 0;
    protected int $count_active_contracts_with_age_365_and_more_type_other = 0;
    protected int $count_active_contracts_with_age_365_and_more_type_all = 0;

    /**
     * Количество открытых контрактов за все время по типу
     * @var int
     */
    protected int $count_active_contracts_type_other = 0;
    protected int $count_active_contracts_type_all = 0;
    protected int $count_active_contracts_type_3 = 0;

    /**
     * Сумма всех просрочек по типу
     * @var int
     */
    protected int $sum_debt_overdue_with_type_3 = 0;
    protected int $sum_debt_overdue_with_type_other = 0;
    protected int $sum_debt_overdue_with_type_all = 0;

    /**
     * Минимальная сумма прсрочки по типу
     * @var int
     */
    protected int $min_sum_debt_overdue_with_type_3 = 0;
    protected int $min_sum_debt_overdue_with_type_other = 0;
    protected int $min_sum_debt_overdue_with_type_all = 0;

    /**
     * Максимальная сумма просрочки по типу
     * @var int
     */
    protected int $max_sum_debt_overdue_with_type_3 = 0;
    protected int $max_sum_debt_overdue_with_type_other = 0;
    protected int $max_sum_debt_overdue_with_type_all = 0;

    /**
     * Количество всех просроченных платежей по активным потребительским кредитам со сроком просрочки до 5 дней
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_0_deliqto_5 = 0;

    /**
     * Количество всех просроченных платежей по активным потребительским кредитам со сроком просрочки от 5 до 30 дней
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_5_deliqto_30 = 0;

    /**
     * Количество всех просроченных платежей по активным потребительским кредитам со сроком просрочки от 30 до 60 дней
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_30_deliqto_60 = 0;

    /**
     * Количество всех просроченных платежей по активным потребительским кредитам со сроком просрочки от 60 до 90 дней
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_60_deliqto_90 = 0;

    /**
     * Количество всех просроченных платежей по активным потребительским кредитам со сроком просрочки от 90 до 180 дней
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_90_deliqto_180 = 0;

    /**
     * Количество всех просроченных платежей по активным потребительским кредитам со сроком просрочки от 180 до 365 дней
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_180_deliqto_365 = 0;

    /**
     * Количество всех просроченных платежей по активным потребительским кредитам со сроком просрочки от 365 дней и более
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки до 5 дней (микрозаймы)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_0_deliqto_5_for_type_3 = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки до 5 дней (кроме микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_0_deliqto_5_for_type_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки до 5 дней (включая микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_0_deliqto_5_for_type_all = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 5 до 30 дней (микрозаймы)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_5_deliqto_30_for_type_3 = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 5 до 30 дней (кроме микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_5_deliqto_30_for_type_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 5 до 30 дней (включая микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_5_deliqto_30_for_type_all = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 30 до 60 дней (микрозаймы)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_30_deliqto_60_for_type_3 = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 30 до 60 дней (кроме микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_30_deliqto_60_for_type_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 30 до 60 дней (включая микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_30_deliqto_60_for_type_all = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 60 до 90 дней (микрозаймы)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_60_deliqto_90_for_type_3 = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 60 до 90 дней (кроме микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_60_deliqto_90_for_type_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 60 до 90 дней (включая микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_60_deliqto_90_for_type_all = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 90 до 180 дней (микрозаймы)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_90_deliqto_180_for_type_3 = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 90 до 180 дней (кроме микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_90_deliqto_180_for_type_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 90 до 180 дней (включая микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_90_deliqto_180_for_type_all = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 180 до 365 дней (микрозаймы)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_180_deliqto_365_for_type_3 = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 180 до 365 дней (кроме микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_180_deliqto_365_for_type_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 180 до 365 дней (включая микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_180_deliqto_365_for_type_all = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 365 дней и более (микрозаймы)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_other_for_type_3 = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 365 дней и более (кроме микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_other_for_type_other = 0;

    /**
     * Количество всех просроченных платежей по закрытым потребительским кредитам со сроком просрочки от 365 дней и более (включая микрозаймов)
     * @var int
     */
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_other_for_type_all = 0;
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_more_for_type_other = 0;
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_more_for_type_3 = 0;
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_more_for_type_all = 0;
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_more = 0;
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_3 = 0;
    protected int $count_with_active_not_0_3_20_deliqfrom_365_and_all = 0;

    /**
     * Количество потребительских кредитов за всю историю (не микрозаймы)
     * @var int
     */
    protected int $count_all_contracts_type_other = 0;

    /**
     * Количество потребительских кредитов за всю историю (только микрозаймы)
     * @var int
     */
    protected int $count_all_contracts_type_3 = 0;

    /**
     * Количество всех кредитов за всю историю (включая микрозаймы)
     * @var int
     */
    protected int $count_all_contracts_type_all = 0;

    /**
     * Количество текущих открытых просрочек по потребительским кредитам (только микрозаймы)
     * @var int
     */
    protected int $bki_active_count_overdue_3 = 0;

    /**
     * Количество текущих открытых просрочек по потребительским кредитам (не микрозаймы)
     * @var int
     */
    protected int $bki_active_count_overdue_other = 0;

    /**
     * Количество текущих открытых просрочек по потребительским кредитам (включая микрозаймы)
     * @var int
     */
    protected int $bki_active_count_overdue_all = 0;

}
