<?php


namespace App\Provider;


use Amadeus\Service\AmadeusService\Amadeus;
use Amadeus\Service\AmadeusService\AmadeusOAuth;
use Psr\Container\ContainerInterface;

class ServiceProvider
{
    public static function register(ContainerInterface $container)
    {
        $container->set(AmadeusOAuth::class, new AmadeusOAuth(
            $container->get('config')['service']['amadeus']['key'],
            $container->get('config')['service']['amadeus']['secret'],
            $container->get('config')['service']['amadeus']['domain']
        ));

        $container->set(Amadeus::class, new Amadeus(
            $container->get(AmadeusOAuth::class),
            $container->get('config')['service']['amadeus']['domain']
        ));

    }
}
