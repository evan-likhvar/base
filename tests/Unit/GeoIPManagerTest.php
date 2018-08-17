<?php

namespace Tests\Unit;

use App\Repositories\GeoIP\GeoIPManager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GeoIPManagerTest extends TestCase
{

    public function test_GeoIPManager_emptyIP()
    {
        $geoIP = (new GeoIPManager());

        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }

    public function test_GeoIPManager_localIP()
    {
        $geoIP = (new GeoIPManager('192.168.0.2'));

        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());

        unset($geoIP);

        $geoIP = (new GeoIPManager('127.0.0.1'));

        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());


    }

    public function test_GeoIPManager_googlelIP()
    {
        $geoIP = (new GeoIPManager('8.8.8.8'));

        $this->assertEquals('US',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }

    public function test_GeoIPManager_googlelIP_ipstack()
    {
        $geoIP = (new GeoIPManager('8.8.8.8','ipStack'));

        $this->assertEquals('US',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }

    public function test_GeoIPManager_googlelIP_wrong_provider()
    {
        $geoIP = (new GeoIPManager('8.8.8.8','ipdthryack'));

        $this->assertEquals('US',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }
}
