<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 17.08.18
 * Time: 13:34
 */

namespace App\Repositories\GeoIP;


interface GeoIPProviderInterface
{
    public function getGeoIP(string $ip = '127.0.0.1'): GeoIP;
}