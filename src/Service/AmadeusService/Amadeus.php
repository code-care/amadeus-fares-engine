<?php
declare(strict_types=1);

namespace Amadeus\Service\AmadeusService;

class Amadeus
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $secret;

    /**
     * Amadeus constructor.
     * @param string $key
     * @param string $secret
     */
    public function __construct(
        string $key,
        string $secret
    )
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    public function fetchFares()
    {
        return [
            'key' => $this->key,
            'secret' => $this->secret
        ];
    }
}
