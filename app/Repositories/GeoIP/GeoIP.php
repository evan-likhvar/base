<?php

namespace App\Repositories\GeoIP;


class GeoIP
{
    private $countryISO2;
    private $countryLanguage;

    public function __construct($countryISO2 = null, $countryLanguage = null)
    {
        if (!empty($countryISO2) && !empty($countryLanguage)) {
            $this->countryLanguage = $countryLanguage;
            $this->countryISO2 = $countryISO2;
        }
        $this->selfValidate();
    }


    public function getCountryLanguage(): string
    {
        return $this->countryLanguage;
    }

    public function getCountryISO2(): string
    {
        return $this->countryISO2;
    }

    private function selfValidate(): void
    {
        if (empty($this->countryISO2) || empty($this->countryLanguage)) {
            $this->setDefault();
        }
    }

    private function setDefault(): void
    {
        $this->countryISO2 = config('settings.defaultCountryISO2');
        $this->countryLanguage = config('settings.defaultCountryLanguage');
    }
}