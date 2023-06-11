<?php

declare(strict_types = 1);

namespace Apps\Web\Services;

use SimpleXMLElement;

/**
 * Класс EquifaxScoringResult
 * @version 0.0.1
 * @package Apps\Web\Services
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class EquifaxScoringResult
{

    private $scoringResult;
    private $creditHistory;
    public bool $client = false;
    public bool $history = false;

    /**
     * Количество займов с суммой займа 300000 и более
     * @var int
     */
    public int $credit_count_with_sum_more_300000 = 0;

    private function setCountAllCreditSum300000($contract)
    {
        if (isset($contract->contract_amount->sum) AND (int)$contract->contract_amount->sum >= 300000) {
            $this->credit_count_with_sum_more_300000 ++;
        }
    }

    /**
     * Число закрытых микрозаймов из взятых за последние 90 дней
     * @var int
     */
    public int $credit_count_for_type_19_days_90 = 0;

    private function setCountClosedCreditType19Days90($contract)
    {
        if (isset($contract->contract_end)) {
            $this->credit_count_for_type_19_days_90 ++;
        }
    }

    /**
     * Количество взятых микрозаймов
     * @var int
     */
    public int $credit_count_contracts_with_type_19 = 0;

    private function setCountAllCreditType19($contract)
    {
        if (isset($contract->deal->type) AND (int)$contract->deal->type === 3) {
            $this->credit_count_contracts_with_type_19 ++;
        }
    }

    /**
     * Число открытых микрозаймов из всех взятых кредитов за последние 90 дней
     * @var int
     */
    public int $credit_count_active_contracts_with_age_90_type_19 = 0;

    private function setCountActiveCreditType19Days90($contract)
    {
        if (isset($contract->dept->sign) AND (int)$contract->dept->sign === 1) {
            $this->credit_count_active_contracts_with_age_90_type_19 ++;
        }
    }

    /**
     * Средняя сумма возврата по микрозаймам за последние 90 дней
     * @var float
     */
    public float $credit_avg_paid_for_type_19_days_90 = 0;

    private function setAvgSumForCreditType19Days90()
    {
        if ($this->allSummCreditType19Days90 AND $this->countAllCreditType19Days90) {
            $avgSum = ceil($this->allSummCreditType19Days90 / $this->countAllCreditType19Days90);
            $this->credit_avg_paid_for_type_19_days_90 = $avgSum;
        }
    }

    /**
     * Общая сумма по всем микрозаймам за последние 90 дней
     * @var int
     */
    private float $allSummCreditType19Days90 = 0;

    /**
     * Количество всех микрозаймов за последние 90 дней
     * @var int
     */
    private int $countAllCreditType19Days90 = 0;

    private function setAllSummCreditType19Days90($contract)
    {

        $this->countAllCreditType19Days90 ++;
        if (isset($contract->contract_amount->sum)) {
            $sum = (float)$contract->contract_amount->sum;
            $this->allSummCreditType19Days90 += $sum;
        }
    }

    /**
     * Общая сумма выплат по займам
     * @var float
     */
    public float $summ_of_all_ta_cred_sum_paid = 0;

    private function setSumAllCreditPaid($contract)
    {
        if (isset($contract->full_cost->sum)) {
            $sum = (float)$contract->full_cost->sum;
            $this->summ_of_all_ta_cred_sum_paid += $sum;
        }
    }

    /**
     * Дней со взятия последнего микрозайма
     * @var float
     */
    public float $credit_last_open_days_for_type_19 = 0;

    private function setCountDaysForLastOpenCreditType19($contract)
    {
        $days = ceil((time() - strtotime($contract->deal->date)) / (60 * 60 * 24));
        if ( ! $this->credit_last_open_days_for_type_19) {
            $this->credit_last_open_days_for_type_19 = $days;
        } elseif ($this->credit_last_open_days_for_type_19 > $days) {
            $this->credit_last_open_days_for_type_19 = $days;
        }
    }

    /**
     * Число закрытых микрозаймов из взятых за последние 180 дней
     * @var int
     */
    public int $credit_count_for_type_19_days_180 = 0;

    private function setCountCloseCreditForType19Days180($contract)
    {
        if (isset($contract->contract_end)) {
            $this->credit_count_for_type_19_days_180 ++;
        }
    }

    /**
     * Количество взятых займов за последний год
     * @var int
     */
    public int $credit_count_contracts_with_age_365 = 0;

    private function setCountAllCreditDays365()
    {
        $this->credit_count_contracts_with_age_365 ++;
    }

    /**
     * Количество просроченных кредитов за год
     * @var int
     */
    public int $credit_count_overdue_for_date_365 = 0;

    private function setCountOverdueCreditDays365($contract)
    {
        if (isset($contract->debt_overdue->sum) AND (float)$contract->debt_overdue->sum > 0) {
            $this->credit_count_overdue_for_date_365 ++;
        }
    }

    /**
     * Число закрытых просрочек 5 дней и менее
     * @var int
     */
    public int $credit_count_delay_5 = 0;

    private function setCountCreditDelayDays5($contract)
    {
        $sum = 0;
        if (isset($contract->debt_overdue->sum) AND (float)$contract->debt_overdue->sum > 0) {
            $sum = (float)$contract->debt_overdue->sum;
        }
        if ($sum AND (int)$contract->payments->overdue_day <= 5) {
            $this->credit_count_delay_5 ++;
        }
    }

    /**
     * Число активных просрочек с глубиной 6-60 дней сумма просрочки > 1000
     * @var int
     */
    public int $credit_count_active_11_12_13 = 0;

    private function setCountCreditActiveOverdue($contract)
    {
        $sum = 0;
        if (isset($contract->debt_overdue->sum) AND (float)$contract->debt_overdue->sum > 0) {
            $sum = (float)$contract->debt_overdue->sum;
        }
        $sign = (int)$contract->debt->sign;
        $days = (int)$contract->payments->overdue_day;
        if ($sum AND $days > 5 AND $days <= 60 AND $sign) {
            $this->credit_count_active_11_12_13 ++;
        }
    }

    /**
     * количество просроченных займов
     * @var int
     */
    public int $credit_count_active_overdue_11_12_13_sum_1000 = 0;

    private function setCountCreditOverdue($contract)
    {
        $sum = 0;
        if (isset($contract->debt_overdue->sum) AND (float)$contract->debt_overdue->sum > 0) {
            $sum = (float)$contract->debt_overdue->sum;
        }
        if ($sum >= 1000) {
            $this->credit_count_active_overdue_11_12_13_sum_1000 ++;
        }
    }

    /**
     * Минимальное количество дней просроченного займа (сумма просрочки более 1000)
     * @var int
     */
    public int $credit_min_age_in_days_for_overdue_sum_1000 = 0;

    /**
     * Максимальное количество дней просроченного займа (сумма просрочки более 1000)
     * @var int
     */
    public int $credit_max_age_in_days_for_overdue_sum_1000 = 0;
    private int $minDaysOverdueSum1000 = 0;
    private ?SimpleXMLElement $EquifaxScoringResult;

    private function setDaysCreditOverdueSum1000($contract)
    {
        $sum = 0;
        if (isset($contract->debt_overdue->sum) AND (float)$contract->debt_overdue->sum > 0) {
            $sum = (float)$contract->debt_overdue->sum;
        }
        if ($sum >= 1000) {
            $daysOverdue = (int)((time() - strtotime($contract->debt_overdue->date)) / (60 * 60 * 24));
            if ($daysOverdue) {
                if ( ! $this->credit_min_age_in_days_for_overdue_sum_1000) {
                    $this->credit_min_age_in_days_for_overdue_sum_1000 = $daysOverdue;
                } elseif ($this->credit_min_age_in_days_for_overdue_sum_1000 > $daysOverdue) {
                    $this->credit_min_age_in_days_for_overdue_sum_1000 = $daysOverdue;
                }
                if ( ! $this->credit_max_age_in_days_for_overdue_sum_1000) {
                    $this->credit_max_age_in_days_for_overdue_sum_1000 = $daysOverdue;
                } elseif ($this->credit_max_age_in_days_for_overdue_sum_1000 < $daysOverdue) {
                    $this->credit_max_age_in_days_for_overdue_sum_1000 = $daysOverdue;
                }
            }
        }
    }

    public ?string $error = null;
    public int $historyCreditCount = 0;

    public function __construct($data = null)
    {
        if ($data) {
            $this->scoringResult = json_decode(json_encode($data));
            if ((int)$this->scoringResult->response->responsecode === 1) {
                $this->client = true;
            } else {
                $this->error = $this->scoringResult->response->responsestring;
            }
            if (isset($this->scoringResult->response->base_part->contract)) {
                $this->creditHistory = $this->scoringResult->response->base_part->contract;
                $this->history = true;
                foreach ($this->creditHistory as $creditInfo) {
                    $this->historyCreditCount ++;
                    $this->setHistory($creditInfo);
                    $this->setBkiCountActiveCredit($creditInfo);
                }
                $this->setAvgSumForCreditType19Days90();
                $this->setDelay($data);
                $this->setScoringRaiting($this->scoringResult->response->base_part);
            }
            $this->EquifaxScoringResult = $data;
        }
    }

    /**
     * Количество активных займов
     * @var int
     */
    public int $bkicountactivecredit = 0;

    private function setBkiCountActiveCredit($contract)
    {
        if ( ! isset($contract->contract_end)) {
            $this->bkicountactivecredit ++;
        }
    }

    /**
     * Количество запросов за последний месяц
     * @var int
     */
    public int $interestForLastMonth = 0;

    /**
     * Кредитов открытых за последние 7 дней
     * @var int
     */
    public int $creditsCreatedlast7day = 0;

    private function setCreditsCreatedLast7Days($contract)
    {
        $end_date = strtotime($contract->deal->end_date);
        if ($end_date > time() AND ! isset($contract->contract_end)) {
            $this->creditsCreatedlast7day ++;
        }
    }

    /**
     * Значение кредитной оценки
     * @var int
     */
    public int $bkiscoring = 0;

    public function setScoringRaiting($info)
    {
        if (isset($info->scoring->score)) {
            $this->bkiscoring = (int)$info->scoring->score;
        }
    }

    public int $bkicountcreditcard = 0;

    public function setHistory($contract)
    {
        if (isset($contract->deal->type) AND (int)$contract->deal->type === 3 AND isset($contract->deal->date)) {
            if (isset($contract->deal->sign_credit_card) AND (int)$contract->deal->sign_credit_card === 1) {
                $this->bkicountcreditcard ++;
            }
            $this->setBkiCountOverdue($contract);

            $days7 = strtotime($contract->deal->date) + (60 * 60 * 24 * 7);
            if ($days7 >= time()) {
                $this->setCreditsCreatedLast7Days($contract);
            }
            $days30 = strtotime($contract->deal->date) + (60 * 60 * 24 * 30);
            if ($days30 >= time()) {
                $this->interestForLastMonth ++;
            }
            $days90 = strtotime($contract->deal->date) + (60 * 60 * 24 * 90);
            if ($days90 >= time()) {
                $this->setCountActiveCreditType19Days90($contract);
                $this->setCountClosedCreditType19Days90($contract);
                $this->setAllSummCreditType19Days90($contract);
                $this->setCreditSummForType19Days90($contract);
            }
            $days180 = strtotime($contract->deal->date) + (60 * 60 * 24 * 180);
            if ($days180 >= time()) {
                $this->credit_avg_paid_for_type_19_days_180_count ++;
                $this->setCountCloseCreditForType19Days180($contract);
                $this->setProlongationCount($contract);
                $this->setCreditAvgPaidForType19days180($contract);
                $this->setCreditSummForType19days180($contract);
            }
            $days365 = strtotime($contract->deal->date) + (60 * 60 * 24 * 365);
            if ($days365 >= time()) {
                $this->setCountAllCreditDays365();
                $this->setCountOverdueCreditDays365($contract);
            }
            $this->setCountAllCreditType19($contract);
            $this->setCountDaysForLastOpenCreditType19($contract);
            $this->setCreditLastOpenDateForType19($contract);
        }
        $this->setBkiCoutOverdue1000($contract);
        $this->setBkiAllAmountOverdue($contract);
        $this->setDaysCreditOverdueSum1000($contract);
        $this->setCountCreditOverdue($contract);
        $this->setCountCreditDelayDays5($contract);
        $this->setCountAllCreditSum300000($contract);
        $this->setSumAllCreditPaid($contract);
    }

    /**
     * Кол–во закрытых просрочек – от 30 до 60 дней
     * @var int
     */
    public int $credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60 = 0;

    /**
     * Кол–во закрытых просрочек – от 6 до 30 дней
     * @var int
     */
    public int $credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30 = 0;

    /**
     * Кол–во закрытых просрочек – менее 6 дней
     * @var int
     */
    public int $credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5 = 0;

    /**
     * Кол–во закрытых просрочек – от 60 до 90 дней
     * @var int
     */
    public int $credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90 = 0;

    /**
     * Кол–во закрытых просрочек – более 90 дней
     * @var int
     */
    public int $credit_count_with_active_not_0_3_20_deliqfrom_more = 0;

    /**
     * Максимальная сумма просроченной задолженности
     * @var int
     */
    public int $cred_max_overdue = 0;

    private function setDelay()
    {
        $list = $this->scoringResult->response->extra_part->summary;
        print_r($list);
        foreach ($list as $creditInfo) {
            $delay5 = (int)$creditInfo->delay5;
            if ($this->credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5 < $delay5) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5 = $delay5;
            }
            $delay30 = (int)$creditInfo->delay30;
            if ($this->credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30 < $delay30) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30 = $delay30;
            }
            $delay60 = (int)$creditInfo->delay60;
            if ($this->credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60 < $delay60) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60 = $delay60;
            }
            $delay90 = (int)$creditInfo->delay90;
            if ($this->credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90 < $delay90) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90 = $delay90;
            }
            $delay_more = (int)$creditInfo->delay_more;
            if ($this->credit_count_with_active_not_0_3_20_deliqfrom_more < $delay_more) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_more = $delay_more;
            }
            $cred_max_overdue = (int)$creditInfo->cred_max_overdue;
            if ($this->cred_max_overdue < $cred_max_overdue) {
                $this->cred_max_overdue = $cred_max_overdue;
            }
        }
    }

    /**
     * Максимальное количество пролонгаций за последние полгода по микрозаймам
     * @var int
     */
    public int $credit_prolongation_count_contracts_with_age_180_type_19 = 0;

    private function setProlongationCount($contract)
    {
        if (isset($contract->contract_changes)) {
            $contract_changes = 0;
            foreach ($contract->contract_changes as $changes) {
                if (
                    isset($changes->type)
                    AND isset($changes->special_type)
                    AND (int)$changes->type === 3
                    AND (int)$changes->special_type === 11
                ) {
                    $contract_changes ++;
                    if ( ! $this->credit_prolongation_count_contracts_with_age_180_type_19
                        OR $this->credit_prolongation_count_contracts_with_age_180_type_19 < $contract_changes
                    ) {
                        $this->credit_prolongation_count_contracts_with_age_180_type_19 = $contract_changes;
                    }
                }
            }
        }
    }

    public function toArray()
    {
        $arrayData = [
            "bkicoutoverdue1000" => $this->bkicoutoverdue1000,
            "bkiallamountoverdue" => $this->bkiallamountoverdue,
            "bkicountcreditcard" => $this->bkicountcreditcard,
            "client" => $this->client,
            "history" => $this->history,
            'historyCreditCount' => $this->historyCreditCount,
            "credit_count_with_sum_more_300000" => $this->credit_count_with_sum_more_300000,
            "credit_count_for_type_19_days_90" => $this->credit_count_for_type_19_days_90,
            "credit_count_contracts_with_type_19" => $this->credit_count_contracts_with_type_19,
            "credit_count_active_contracts_with_age_90_type_19" => $this->credit_count_active_contracts_with_age_90_type_19,
            "credit_avg_paid_for_type_19_days_90" => $this->credit_avg_paid_for_type_19_days_90,
            "summ_of_all_ta_cred_sum_paid" => $this->summ_of_all_ta_cred_sum_paid,
            "credit_last_open_days_for_type_19" => $this->credit_last_open_days_for_type_19,
            "credit_count_for_type_19_days_180" => $this->credit_count_for_type_19_days_180,
            "credit_count_contracts_with_age_365" => $this->credit_count_contracts_with_age_365,
            "credit_count_overdue_for_date_365" => $this->credit_count_overdue_for_date_365,
            "credit_count_delay_5" => $this->credit_count_delay_5,
            "credit_count_active_11_12_13" => $this->credit_count_active_11_12_13,
            "credit_count_active_overdue_11_12_13_sum_1000" => $this->credit_count_active_overdue_11_12_13_sum_1000,
            "credit_min_age_in_days_for_overdue_sum_1000" => $this->credit_min_age_in_days_for_overdue_sum_1000,
            "error" => $this->error,
            "bkicountactivecredit" => $this->bkicountactivecredit,
            "interestForLastMonth" => $this->interestForLastMonth,
            "creditsCreatedlast7day" => $this->creditsCreatedlast7day,
            "bkiscoring" => $this->bkiscoring,
            "credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60" => $this->credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60,
            "credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30" => $this->credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30,
            "credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5" => $this->credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5,
            "credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90" => $this->credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90,
            "credit_count_with_active_not_0_3_20_deliqfrom_more" => $this->credit_count_with_active_not_0_3_20_deliqfrom_more,
            "cred_max_overdue" => $this->cred_max_overdue,
            "credit_prolongation_count_contracts_with_age_180_type_19" => $this->credit_prolongation_count_contracts_with_age_180_type_19,
            'credit_summ_for_type_19_days_90' => $this->credit_summ_for_type_19_days_90,
            "credit_avg_paid_for_type_19_days_180" => $this->credit_avg_paid_for_type_19_days_180,
            "credit_summ_for_type_19_days_180" => $this->credit_summ_for_type_19_days_180,
            "credit_last_open_date_for_type_19" => $this->credit_last_open_date_for_type_19,
            "bkicountoverdue" => $this->bkicountoverdue,
            "bkiactivecountoverdue" => $this->bkiactivecountoverdue,
        ];
        ksort($arrayData, SORT_STRING);
        return (object)$arrayData;
    }

    /**
     * выплачено займов за последние 90 дней
     * @var int
     */
    public int $credit_summ_for_type_19_days_90 = 0;

    public function setCreditSummForType19Days90($contract)
    {
        if (isset($contract->contract_changes->finish_date)) {
            $this->credit_summ_for_type_19_days_90 ++;
        }
    }

    /**
     * средний платеж за 180 дней
     * @var float
     */
    public float $credit_avg_paid_for_type_19_days_180 = 0;
    private int $credit_avg_paid_for_type_19_days_180_count = 0;
    private float $credit_avg_paid_for_type_19_days_180_summ = 0;

    public function setCreditAvgPaidForType19days180($contract)
    {
        if (isset($contract->full_cost->sum)) {
            $this->credit_avg_paid_for_type_19_days_180_summ += (int)$contract->full_cost->sum;
        }
        if ($this->credit_avg_paid_for_type_19_days_180_count AND $this->credit_avg_paid_for_type_19_days_180_summ) {
            $this->credit_avg_paid_for_type_19_days_180 = ceil($this->credit_avg_paid_for_type_19_days_180_summ / $this->credit_avg_paid_for_type_19_days_180_count);
        }
    }

    /**
     * выплачено займов за последние 180 дней
     * @var int
     */
    public int $credit_summ_for_type_19_days_180 = 0;

    public function setCreditSummForType19days180($contract)
    {
        if (isset($contract->contract_changes->finish_date)) {
            $this->credit_summ_for_type_19_days_180 ++;
        }
    }

    /**
     * дата последнего открытого займа
     * @var string|null
     */
    public ?string $credit_last_open_date_for_type_19 = null;

    public function setCreditLastOpenDateForType19($contract)
    {
        if (isset($contract->deal->date)) {
            $time = strtotime($contract->deal->date);
            if ( ! $this->credit_last_open_date_for_type_19) {
                $this->credit_last_open_date_for_type_19 = date("d.m.Y", $time);
            } elseif ($time > strtotime($this->credit_last_open_date_for_type_19)) {
                $this->credit_last_open_date_for_type_19 = date("d.m.Y", $time);
            }
        }
    }

    /**
     * количество просрочки погашенной
     * @var int
     */
    public int $bkicountoverdue = 0;

    /**
     * количество просрочек не погашеных
     * @var int
     */
    public int $bkiactivecountoverdue = 0;

    public function setBkiCountOverdue($contract)
    {
        if (isset($contract->debt_overdue)) {
            $sum = (int)$contract->debt_overdue->sum;
            $final = false;
            if (isset($contract->contract_changes->finish_date)) {
                $final = strtotime($contract->contract_changes->finish_date);
            }
            if ($sum > 0) {
                if ($final) {
                    $this->bkicountoverdue ++;
                } else {
                    $this->bkiactivecountoverdue ++;
                }
            }
        }
    }

    /**
     * количество просроченных займов
     * @var int
     */
    public int $bkicoutoverdue1000 = 0;

    public function setBkiCoutOverdue1000($contract)
    {
        $sum = 0;
        if (isset($contract->debt_current->sum)) {
            $sum = (int)$contract->debt_current->sum;
        }
        if ($sum > 0) {
            $this->bkicoutoverdue1000 ++;
        }
    }

    /**
     *  общая сумма задолженности кредиты + займы (текущие)
     * @var float
     */
    public float $bkiallamountoverdue = 0;

    public function setBkiAllAmountOverdue($contract)
    {
        $finish = false;
        if (isset($contract->contract_changes->finish_date)) {
            $finish = true;
        }
        if (isset($contract->debt_current->sum) AND ! $finish) {
            $this->bkiallamountoverdue += (int)$contract->debt_current->sum;
        }
    }

}
