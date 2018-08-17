<?php

namespace Tests\Unit;

use App\Repositories\GeoIP\GeoIP;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GeoIPTest extends TestCase
{

    public function test_GeoIP_SetDefaultValues()
    {
        $geoIP = new GeoIP();
        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }

    public function test_GeoIP_SetUAValues()
    {
        $geoIP = new GeoIP('UA','ua');
        $this->assertEquals('UA',$geoIP->getCountryISO2());
        $this->assertEquals('ua',$geoIP->getCountryLanguage());
    }

    public function test_GeoIP_SetDefaultWithMissCountryValues()
    {
        $geoIP = new GeoIP(null,'ua');
        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }

    public function test_GeoIP_SetDefaultWithMissLanguageValues()
    {
        $geoIP = new GeoIP('UA');
        $this->assertEquals('GB',$geoIP->getCountryISO2());
        $this->assertEquals('en',$geoIP->getCountryLanguage());
    }
}
