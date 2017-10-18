<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 12/10/2017
 * Time: 18:40
 */

namespace Nfq\Weather;


class DelegatingWeatherProvider implements WeatherProviderInterface
{
    public function  __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function fetch(Location $location) : Weather
    {
        foreach ($this->providers as $provider) {
            try {
                return $provider->fetch($location);
            } catch (WeatherProviderException $e){

            }
        }

            throw new WeatherProviderException('None of given providers');
    }

}