<?php

namespace App\Provider;
use Amadeus\Base\BaseController;
use App\Controllers\IndexController;
use App\Controllers\SearchController;
use Slim\App;

class ControllerProvider
{

    public static function register(App $app)
    {
        $app->get('/search', SearchController::class . BaseController::METHOD);
    }
}
