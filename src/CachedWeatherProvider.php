<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 18/10/2017
 * Time: 20:22
 */

namespace Nfq\Weather;

use Nfq\Weather\WeatherProviderInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


class CachedWeatherProvider implements WeatherProviderInterface
{
    private $provider, $cache;

    public function __construct(WeatherProviderInterface $provider, CacheItemPoolInterface $cache)
    {
        $this->provider = $provider;
        $this->cache = $cache;
    }

    public function fetch(Location $location): Weather
    {
        if( $this->getCache() === null)
        {
            $weather = $this->provider->fetch($location);
            $this->setCache($weather->getTemperature());

            return $weather;
        } else {
            return new Weather($this->getCache($location));
        }
    }

    public function getCache()
    {
        $weather = $this->cache->getItem('temperature');
        return $weather->get();
    }

    public function setCache($temperature)
    {
        $weather = $this->cache
            ->getItem('temperature')
            ->set($temperature)
            ->expiresAfter(60)
        ;

        $this->cache->save($weather);
    }

}