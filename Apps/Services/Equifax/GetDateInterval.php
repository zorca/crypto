<?php

namespace Apps\Services\Equifax;

use Apps\Core\AbstractClasses\AbstractService;

class GetDateInterval extends AbstractService
{
    public function getStartDate(): int
    {
        $date = date('d.m.Y 00:00:00', strtotime('-7 days'));
        $date_str = $this->get->get('start_date');
        if ($date_str) {
            $date = date('d.m.Y 00:00:00', strtotime($date_str));
        }
        $lastDays = $this->getLastDays();
        if ($lastDays) {
            $date = date("d.m.Y 00:00:00", strtotime($lastDays));
        }
        return strtotime($date);
    }

    private function getLastDays()
    {
        $lastDays = false;
        $days = $this->get->get('last_days', 'int');
        if ($days > 0) {
            $lastDays = date('d.m.Y', strtotime('-' . $days . ' days'));
        }
        $today = $this->getToDay();
        if ($today) {
            $lastDays = $today;
        }
        return $lastDays;
    }

    private function getToDay()
    {
        $today = false;
        if ($this->get->get('today', 'bool')) {
            $today = date('d.m.Y 00:00:00');
        }
        $day = $this->getDay();
        if ($day) {
            $today = $day;
        }
        return $today;
    }

    private function getDay()
    {
        $day = $this->get->get('day');
        if ($day) {
            return date('d.m.Y 00:00:00', strtotime($day));
        }
        return false;
    }

    public function getEndDate(): int
    {
        $date = date('d.m.Y');
        $date_str = $this->get->get('end_date');
        if ($date_str) {
            $date = date('d.m.Y 23:59:59', strtotime($date_str));
        }
        $today = $this->getToDay();
        if ($today) {
            $date = date("d.m.Y 23:59:59", strtotime($today));
        }
        return strtotime($date);
    }
}