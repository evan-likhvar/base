<?php

namespace App\Repositories\GeoIP;

use GuzzleHttp\Client;

class GeoIPFromIpStack implements GeoIPProviderInterface
{

    public function getGeoIP(string $ip = '127.0.0.1'): GeoIP
    {
        try {
            $geoResponse = json_decode((new Client())
                ->request('GET', "http://api.ipstack.com/$ip?access_key=" . config('settings.IP_STACK_KEY'))
                ->getBody()->getContents());
        } catch (\Exception $e) {
            return new GeoIP();
        }

        return $this->setGeoIPFromResponse($geoResponse);
    }

    private function setGeoIPFromResponse($geoResponse): GeoIP
    {
        if (!empty($geoResponse->country_code) && !empty($geoResponse->location->languages[0]->code)){
            return new GeoIP($geoResponse->country_code,$geoResponse->location->languages[0]->code);
        } else
            return new GeoIP();
    }

}