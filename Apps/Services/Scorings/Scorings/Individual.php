<?php

namespace Apps\Services\Scorings\Scorings;

if (!defined('ROOT')) {
    exit();
}

use Apps\Core\Helpers\Valid;
use Apps\Core\Request\Put;
use Apps\Services\Scorings\Helpers\Address;
use Apps\Services\Scorings\Library\CodesOfCountriesAccordingToOKSM;
use Apps\Services\Scorings\Library\ConsentExpirationDate;
use Apps\Services\Scorings\Library\Education;
use Apps\Services\Scorings\Library\FamilyStatus;
use Apps\Services\Scorings\Library\GenderOfSubject;
use Apps\Services\Scorings\Library\GroundsForTheTransferOfConsent;
use Apps\Services\Scorings\Library\HowToApplyForLoan;
use Apps\Services\Scorings\Library\InformingAboutAdministrativeResponsibility;
use Apps\Services\Scorings\Library\OKWCurrencyCodes;
use Apps\Services\Scorings\Library\PeriodicityOfIncome;
use Apps\Services\Scorings\Library\PurposesOfRequestAndConsent;
use Apps\Services\Scorings\Library\TypesOfCredits;
use Apps\Services\Scorings\Library\TypesOfIdentityDocuments;
use Apps\Services\Scorings\Xml\Generate;

/**
 * Класс Individual
 * @version 0.0.1
 * @package Apps\Services\Scorings\Scorings\Individual
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
class Individual extends Generate
{

    public function scoring(Put $user)
    {
        $addressReg = new Address($user->addr_reg);
        $addressFact = new Address($user->addr_fact);
        $xml = $this->startDocument();
        $xml->startElement('bki_request', [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'version' => '4.0',
                'partnerid' => $this->config->partnerid
            ]
        )->startElement('request', ['num' => 1])
            ->startElement('private')
            ->startElement('name')
            ->addElement('last', mb_strtoupper($user->last))
            ->addElement('first', mb_strtoupper($user->first))
            ->addElement('middle', mb_strtoupper($user->middle))
            ->closeElement('name')
            ->addElement('gender', GenderOfSubject::get($user->gender)->code)
            ->addElement('birthday', $this->dateFormat($user->birthday))
            ->addElement('birthplace', mb_strtoupper($user->birthplace))
            ->startElement('doc')
            ->addElement('country', CodesOfCountriesAccordingToOKSM::get($user->doc->country)->code)
            ->addElement('type', TypesOfIdentityDocuments::get($user->doc->type)->code)
            ->addElement('serial', $user->doc->serial)
            ->addElement('number', $user->doc->number)
            ->addElement('date', $this->dateFormat($user->doc->date))
            ->addElement('who', mb_strtoupper($user->doc->who))
            ->addElement('end_date', $this->dateFormat($user->doc->end_date))->closeElement('doc')
            ->startElement('inn')->addElement('code', 1)->addElement('no', $user->inn)->closeElement('inn')
            ->addElement('snils', $user->snils)->closeElement('private')
            ->startElement('reason')->addElement('code', PurposesOfRequestAndConsent::get($user->reason)->code)->closeElement('reason')
            ->startElement('consent')
            ->startElement('reason')->addElement('code', PurposesOfRequestAndConsent::get($user->reason)->code)->closeElement('reason')
            ->addElement('date', $this->dateFormat(date('d.m.Y', strtotime('-1 day'))))
            ->addElement('contract_date', $this->dateFormat(date("d.m.Y")))
            ->addElement('transfer', GroundsForTheTransferOfConsent::get($user->transfer)->code)
            ->addElement('period', ConsentExpirationDate::get($user->period)->code)
            ->addElement('request_user', mb_strtoupper($this->config->orgName))
            ->addElement('request_ogrn', $this->config->ogrn)
            ->addElement('request_inn', $this->config->inn)
            ->addElement('admcode_inform', InformingAboutAdministrativeResponsibility::get($user->adm_inform)->code)
            ->closeElement('consent')
            ->startElement('application')
            ->addElement('income', $user->application->income)
            ->addElement('income_frequency', PeriodicityOfIncome::get($user->application->income_frequency)->code)
            ->addElement('application_date', date("d.m.Y H:i:s"))
            ->addElement('application_way', HowToApplyForLoan::get($user->application->application_way)->code)
            ->addElement('cred_type', TypesOfCredits::get($user->application->cred_type)->code)
            ->addElement('cred_typecb', $user->application->cred_typecb)
            ->addElement('cred_currency', OKWCurrencyCodes::get($user->application->cred_currency)->code)
            ->addElement('cred_sum', $user->application->cred_sum)
            ->addElement('cred_deposit', $user->application->cred_deposit)
            ->addElement('cred_frequency_payment', $user->application->cred_frequency_payment)
            ->addElement('cred_duration', $user->application->cred_duration)
            ->addElement('cred_security', $user->application->cred_security)
            ->startElement('private')
            ->addElement('marriage', FamilyStatus::get($user->application->private->marriage)->code)
            ->addElement('dependants_bel18', $user->application->private->dependants_bel18)
            ->addElement('dependants_und18', $user->application->private->dependants_und18)
            ->addElement('education', Education::get($user->application->private->education)->code)
            ->addElement('phone_mobile', Valid::phoneFormat($user->application->private->phone_mobile))
            ->addElement('phone_home', Valid::phoneFormat($user->application->private->phone_home))
            ->addElement('phone_work', Valid::phoneFormat($user->application->private->phone_work))
            ->addElement('email', Valid::hasEmail($user->application->private->email))
            ->closeElement('private')
            ->closeElement('application')
            ->startElement('addr_reg')
            ->addElement('index', $addressReg->index)
            ->addElement('addr_total', $addressReg->addr_total)
            ->addElement('country', $addressReg->country)
            ->addElement('country_text', $addressReg->country_text)
            ->addElement('region', $addressReg->region)
            ->addElement('fias', $addressReg->fias)
            ->addElement('okato', $addressReg->okato)
            ->addElement('other_statement', $addressReg->other_statement)
            ->addElement('street', $addressReg->street)
            ->addElement('house', $addressReg->house)
            ->addElement('domain', $addressReg->domain)
            ->addElement('block', $addressReg->block)
            ->addElement('build', $addressReg->build)
            ->addElement('apartment', $addressReg->apartment)
            ->closeElement('addr_reg')
            ->startElement('addr_fact')
            ->addElement('index', $addressFact->index)
            ->addElement('addr_total', $addressFact->addr_total)
            ->addElement('country', $addressFact->country)
            ->addElement('country_text', $addressFact->country_text)
            ->addElement('region', $addressFact->region)
            ->addElement('fias', $addressFact->fias)
            ->addElement('okato', $addressFact->okato)
            ->addElement('other_statement', $addressFact->other_statement)
            ->addElement('street', $addressFact->street)
            ->addElement('house', $addressFact->house)
            ->addElement('domain', $addressFact->domain)
            ->addElement('block', $addressFact->block)
            ->addElement('build', $addressFact->build)
            ->addElement('apartment', $addressFact->apartment)
            ->closeElement('addr_fact')
            ->addElement('type', $this->config->type)
            ->closeElement('request')
            ->closeElement('bki_request');
        return $xml->get();
    }

    public function info(Put $user)
    {
        $xml = $this->startDocument();
        $xml->startElement('bki_request', ['version' => '4.0', 'partnerid' => $this->config->partnerid])
            ->startElement('request', ['num' => 1])
            ->startElement('private')->startElement('name')
            ->addElement('last', mb_strtoupper($user->last))->addElement('first', mb_strtoupper($user->first))
            ->addElement('middle', mb_strtoupper($user->middle))->closeElement()
            ->addElement('birthday', $this->dateFormat($user->birthday))
            ->startElement('doc')->addElement('type', 21)->addElement('serial', $user->doc->serial)
            ->addElement('number', $user->doc->number)->addElement('date', $this->dateFormat($user->doc->date))
            ->closeElement()->closeElement()->startElement('reason')
            ->addElement('code', 3)->closeElement()->startElement('consent')
            ->startElement('reason')->addElement('code', 3)->closeElement()
            ->addElement('date', $this->dateFormat(date('d.m.Y', strtotime('-1 day'))))
            ->addElement('period', 2)->addElement('request_user', mb_strtoupper($this->config->orgName))
            ->addElement('request_ogrn', $this->config->ogrn)->addElement('request_inn', $this->config->inn)
            ->addElement('admcode_inform', 1)->closeElement()
            ->addElement('type', $this->config->type)->closeElement()
            ->closeElement();
        return $xml->get();
    }

}
