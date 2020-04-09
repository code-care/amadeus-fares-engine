<?php

namespace Amadeus\Input;

use Psr\Http\Message\ServerRequestInterface as Request;
use DateTime;

class SearchInput
{
    /**
     * @var string
     */
    private $origin;
    /**
     * @var string
     */
    private $destination;
    /**
     * @var DateTime
     */
    private $departureDate;
    /**
     * @var DateTime|null
     */
    private $returnDate;
    /**
     * @var int
     */
    private $adults;
    /**
     * @var int
     */
    private $children;
    /**
     * @var int
     */
    private $limit;
    /**
     * @var array
     */
    private $airlines;

    /**
     * SearchInput constructor.
     * @param string $origin
     * @param string $destination
     * @param DateTime $departureDate
     * @param DateTime|null $returnDate
     * @param int $adults
     * @param int $children
     * @param int $limit
     * @param array $airlines
     */
    public function __construct(
        string $origin,
        string $destination,
        DateTime $departureDate,
        ?DateTime $returnDate,
        int $adults,
        int $children,
        int $limit, // Limit of resuts
        ?array $airlines
    )
    {

        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
        $this->returnDate = $returnDate;
        $this->adults = $adults;
        $this->children = $children;
        $this->limit = $limit;
        $this->airlines = $airlines;
    }

    /**
     * @param Request $request
     * @return SearchInput
     * @throws \Exception
     */
    public static function create(Request $request)
    {
        $returnDate = is_null($request->getAttribute('returnDate', null)) ? null : new DateTime($request->getAttribute('returnDate'));
        return new SearchInput(
            $request->getAttribute('origin'),
            $request->getAttribute('destination'),
            new DateTime($request->getAttribute('departureDate')),
            $returnDate,
            $request->getAttribute('adults'),
            $request->getAttribute('children'),
            $request->getAttribute('limit'),
            $request->getAttribute('airlines', null)
        );
    }

}
