<?php


namespace Amadeus\Service\AmadeusService;


class AmadeusOAuth
{
    const ENDPOINT = '/v1/security/oauth2/token';
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $secret;
    /**
     * @var string
     */
    private $host;

    /**
     * AmadeusOAuth constructor.
     * @param string $key
     * @param string $secret
     * @param string $host
     */
    public function __construct(
        string $key,
        string $secret,
        string $host
    )
    {

        $this->key = $key;
        $this->secret = $secret;
        $this->host = $host;
    }

    public function getToken(): string
    {
        $ch = curl_init($this->host);
        curl_setopt_array(
            $ch,
            [
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL => $this->host . self::ENDPOINT,
                CURLOPT_POSTFIELDS => http_build_query([
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->key,
                    'client_secret' => $this->secret
                ])
            ]
        );

        $result = curl_exec($ch);

        $data = json_decode($result, true);
        curl_close($ch);

        return $data['token_type'].' '.$data['access_token'];
    }
}
