<?php
declare(strict_types=1);


namespace InFirmaApi\WspolneAkcje;


use InFirmaApi\Exceptions\InFirmaApiException;

trait PobierzListe
{
    /**
     * @param int  $strona
     * @param null $warunki
     * @param null $pola
     * @param null $sortowanie
     * @param int  $naStronie
     *
     * @return mixed
     * @throws InFirmaApiException
     */
    public function pobierzListe($warunki = null, $strona = 1, $pola = null, $sortowanie = null, $naStronie = 10)
    {
        $parametry = [
            'warunki'    => $warunki,
            'strona'     => $strona,
            'na_stronie' => $naStronie,
            'pola'       => $pola,
            'sortowanie' => $sortowanie,
        ];

        return parent::wyslij('GET', parent::getApiKatalog(), $parametry);
    }
}
