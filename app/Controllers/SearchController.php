<?php

namespace App\Controllers;

use Amadeus\Base\BaseController;
use Amadeus\Input\SearchInput;
use Amadeus\Service\AmadeusService\Amadeus;
use Psr\Container\ContainerInterface;

class SearchController extends BaseController
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
        $searchInput = SearchInput::create($this->request);

        $result = $this->amadeus->fetchFares($searchInput);
        $arr = [
            'status' => 'ok',
            'data' => $result
        ];
        return $this->jsonResponse($arr);
    }
}
