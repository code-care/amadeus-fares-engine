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
     * @var array|null
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
        $params = $request->getQueryParams();
        $returnDate = !isset($params['returnDate']) ? null : new DateTime($params['returnDate']);
        return new SearchInput(
            $params['origin'],
            $params['destination'],
            new DateTime($params['departureDate']),
            $returnDate,
            (int)$params['adults'],
            (int)$params['children'],
            (int)$params['limit'],
            !isset($params['airlines']) ? null : $params['airlines']
        );
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @return DateTime
     */
    public function getDepartureDate(): DateTime
    {
        return $this->departureDate;
    }

    /**
     * @return DateTime|null
     */
    public function getReturnDate(): ?DateTime
    {
        return $this->returnDate;
    }

    /**
     * @return int
     */
    public function getAdults(): int
    {
        return $this->adults;
    }

    /**
     * @return int
     */
    public function getChildren(): int
    {
        return $this->children;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return array
     */
    public function getAirlines(): ?array
    {
        return $this->airlines;
    }

}
