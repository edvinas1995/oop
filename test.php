<?php
/**
 * Created by PhpStorm.
 * User: edvinassaltenis
 * Date: 12/10/2017
 * Time: 18:06
 */


require_once __DIR__.'/vendor/autoload.php';

use Nfq\Weather\Location;
use Nfq\Weather\BitWeatherProvider;
use Nfq\Weather\WeatherProviderInterface;
use Nfq\Weather\DelegatingWeatherProvider;
use Nfq\Weather\DarkSkyWeatherProvider;
use Nfq\Weather\CachedWeatherProvider;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$bitProvider = new BitWeatherProvider("efe8e652079a4fb2ab83bfc44a53f202");
$darkSkyProvider = new DarkSkyWeatherProvider('6796cffa473bc53793dfd45df496833c');
$delegatingProvider = new DelegatingWeatherProvider([$darkSkyProvider, $bitProvider]);


$cacheAdapter = new FilesystemAdapter();

$bitCacheProvider = new CachedWeatherProvider($bitProvider, $cacheAdapter);
$darkSkyCacheProvider = new CachedWeatherProvider($darkSkyProvider, $cacheAdapter);
$delegatingCacheProvider = new CachedWeatherProvider($delegatingProvider, $cacheAdapter);

run($darkSkyCacheProvider);

function run(WeatherProviderInterface $provider){
    $vilnius = new Location( 54.697077,25.270532);
    $barcelona = new Location(41.390896, 2.162143);

    var_dump($provider->fetch($barcelona));
}