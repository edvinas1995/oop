<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 17/10/2017
 * Time: 21:37
 */

namespace Nfq\Weather;

use Darksky\Darksky;
use Nfq\Weather\WeatherProviderInterface;

class DarkSkyWeatherProvider implements WeatherProviderInterface
{
    private $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function fetch(Location $location): Weather
    {
        $temperature = null;
        try {
            $darksky = new Darksky($this->key, $location->getLon(), $location->getLat());
            $result = $darksky->forecast();
            $result = json_decode($result, true);
            $temperature = $result['currently']['temperature'];
        } catch(\Exception $e) {
            var_dump($e->getMessage());
        }
        return new Weather($temperature);
    }
}