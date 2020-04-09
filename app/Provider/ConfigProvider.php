<?php


namespace App\Provider;


use Psr\Container\ContainerInterface;

class ConfigProvider
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ConfigProvider constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->container->set('env', function() {
            return getenv('ENV');
        });

        $this->container->set('config', function(ContainerInterface $c) {
            return json_decode($this->getConfig(), true);
        });
    }

    private function getConfig()
    {
        switch ($this->container->get('env')) {
            case 'test':
                return file_get_contents(__DIR__ . '/../../config/test.json');
            case 'prod':
                return file_get_contents(__DIR__ . '/../../config/prod.json');
            default:
                return file_get_contents(__DIR__ . '/../../config/dev.json');
        }
    }

}
