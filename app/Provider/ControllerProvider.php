<?php

namespace App\Provider;
use Amadeus\Base\BaseController;
use App\Controllers\IndexController;
use Slim\App;

class ControllerProvider
{

    public static function register(App $app)
    {
        $app->get('/', IndexController::class . BaseController::METHOD);
    }
}
