<?php

declare(strict_types=1);

namespace Apps\Web\Services;

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

    use Propertyes;

    public float $all_payment_active_credit_month = 0;

    /**
     * количество просроченных займов
     * @var int
     */
    public int $bkicoutoverdue1000 = 0;
    public int $credit_count_active_11_12_13 = 0;
    /**
     * Число закрытых просрочек 5 дней и менее
     * @var int
     */
    public int $credit_count_delay_5 = 0;
    /**
     *
     * @var int
     */
    public int $summ_of_all_ta_cred_sum_paid = 0;
    /**
     *
     * @var int
     */
    public int $bkiactivecountoverdue = 0;
    /**
     *
     * @var int
     */
    public int $bkiallamountoverdue = 0;
    /**
     *
     * @var int
     */
    public int $bkicountactivecredit = 0;
    /**
     *
     * @var int
     */
    public int $historyCreditCount = 0;
    /**
     *
     * @var int
     */
    public int $bkicountcreditcard = 0;
    /**
     *
     * @var float
     */
    public float $credit_count_active_overdue_11_12_13_sum_1000 = 0;
    /**
     *
     * @var int
     */
    public int $credit_count_contracts_with_age_365 = 0;
    /**
     *
     * @var int
     */
    public int $credit_count_contracts_with_type_19 = 0;
    /**
     *
     * @var int
     */
    public int $credit_count_for_type_19_days_180 = 0;
    /**
     *
     * @var int
     */
    public int $credit_count_for_type_19_days_90 = 0;
    /**
     *
     * @var int
     */
    public int $credit_count_overdue_for_date_365 = 0;
    /**
     *
     * @var int
     */
    public int $credit_count_with_sum_more_300000 = 0;
    /**
     *
     * @var int
     */
    public int $ta_cred_sum_paid = 0;
    /**
     *
     * @var int
     */
    public int $paid_percent_sum_for_30_type_3 = 0;
    /**
     *
     * @var int
     */
    public int $paid_percent_sum_for_60_type_3 = 0;
    /**
     *
     * @var int
     */
    public int $paid_percent_sum_for_90_type_3 = 0;
    /**
     *
     * @var int
     */
    public int $ta_cred_sum_overdue = 0;
    /**
     *
     * @var int
     */
    public int $interestForLastMonth = 0;
    /**
     *
     * @var float
     */
    public float $credit_sum_paid_for_type_19_days_180 = 0;
    /**
     *
     * @var float
     */
    public float $credit_sum_paid_for_type_19_days_90 = 0;
    /**
     * Средняя сумма возврата по микрозаймам за последние 90 дней
     * @var float
     */
    public float $credit_avg_paid_for_type_19_days_90 = 0;
    /**
     *
     * @var float
     */
    public float $credit_avg_paid_for_type_19_days_180 = 0;
    /**
     *
     * @var int
     */
    public int $creditsCreatedlast7day = 0;
    /**
     * выплачено займов за последние 180 дней
     * @var int
     */
    public int $credit_summ_for_type_19_days_180 = 0;
    /**
     * выплачено займов за последние 90 дней
     * @var int
     */
    public int $credit_summ_for_type_19_days_90 = 0;
    /**
     *
     * @var int
     */
    public int $credit_last_open_days_for_type_19 = 0;
    /**
     * дата последнего открытого займа
     * @var string|null
     */
    public ?string $credit_last_open_date_for_type_19 = null;
    /**
     *
     * @var int
     */
    public int $bkicountoverdue = 0;
    /**
     *
     * @var int
     */
    public int $credit_count_active_contracts_with_age_90_type_19 = 0;
    /**
     * Максимальное количество пролонгаций за последние полгода по микрозаймам
     * @var int
     */
    public int $credit_prolongation_count_contracts_with_age_180_type_19 = 0;
    /**
     *
     * @var float
     */
    public float $credit_count_with_active_not_0_3_20_deliqfrom_more = 0;
    /**
     *
     * @var float
     */
    public float $credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90 = 0;
    /**
     *
     * @var float
     */
    public float $credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60 = 0;
    /**
     *
     * @var float
     */
    public float $credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30 = 0;
    /**
     *
     * @var float
     */
    public float $credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5 = 0;
    /**
     * Максимальная сумма просроченной задолженности
     * @var int
     */
    public int $cred_max_overdue = 0;
    private $scoringResult;
    private array $countOverdueDays = [];
    /**
     *
     * @var type
     */
    private $credit_min_age_in_days_for_overdue_sum_1000 = 0;
    /**
     *
     * @var type
     */
    private $credit_max_age_in_days_for_overdue_sum_1000 = 0;

    public function __construct($data = null)
    {
        if ($data) {
            #file_put_contents(__DIR__ . '/1.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS));
            $this->scoringResult = json_decode(json_encode($data));
            if ((int)$this->scoringResult->response->responsecode === 1) {
                $this->client = true;
            } else {
                $this->error = $this->scoringResult->response->responsestring;
            }
            if (isset($this->scoringResult->response->base_part->contract)) {
                $this->history = true;
                $this->setScoringRaiting($this->scoringResult->response->base_part);
                foreach ($this->scoringResult->response->base_part->contract as $contract) {
                    $this->setHistory($contract);
                    $this->setCountCreditDelayDays5($contract);
                    $this->setProlongationCount($contract);
                    $this->setBkiCoutOverdue($contract);
                    $this->setCreditsCreatedlast7day($contract);
                    $this->setCreditSummForType19days90($contract);
                    $this->setCreditSummForType19days180($contract);
                    $this->setBkiCountActiveCredit($contract);
                    $this->setCreditCountWithActiveNotDeliqFrom($contract);
                    $this->setSummOfAllTaCredSumPaid($contract);
                    $this->setTaCreditOverdue($contract);
                    $this->setBkiCoutOverdue1000($contract);
                    $this->setCreditCountActiveContractsWithAge90Type19($contract);
                    $this->historyCreditCount++;
                    $this->setAllPaymentActivCreditMonth($contract);
                }
            }
            $this->setBkiActiveCountOverdue();
            $this->setDelay();

            $this->credit_count_active_overdue_11_12_13_sum_1000 = $this->credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30 +
                $this->credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60 +
                $this->credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90;
        }
    }

    public function setScoringRaiting($base_part)
    {
        if (isset($base_part->scoring->score)) {
            $this->bkiscoring = (int)$base_part->scoring->score;
        }
    }

    public function setHistory($contract)
    {
        if (isset($contract->deal->type) and (int)$contract->deal->type === 3 and isset($contract->deal->date)) {
            $this->setupMicroCreditInfo($contract);
        } else {
            $this->setupOtherCreditInfo($contract);
        }
        $this->setupAllCreditInfo($contract);
    }

    public function setupMicroCreditInfo($contract)
    {
        $this->setCountCredits(3);
        $this->setInfoCredits($contract, 3, true);
        if (isset($contract->deal->sign_credit_card) and (int)$contract->deal->sign_credit_card === 1) {
            $this->bkicountcreditcard++;
        }
    }

    public function setCountCredits($type = 'all')
    {
        $var = 'count_all_contracts_type_' . $type;
        $this->$var++;
    }

    private function setInfoCredits($contract, $type = 'all', bool $sum = false)
    {
        $debtOverdueDate = false;
        if (isset($contract->debt_overdue->date)) {
            $debtOverdueDate = $contract->debt_overdue->date;
        }
        $status = $this->getContractStatus($contract);
        $var = 'count_' . $status . '_contracts_type_' . $type;
        if ($debtOverdueDate) {
            $this->setDebtOverdue($contract, $debtOverdueDate, $type, $status, $sum);
        }
        $this->setContractsInfoForDays($contract, $type);
        $this->$var++;
    }

    private function getContractStatus($contract): string
    {
        $status = 'active';
        if (isset($contract->contract_end->reason) and (int)$contract->contract_end->reason === 1) {
            $status = 'close';
        }
        return $status;
    }

    public function setDebtOverdue($contract, $date = false, $type = 'all', $status = 'active', bool $sum = false)
    {
        if ($date) {
            $days = $this->getCountDaysForDate($date);
            if ($days <= 5) {
                $var = 'count_with_' . $status . '_not_0_3_20_deliqfrom_0_deliqto_5';
            } elseif ($days > 5 and $days < 30) {
                $this->credit_count_active_11_12_13++;
                $this->credit_count_overdue_for_date_365++;
                $var = 'count_with_' . $status . '_not_0_3_20_deliqfrom_5_deliqto_30';
            } elseif ($days > 30 and $days < 60) {
                $this->credit_count_active_11_12_13++;
                $this->credit_count_overdue_for_date_365++;
                $var = 'count_with_' . $status . '_not_0_3_20_deliqfrom_30_deliqto_60';
            } elseif ($days > 60 and $days < 90) {
                $this->credit_count_overdue_for_date_365++;
                $var = 'count_with_' . $status . '_not_0_3_20_deliqfrom_60_deliqto_90';
            } elseif ($days > 90 and $days < 180) {
                $this->credit_count_overdue_for_date_365++;
                $var = 'count_with_' . $status . '_not_0_3_20_deliqfrom_90_deliqto_180';
            } elseif ($days > 180 and $days < 365) {
                $this->credit_count_overdue_for_date_365++;
                $var = 'count_with_' . $status . '_not_0_3_20_deliqfrom_180_deliqto_365';
            } else {
                $var = 'count_with_' . $status . '_not_0_3_20_deliqfrom_365_and_more';
            }
            $name = $var . '_for_type_' . $type;
            if ($sum) {
                $this->$var++;
            }
            $this->$name++;
        }
    }

    private function getCountDaysForDate(string $date): int
    {
        return (int)floor((time() - strtotime($date)) / (60 * 60 * 24));
    }

    public function setContractsInfoForDays($contract, $type)
    {
        $status = $this->getContractStatus($contract);
        $days = $this->getCountDaysForDate($contract->deal->date);
        if ($days > 0) {
            $countDays = 'all';
            if ($days <= 5) {
                $countDays = 5;
                $var = 'count_' . $status . '_contracts_with_age_0_deliqto_5_type_' . $type;
            } elseif ($days <= 30 and $days > 5) {
                $countDays = 30;
                $var = 'count_' . $status . '_contracts_with_age_5_deliqto_30_type_' . $type;
            } elseif ($days <= 60 and $days > 30) {
                $countDays = 60;
                $var = 'count_' . $status . '_contracts_with_age_30_deliqto_60_type_' . $type;
            } elseif ($days <= 90 and $days > 60) {
                $countDays = 90;
                $var = 'count_' . $status . '_contracts_with_age_60_deliqto_90_type_' . $type;
            } elseif ($days <= 180 and $days > 90) {
                $countDays = 365;
                $var = 'count_' . $status . '_contracts_with_age_90_deliqto_180_type_' . $type;
            } elseif ($days <= 365 and $days > 180) {
                $countDays = 'more';
                $var = 'count_' . $status . '_contracts_with_age_180_deliqto_365_type_' . $type;
            } else {
                $var = 'count_' . $status . '_contracts_with_age_365_and_more_type_' . $type;
            }
            $daysInterval = [5, 30, 60, 90, 180, 365, 36500];
            $status = $this->getContractStatus($contract);
            foreach ($daysInterval as $dayCount) {
                if ($days <= $dayCount) {
                    $last_payout_sum = 0;
                    if (isset($contract->payments->last_payout_sum)) {
                        $last_payout_sum = (int)$contract->payments->last_payout_sum;
                    }
                    $name = $dayCount;
                    if ($dayCount === 36500) {
                        $name = 'more';
                    }
                    if ($days <= 30 and $type === 'all') {
                        $this->interestForLastMonth++;
                    }
                    if ($days <= 90 and $type === '3') {
                        $this->credit_sum_paid_for_type_19_days_90 += $last_payout_sum;
                    }
                    if ($days <= 180 and $type === '3') {
                        $this->credit_sum_paid_for_type_19_days_180 += $last_payout_sum;
                    }
                    $this->setPaymentsSumm($contract, $status, $name, $type);
                    $paramDaysName = 'count_of_' . $status . '_contracts_in_the_last_' . $name . '_days_by_type_' . $type;
                    $this->$paramDaysName++;
                }
            }
            if (isset($contract->contract_amount->sum) and (int)$contract->contract_amount->sum > 300000) {
                $this->credit_count_with_sum_more_300000++;
            }
            $paySum = 0;
            if (isset($contract->payments->paid_percent_sum)) {
                $paySum = (int)$contract->payments->paid_percent_sum;
            }
            if ($days <= 30 and $type === 3) {
                $this->paid_percent_sum_for_30_type_3 += $paySum;
            } elseif ($days <= 60 and $type === 3) {
                $this->paid_percent_sum_for_60_type_3 += $paySum;
            } elseif ($days <= 90 and $type === 3) {
                $this->paid_percent_sum_for_90_type_3 += $paySum;
            }
            $this->$var++;
        }
        if ($type === 3) {
            $this->setCountDaysForLastOpenCreditType19($contract);
        }
    }

    public function setPaymentsSumm($contract, $status, $name, $type)
    {
        $allSummName = 'amount_of_payments_under_' . $status . '_contracts_for_the_last_' . $name . '_days_for_type_' . $type;
        $minSummName = 'min_amount_of_payments_under_' . $status . '_contracts_for_the_last_' . $name . '_days_for_type_' . $type;
        $maxSummName = 'max_amount_of_payments_under_' . $status . '_contracts_for_the_last_' . $name . '_days_for_type_' . $type;
        $debtSumm = 0;
        if (isset($contract->payments->paid_sum)) {
            $debtSumm = (int)$contract->payments->paid_sum;
        }
        if ($this->$maxSummName < $debtSumm) {
            $this->$maxSummName = $debtSumm;
        }
        if ($debtSumm > 0) {
            if ($this->$minSummName > $debtSumm and $this->$minSummName !== 0) {
                $this->$minSummName = $debtSumm;
            } else {
                $this->$minSummName = $debtSumm;
            }
        }
        if ($status === 'close' and isset($contract->debt->first_sum)) {
            $this->ta_cred_sum_paid += (int)$contract->debt->first_sum;
        }
        if (isset($contract->payments->paid_sum)) {
            $this->$allSummName += (int)$contract->payments->paid_sum;
        }
    }

    private function setCountDaysForLastOpenCreditType19($contract)
    {
        $days = (int)floor((time() - strtotime($contract->deal->date)) / (60 * 60 * 24));
        if (!$this->credit_last_open_days_for_type_19) {
            $this->credit_last_open_days_for_type_19 = $days;
        } elseif ($this->credit_last_open_days_for_type_19 > $days) {
            $this->credit_last_open_days_for_type_19 = $days;
        }
        $this->setCreditLastOpenDateForType19($contract);
    }

    public function setCreditLastOpenDateForType19($contract)
    {
        if (isset($contract->deal->date) and $this->getContractStatus($contract) !== 'close') {
            $time = strtotime($contract->deal->date);
            if (!$this->credit_last_open_date_for_type_19) {
                $this->credit_last_open_date_for_type_19 = date("d.m.Y", $time);
            } elseif ($time > strtotime($this->credit_last_open_date_for_type_19)) {
                $this->credit_last_open_date_for_type_19 = date("d.m.Y", $time);
            }
        }
    }

    public function setupOtherCreditInfo($contract)
    {
        $this->setCountCredits('other');
        $this->setInfoCredits($contract, 'other', true);
    }

    public function setupAllCreditInfo($contract)
    {
        $this->setCountCredits('all');
        $this->setInfoCredits($contract, 'all', false);
        if (strtotime($contract->deal->date) and floor((time() - strtotime($contract->deal->date)) / (60 * 60 * 24)) <= 365) {
            $this->credit_count_contracts_with_age_365++;
        }
    }

    private function setCountCreditDelayDays5($contract)
    {
        $sum = 0;
        if (isset($contract->debt_overdue->sum) and (float)$contract->debt_overdue->sum > 0) {
            $sum = (float)$contract->debt_overdue->sum;
        }
        if ($sum and (int)$contract->payments->overdue_day <= 5) {
            $this->credit_count_delay_5++;
        }
    }

    private function setProlongationCount($contract)
    {
        if (isset($contract->contract_changes)) {
            $contract_changes = 0;
            foreach ($contract->contract_changes as $changes) {
                $days = false;
                if (isset($changes->date)) {
                    $time = (time() - strtotime($changes->date)) / (60 * 60 * 24);
                    if ($time <= 180) {
                        $days = true;
                    }
                }
                if (
                    isset($changes->type)
                    and isset($changes->special_type)
                    and (int)$changes->type === 3
                    and (int)$changes->special_type === 11
                    and $days
                ) {
                    $contract_changes++;
                    if (!$this->credit_prolongation_count_contracts_with_age_180_type_19
                        or $this->credit_prolongation_count_contracts_with_age_180_type_19 < $contract_changes
                    ) {
                        $this->credit_prolongation_count_contracts_with_age_180_type_19 = $contract_changes;
                    }
                }
            }
        }
    }

    public function setBkiCoutOverdue($contract)
    {
        $sum = 0;
        if (isset($contract->debt_current->sum)) {
            $sum = (int)$contract->debt_current->sum;
        }
        if ($sum > 0) {
            $this->bkicountoverdue++;
        }
    }

    public function setCreditsCreatedlast7day($contract)
    {
        if (isset($contract->deal->date)) {
            $days = round((time() - strtotime($contract->deal->date)) / (60 * 60 * 24));
            if ($days <= 7) {
                $this->creditsCreatedlast7day++;
            }
        }
    }

    public function setCreditSummForType19days90($contract)
    {
        if (isset($contract->deal->type) and (int)$contract->deal->type === 3 and isset($contract->deal->date)) {
            $this->credit_count_contracts_with_type_19++;
            $time = strtotime($contract->deal->date) + (60 * 60 * 24 * 90);
            if ($time >= time()) {
                $summ = 0;
                $this->credit_count_for_type_19_days_90++;
                if (isset($contract->payments->last_payout_sum)) {
                    $summ = (int)$contract->payments->last_payout_sum;
                }
                $this->credit_summ_for_type_19_days_90 += $summ;
                $this->credit_avg_paid_for_type_19_days_90 = ceil($this->credit_summ_for_type_19_days_90 / $this->credit_count_for_type_19_days_90);
            }
        }
    }

    public function setCreditSummForType19days180($contract)
    {
        if (isset($contract->deal->type) and (int)$contract->deal->type === 3 and isset($contract->deal->date)) {
            $time = strtotime($contract->deal->date) + (60 * 60 * 24 * 180);
            if ($time >= time()) {
                $summ = 0;
                if (isset($contract->payments->last_payout_sum)) {
                    $summ = (int)$contract->payments->last_payout_sum;
                }
                $this->credit_count_for_type_19_days_180++;
                $this->credit_summ_for_type_19_days_180 += $summ;
                $this->credit_avg_paid_for_type_19_days_180 = ceil($this->credit_summ_for_type_19_days_180 / $this->credit_count_for_type_19_days_180);
            }
        }
    }

    public function setBkiCountActiveCredit($contract)
    {
        if (!isset($contract->contract_end->date)) {
            $this->bkicountactivecredit++;
        }
    }

    public function setCreditCountWithActiveNotDeliqFrom($contract)
    {
        $time = false;
        if (isset($contract->debt_overdue->date)) {
            $time = strtotime($contract->debt_overdue->date);
        }
        if (isset($contract->deal->date) and
            isset($contract->debt_overdue->date) and
            isset($contract->debt_overdue->sum) and
            ((int)$contract->debt_overdue->sum) > 0 and
            $time and
            !isset($contract->contract_end->date)
        ) {
            $days = (time() - $time) / (60 * 60 * 24);
            $days90 = (strtotime($contract->deal->date) + (60 * 60 * 24 * 90));
            if ($days <= 5 and $days90 >= time()) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5++;
            } elseif ($days > 5 and $days <= 30 and $days90 >= time()) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30++;
            } elseif ($days > 30 and $days <= 60 and $days90 >= time()) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60++;
            } elseif ($days > 60 and $days <= 90 and $days90 >= time()) {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90++;
            } else {
                $this->credit_count_with_active_not_0_3_20_deliqfrom_more++;
            }
        }
    }

    public function setSummOfAllTaCredSumPaid($contract)
    {
        if (isset($contract->debt->first_sum)) {
            $this->summ_of_all_ta_cred_sum_paid += (int)$contract->debt->first_sum;
        }
    }

    public function setTaCreditOverdue($contract)
    {
        $op_sum = 0;
        $percent_sum = 0;
        $other_sum = 0;
        $days = 0;
        if (isset($contract->debt_overdue->op_sum)) {
            $op_sum = (int)$contract->debt_overdue->op_sum;
        }
        if (isset($contract->debt_overdue->percent_sum)) {
            $percent_sum = (int)$contract->debt_overdue->percent_sum;
        }
        if (isset($contract->debt_overdue->other_sum)) {
            $other_sum = (int)$contract->debt_overdue->other_sum;
        }
        if (isset($contract->debt_overdue->date)) {
            $days = $this->getCountDaysForDate($contract->debt_overdue->date);
        }
        $allSumm = ($op_sum + $percent_sum + $other_sum);
        if ($allSumm > 0) {
            $this->bkiactivecountoverdue++;
            $this->bkiallamountoverdue += $allSumm;
            $this->ta_cred_sum_overdue += $op_sum;
            $this->countOverdueDays[] = $days;
            # file_put_contents(__DIR__ . '/' . $contract->uid->id . '.json', json_encode($contract, JSON_PRETTY_PRINT));
        }
    }

    public function setBkiCoutOverdue1000($contract)
    {
        $sum = 0;
        if (isset($contract->debt_current->sum)) {
            $sum = (int)$contract->debt_current->sum;
        }
        if ($sum > 1000) {
            $this->bkicoutoverdue1000++;
        }
    }

    public function setCreditCountActiveContractsWithAge90Type19($contract)
    {
        if (isset($contract->deal->date) and
            isset($contract->deal->type) and
            ((int)$contract->deal->type) === 3 and
            !isset($contract->contract_end->date)
        ) {
            $times = (strtotime($contract->deal->date) + (60 * 60 * 24 * 90));
            if ($times >= time()) {
                $this->credit_count_active_contracts_with_age_90_type_19++;
            }
        }
    }

    public function setBkiActiveCountOverdue()
    {
        if ($this->countOverdueDays) {
            $this->credit_min_age_in_days_for_overdue_sum_1000 = min($this->countOverdueDays);
            $this->credit_max_age_in_days_for_overdue_sum_1000 = max($this->countOverdueDays);
        }
    }

    private function setDelay()
    {
        $list = [];
        if (isset($this->scoringResult->response->extra_part->summary->credit)) {
            $list = $this->scoringResult->response->extra_part->summary->credit;
        }

        foreach ($list as $creditInfo) {
            $cred_max_overdue = (int)$creditInfo->cred_max_overdue;
            if ($this->cred_max_overdue < $cred_max_overdue) {
                $this->cred_max_overdue = $cred_max_overdue;
            }
        }
    }

    public function setDebtSumm($contract, $type)
    {
        $allDebtSummName = 'sum_debt_overdue_with_type_' . $type;
        $minDebtSummName = 'min_sum_debt_overdue_with_type_' . $type;
        $maxDebtSummName = 'max_sum_debt_overdue_with_type_' . $type;
        $debtSumm = 0;
        if (isset($contract->debt_overdue->op_sum)) {
            $debtSumm = (int)$contract->debt_overdue->op_sum;
        }
        if ($this->$maxDebtSummName < $debtSumm) {
            $this->$maxDebtSummName = $debtSumm;
        }
        if ($debtSumm > 0) {
            if ($this->$minDebtSummName > $debtSumm and $this->$minDebtSummName !== 0) {
                $this->$minDebtSummName = $debtSumm;
            } else {
                $this->$minDebtSummName = $debtSumm;
            }
        }
        $this->$allDebtSummName += $debtSumm;
    }

    public function toArray()
    {
        return (object)[
            'all_payment_active_credit_month'=>$this->all_payment_active_credit_month,
            "bkicountoverdue" => $this->bkicountoverdue,
            "bkiactivecountoverdue" => $this->bkiactivecountoverdue,
            "bkicoutoverdue1000" => $this->bkicoutoverdue1000,
            "bkiallamountoverdue" => $this->bkiallamountoverdue,
            "bkicountcreditcard" => $this->bkicountcreditcard,
            "bkicountactivecredit" => $this->bkicountactivecredit,
            "bkiscoring" => $this->bkiscoring,
            "creditsCreatedlast7day" => $this->creditsCreatedlast7day,
            "interestForLastMonth" => $this->interestForLastMonth,
            "historyCreditCount" => $this->historyCreditCount,
            "summ_of_all_ta_cred_sum_paid" => $this->summ_of_all_ta_cred_sum_paid,
            "credit_count_with_sum_more_300000" => $this->credit_count_with_sum_more_300000,
            "credit_avg_paid_for_type_19_days_90" => $this->credit_avg_paid_for_type_19_days_90,
            "credit_count_for_type_19_days_90" => $this->credit_count_for_type_19_days_90,
            "credit_summ_for_type_19_days_180" => $this->credit_summ_for_type_19_days_90,
            "credit_avg_paid_for_type_19_days_180" => $this->credit_avg_paid_for_type_19_days_180,
            "credit_count_for_type_19_days_180" => $this->credit_count_for_type_19_days_180,
            "credit_summ_for_type_19_days_180" => $this->credit_summ_for_type_19_days_180,
            "credit_last_open_date_for_type_19" => $this->credit_last_open_date_for_type_19,
            "credit_last_open_days_for_type_19" => $this->credit_last_open_days_for_type_19,
            "credit_count_overdue_for_date_365" => $this->credit_count_overdue_for_date_365,
            "credit_count_delay_5" => $this->credit_count_delay_5,
            "credit_count_active_overdue_11_12_13_sum_1000" => $this->credit_count_active_overdue_11_12_13_sum_1000,
            "credit_min_age_in_days_for_overdue_sum_1000" => $this->credit_min_age_in_days_for_overdue_sum_1000,
            "credit_max_age_in_days_for_overdue_sum_1000" => $this->credit_max_age_in_days_for_overdue_sum_1000,
            "credit_count_active_contracts_with_age_90_type_19" => $this->credit_count_active_contracts_with_age_90_type_19,
            "credit_prolongation_count_contracts_with_age_180_type_19" => $this->credit_prolongation_count_contracts_with_age_180_type_19,
            "credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5" => $this->credit_count_with_active_not_0_3_20_deliqfrom_0_deliqto_5,
            "credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30" => $this->credit_count_with_active_not_0_3_20_deliqfrom_5_deliqto_30,
            "credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60" => $this->credit_count_with_active_not_0_3_20_deliqfrom_30_deliqto_60,
            "credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90" => $this->credit_count_with_active_not_0_3_20_deliqfrom_60_deliqto_90,
            "credit_count_with_active_not_0_3_20_deliqfrom_more" => $this->credit_count_with_active_not_0_3_20_deliqfrom_more,
            "credit_count_contracts_with_age_365" => $this->credit_count_contracts_with_age_365,
            "credit_count_contracts_with_type_19" => $this->credit_count_contracts_with_type_19,
            "credit_count_overdue_for_date_365" => $this->credit_count_overdue_for_date_365,
            "ta_cred_sum_paid" => $this->ta_cred_sum_paid,
            "paid_percent_sum_for_30_type_3" => $this->paid_percent_sum_for_30_type_3,
            "paid_percent_sum_for_60_type_3" => $this->paid_percent_sum_for_60_type_3,
            "paid_percent_sum_for_90_type_3" => $this->paid_percent_sum_for_90_type_3,
            "ta_cred_sum_overdue" => $this->ta_cred_sum_overdue,
            "client" => $this->client,
            "history" => $this->history,
            "error" => $this->error
        ];
    }

    private function setAllPaymentActivCreditMonth($contract)
    {
        if(!isset($contract->contract_end->date) AND isset($contract->payments->last_payout_sum)){
            $this->all_payment_active_credit_month += (float)$contract->payments->last_payout_sum;
        }
    }

}
