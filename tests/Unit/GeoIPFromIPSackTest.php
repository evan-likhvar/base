<?php

namespace Tests\Unit;

use App\Repositories\GeoIP\GeoIPFromIpStack;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GeoIPFromIPStackTest extends TestCase
{

    public function test_GeoIPFromIpStack_emptyIP()
    {
        $geoIP = (new GeoIPFromIpStack())->getGeoIP();

        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }

    public function test_GeoIPFromIpStack_localIP()
    {
        $geoIP = (new GeoIPFromIpStack())->getGeoIP('192.168.0.2');

        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }

    public function test_GeoIPFromIpStack_googlelIP()
    {
        $geoIP = (new GeoIPFromIpStack())->getGeoIP('8.8.8.8');

        $this->assertEquals('US',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }
}
