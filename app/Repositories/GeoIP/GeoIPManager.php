<?php

namespace App\Repositories\GeoIP;

use Illuminate\Http\Request;

class GeoIPManager
{
    const GEO_IP_PROVIDERS_NAMES = [
        'ipStack' => GeoIPFromIpStack::class
    ];

    private $geoIP;
    private $ip;
    private $providerName;

    public function __construct(string $ip = null, string $provider = null)
    {
        try {
            $this->ip = $ip ? $ip : Request::capture()->get('ip');
        } catch (\Exception $e) {
            $this->ip = '127.0.0.1';
        }

        if (empty($this->ip))
            $this->ip = '127.0.0.1';

        $this->providerName = $provider ? $provider : key(self::GEO_IP_PROVIDERS_NAMES);

        $this->setGeoIP();
    }

    public function getCountryISO2(): string
    {
        return $this->geoIP->getCountryISO2();
    }

    public function getCountryLanguage(): string
    {
        return $this->geoIP->getCountryLanguage();
    }

    private function setGeoIP(): void
    {
        if ($this->ip == '127.0.0.1' || strpos($this->ip, '192.168.') === true) {
            $this->geoIP = new GeoIP();
        }
        $this->geoIP = $this->geoIPRequest();
    }

    private function geoIPRequest(): GeoIP
    {
        return $this->getProviderObject()->getGeoIP($this->ip);
    }

    private function getProviderObject(): object
    {
        try {
            $providerClass = self::GEO_IP_PROVIDERS_NAMES[$this->providerName];
            $provider = new $providerClass;
        } catch (\Exception $e) {
            $providerName = key(self::GEO_IP_PROVIDERS_NAMES);
            $providerClass = self::GEO_IP_PROVIDERS_NAMES[$providerName];
            $provider = new $providerClass;
        }

        return $provider;
    }

}