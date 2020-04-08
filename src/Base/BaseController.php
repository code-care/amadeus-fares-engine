<?php


namespace Amadeus\Base;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

abstract class BaseController
{

    const METHOD = ':handle';
    /**
     * @var ContainerInterface | null
     */
    protected $container;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Response
     */
    protected $response;
    /**
     * @var array
     */
    protected $args;

    public function __construct(?ContainerInterface $container) {
        $this->container = $container;
    }

    public final function handle(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        return $this->run();
    }

    protected function jsonResponse(array $data, int $statusCode = 200) {
        $this->response
            ->getBody()
            ->write(json_encode($data));

        return $this->response->withHeader('Content-Type', 'application/json')->withStatus($statusCode);
    }

    public abstract function run();
}
