<?php

namespace Apps\Services\Scorings\Helpers;

if (!defined('ROOT')) {
    exit();
}

use Apps\Services\Scorings\Library\CodesOfCountriesAccordingToOKSM;
use Apps\Services\Scorings\Library\RegionCodes;

/**
 * Класс Address
 * @version 0.0.1
 * @package Apps\Services\Scorings\Helpers\Address
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class Address
{

    public ?string $index = null;
    public ?string $addr_total = null;#
    public ?string $country = null; #
    public ?string $country_text = null;#
    public ?string $region = null;#
    public ?string $fias = null; #
    public ?string $okato = null; #
    public ?string $other_statement = null; #
    public ?string $street = null; #
    public ?string $house = null; #
    public ?string $domain = null;
    public ?string $block = null;
    public ?string $build = null;
    public ?string $apartment = null;

    public function __construct($address)
    {
        foreach ($address as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
        if ($address->addr_total) {
            $this->apartment = null;
            $this->block = null;
            $this->build = null;
            $this->country = null;
            $this->country_text = null;
            $this->domain = null;
            $this->fias = null;
            $this->house = null;
            $this->okato = null;
            $this->other_statement = null;
            $this->region = null;
            $this->street = null;
        }
    }

    public function setRegion(?string $region = null)
    {
        $this->region = RegionCodes::get($region)->code;
    }

    public function setAddr_total(?string $address = null)
    {
        $this->addr_total = mb_strtoupper(trim($address));
    }

    public function setCountry(?string $country = null)
    {
        $this->country = CodesOfCountriesAccordingToOKSM::get($country)->code;
        if ($this->country === 999) {
            $this->country_text = CodesOfCountriesAccordingToOKSM::get($country)->name;
        }
    }

    public function setHouse(?string $house = null)
    {
        $this->house = $house;
    }

    public function setFias(?string $fias = null)
    {
        $this->fias = $fias;
    }

    public function setOkato(?string $okato = null)
    {
        $this->okato = $okato;
    }

    public function setOther_statement(?string $other_statement = null)
    {
        $this->other_statement = $other_statement;
    }

    public function setStreet(?string $street = null)
    {
        $this->street = $street;
    }

    public function setDomain(?string $domain = null)
    {
        $this->domain = $domain;
    }

    public function setBlock(?string $block = null)
    {
        $this->block = $block;
    }

    public function setBuild(?string $build = null)
    {
        $this->build = $build;
    }

    public function setApartment(?string $apartment = null)
    {
        $this->apartment = $apartment;
    }

    public function setIndex(?string $index = null)
    {
        $this->index = $index;
    }

}
