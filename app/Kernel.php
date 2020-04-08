<?php

namespace App;

use App\Provider\ControllerProvider;
use Slim\Factory\AppFactory;

class Kernel
{

    private $app;

    public function __construct()
    {
        $this->app = AppFactory::create();

        $app[ControllerProvider::class] = new ControllerProvider($this->app);
    }

    public function run()
    {
        $this->app->run();
    }
}
