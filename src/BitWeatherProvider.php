<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 12/10/2017
 * Time: 18:15
 */
declare(strict_types=1);
namespace Nfq\Weather;


use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Nfq\Weather\WeatherProviderException;

class BitWeatherProvider implements WeatherProviderInterface
{
    private $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function fetch(Location $location) : Weather
    {
        $lon = $location->getLon();
        $lat = $location->getLat();
        $key = $this->key;

        try {
            $url = "https://api.weatherbit.io/v2.0/current?&lon=$lat&lat=$lon&key=$key";

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

            $json_output= curl_exec($ch);
            $weather = json_decode($json_output);

            return new Weather($weather->data[0]->temp);

        } catch(WeatherProviderException $e) {
             var_dump($e->getMessage());
        }

        throw new WeatherProviderException('Unfortunately, the application cannot process your request at this time.');

    }
}