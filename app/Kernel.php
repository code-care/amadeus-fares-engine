<?php

namespace App;

use App\Provider\ConfigProvider;
use App\Provider\ControllerProvider;
use App\Provider\ServiceProvider;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use DI\Container;

class Kernel
{

    private $app;

    public function __construct()
    {
        $container = new Container();
        AppFactory::setContainer($container);

        $this->app = AppFactory::create();

        $appContainer = $this->app->getContainer();

        $appContainer->set(ConfigProvider::class, new ConfigProvider($appContainer));
        ServiceProvider::register($appContainer);

        ControllerProvider::register($this->app);
    }

    public function run()
    {
        $this->app->run();
    }
}
