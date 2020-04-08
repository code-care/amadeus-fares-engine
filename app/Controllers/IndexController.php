<?php

namespace App\Controllers;

use Amadeus\Base\BaseController;

class IndexController extends BaseController
{

    public function run()
    {
        $arr = [
            'status' => 'ok',
            'data' => 'kutas'
        ];
        return $this->jsonResponse($arr);
    }
}
