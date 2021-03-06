<?php

namespace App\Controllers;

use Amadeus\Base\BaseController;
use Amadeus\Service\AmadeusService\Amadeus;
use Psr\Container\ContainerInterface;

class IndexController extends BaseController
{
    /**
     * @var Amadeus
     */
    private $amadeus;

    /**
     * IndexController constructor.
     * @param ContainerInterface|null $container
     * @param Amadeus $amadeus
     */
    public function __construct(
        ?ContainerInterface $container
    ) {
        parent::__construct($container);
        $this->amadeus = $this->container->get(Amadeus::class);
    }

    public function run()
    {
        $result = $this->amadeus->fetchFares();
        $arr = [
            'status' => 'ok',
            'data' => $result
        ];
        return $this->jsonResponse($arr);
    }
}
