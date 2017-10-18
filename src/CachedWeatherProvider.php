<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 18/10/2017
 * Time: 20:22
 */

namespace Nfq\Weather;

use Nfq\Weather\WeatherProviderInterface;
use Nfq\Weather\CacheItemPoolInterface;

class CachedWeatherProvider implements WeatherProviderInterface
{
    private $provider, $cache;

    public function __construct(WeatherProviderInterface $provider, $cache)
    {
        $this->provider = $provider;
        $this->cache = $cache;
    }

    public function fetch(Location $location): Weather
    {


    }
}