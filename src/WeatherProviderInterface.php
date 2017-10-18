<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 12/10/2017
 * Time: 18:33
 */

namespace Nfq\Weather;

interface WeatherProviderInterface {
    /**
     * @throws WeatherProviderException
     */
    public function fetch(Location $location) : Weather;
}