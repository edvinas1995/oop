<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 12/10/2017
 * Time: 18:13
 */
declare(strict_types=1);
namespace Nfq\Weather;

class Weather
{
    private $temperature;

    public function __construct(float $temperature)
    {
        $this->temperature = $temperature;
    }

    public function getTemperature(): float {
        return $this->temperature;
    }
}