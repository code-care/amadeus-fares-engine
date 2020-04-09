<?php


namespace App\Provider;


use Amadeus\Service\AmadeusService\Amadeus;
use Psr\Container\ContainerInterface;

class ServiceProvider
{
    public static function register(ContainerInterface $container)
    {
        $container->set(Amadeus::class, new Amadeus(
            $container->get('config')['service']['amadeus']['key'],
            $container->get('config')['service']['amadeus']['secret']
        ));

    }
}
