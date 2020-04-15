<?php
declare(strict_types=1);

namespace Amadeus\Service\AmadeusService;

use Amadeus\Input\SearchInput;

class Amadeus
{

    const FLIGHT_OFFERS = '/v2/shopping/flight-offers';
    /**
     * @var string
     */
    private $host;
    /**
     * @var AmadeusOAuth
     */
    private $amadeusOAuth;

    /**
     * Amadeus constructor.
     * @param AmadeusOAuth $amadeusOAuth
     * @param string $host
     */
    public function __construct(
        AmadeusOAuth $amadeusOAuth,
        string $host
    )
    {
        $this->host = $host;
        $this->amadeusOAuth = $amadeusOAuth;
    }

    public function fetchFares(SearchInput $input)
    {
        $queryUrl = $this->getQuery($input);
        return $this->query($queryUrl);
    }

    private function query(string $url)
    {

        $token = $this->amadeusOAuth->getToken();
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                'Authorization: '. $token
            ]
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        print_r($result);die;
        return json_decode($result, true);
    }

    private function getQuery(SearchInput $input): string
    {
        $params = [
            'originLocationCode' => $input->getOrigin(),
            'destinationLocationCode' => $input->getDestination(),
            'departureDate' => $input->getDepartureDate()->format('Y-m-d'),
            'adults' => $input->getAdults(),
            'max' => $input->getLimit()
        ];

        if($input->getChildren() > 0) {
            $params['children'] = $input->getChildren();
        }

        if(!empty($input->getAirlines())) {
            $params['includeAirlineCodes'] = $input->getAirlines();
        }

        if($input->getReturnDate() !== null) {
            $params['returnDate'] = $input->getReturnDate()->format('Y-m-d');
        }

        return $this->host . self::FLIGHT_OFFERS .'?'. http_build_query($params);
    }
}
