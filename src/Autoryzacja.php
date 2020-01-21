<?php
declare(strict_types=1);


namespace InFirmaApi;


use Firebase\JWT\JWT;

class Autoryzacja
{
    /** @var string */
    private $apiKey;
    /**
     * @var string
     */
    private $wersja;
    /**
     * @var string
     */
    private $subdomena;
    /**
     * @var float|int
     */
    private $czasWaznosci;

    /**
     * Autoryzacja constructor.
     *
     * @param string    $apiKey
     * @param string    $subdomena
     * @param float|int $czasWaznosci czas ważności tokena w sekundach
     * @param string    $wersja
     */
    public function __construct($apiKey, $subdomena, $czasWaznosci = 60 * 5, $wersja = '3.2.0')
    {
        $this->apiKey = $apiKey;
        $this->wersja = $wersja;
        $this->subdomena = $subdomena;
        $this->czasWaznosci = $czasWaznosci;
    }

    public function getAuthorizationToken($uzytkownikId = 0, $czasWaznosci = 0)
    {
        if ($czasWaznosci === 0) {
            $czasWaznosci = $this->czasWaznosci;
        }
        $payload = [
            'iss' => $this->subdomena,
            'exp' => time() + $czasWaznosci,
//            'admin' => 1,
        ];
        if ($uzytkownikId) {
            $payload['uzytkownik_id'] = $uzytkownikId;
        }

        return JWT::encode($payload, $this->getApiKey());
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return string
     */
    public function getWersja(): string
    {
        return $this->wersja;
    }
}
