<?php
declare(strict_types=1);


namespace InFirmaApi\Infrastruktura;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InFirmaApi\Autoryzacja;
use InFirmaApi\Exceptions\InFirmaApiException;

class GuzzleApiSender implements ApiSenderInterface
{
    protected $infirmaDomena = 'https://api.infirma.pl';
    /**
     * @var Autoryzacja
     */
    protected $autoryzacja;

    public function __construct(Autoryzacja $autoryzacja)
    {
        $this->autoryzacja = $autoryzacja;
    }

    /**
     * @param $metoda
     * @param $url
     * @param $parametry
     *
     * @return array|string
     * @throws InFirmaApiException
     */
    public function wyslij($metoda, $url, $parametry)
    {
        $httpHeader = [
            'Authorization' => 'Bearer ' . $this->autoryzacja->getAuthorizationToken(),
        ];
        $url = $this->przygotujAdresUrl($url);
        $request = new Request($metoda, $url, $httpHeader);

        switch ($metoda) {
            case 'POST':
                $opcje = $this->przygotujOpcjePost($parametry);
                break;
            default:
                $opcje = $this->przygotujOpcjeGet($parametry);
                break;
        }

        $klient = $this->przygotujKlienta();

        try {
            $resp = $klient->send($request, $opcje);
            $body = $resp->getBody()->getContents();

            return $this->isJson($body) ? json_decode($body, true) : $body;
        } catch (RequestException $e) {
            $reason = '';
            if ($e->hasResponse()) {
                $resp = $e->getResponse();
                $reason = $resp->getReasonPhrase();
                $body = $resp->getBody()->getContents();
                $errorArray = json_decode($body, true);
                if ($errorArray && $errorArray['error']) {
                    $error = $errorArray['error'] . ' in file ' . $errorArray['file'] . ' on ' . $errorArray['line'];
                } else {
                    $error = $body;
                }
            }

            throw new InFirmaApiException('inFirma Api błąd: ' . $error . '. Zapytanie wysłane: `' . $metoda . ' ' . $url . '` `' . $e->getCode() . ' ' . $reason . '`');
        }

//        return [
//            'status' => ['code' => $resp->getStatusCode(), 'reason' => $resp->getReasonPhrase()],
//            'data'   => json_decode($body, true),
//        ];
    }

    protected function przygotujAdresUrl(string $url): string
    {
        return $this->infirmaDomena . '/' . $this->autoryzacja->getWersja() . '/api/' . $url;
    }

    protected function przygotujOpcjePost($parametry)
    {
        $options = [
//            'verify' => false,
        ];
        $options[RequestOptions::JSON] = $parametry;

        return $options;
    }

    protected function przygotujOpcjeGet($parametry)
    {
        $options = [
//            'verify' => false,
        ];
        $options[RequestOptions::QUERY] = $parametry;

        return $options;
    }

    protected function przygotujKlienta(): Client
    {
        $klient = new Client();

        return $klient;
    }

    protected function isJson($string)
    {
        json_decode($string);

        return (json_last_error() == JSON_ERROR_NONE);
    }


}
