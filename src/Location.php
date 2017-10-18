<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 12/10/2017
 * Time: 18:09
 */

declare(strict_types=1);
namespace Nfq\Weather;


class Location
{
    private $lon, $lat;

    public function __construct(float $lon, float $lat)
    {
        $this->lon = $lon;
        $this->lat = $lat;
    }
    public function getLon() : float {
        return $this->lon;
    }

    public function getLat() : float {
        return $this->lat;
    }
}