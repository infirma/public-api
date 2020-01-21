<?php
declare(strict_types=1);


namespace InFirmaApi\WspolneAkcje;


use InFirmaApi\Exceptions\InFirmaApiException;

trait PobierzSzczegoly
{
    /**
     * @param      $id
     * @param null $pola
     *
     * @return mixed
     * @throws InFirmaApiException
     */
    public function pobierzSzczegoly($id, $pola = null)
    {
        if (!$id) {
            throw new InFirmaApiException('Podaj id obiektu');
        }
        $parametry = [
            'pola' => $pola,
        ];

        return parent::wyslij('GET', parent::getApiKatalog() . '/' . $id, $parametry);
    }
}
