<?php
declare(strict_types=1);


namespace InFirmaApi\WspolneAkcje;


use InFirmaApi\Exceptions\InFirmaApiException;

trait PobierzLiczbeWynikow
{
    /**
     * @param null $warunki
     *
     * @return mixed
     * @throws InFirmaApiException
     */
    public function pobierzLiczbeWynikow($warunki = null)
    {
        $parametry = [
            'warunki' => $warunki,
        ];

        return parent::wyslij('GET', parent::getApiKatalog() . '/wynikow', $parametry);
    }
}
