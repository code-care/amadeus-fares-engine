<?php

namespace App\Provider;
use Amadeus\Base\BaseController;
use App\Controllers\IndexController;
use Psr\Container\ContainerInterface;
use Slim\App;

class ControllerProvider
{

    public function __construct(App $app)
    {
        $app->get('/', IndexController::class . BaseController::METHOD);
    }
}
