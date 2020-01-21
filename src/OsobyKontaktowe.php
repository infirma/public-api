<?php
declare(strict_types=1);


namespace InFirmaApi;


use InFirmaApi\Infrastruktura\ApiWrapper;
use InFirmaApi\WspolneAkcje\Dodaj;
use InFirmaApi\WspolneAkcje\PobierzLiczbeWynikow;
use InFirmaApi\WspolneAkcje\PobierzListe;
use InFirmaApi\WspolneAkcje\PobierzSzczegoly;
use InFirmaApi\WspolneAkcje\Zaktualizuj;

class OsobyKontaktowe extends ApiWrapper
{
    protected $apiKatalog = 'osoby-kontaktowe';

    use PobierzLiczbeWynikow,
        PobierzListe,
        PobierzSzczegoly,
        Dodaj,
        Zaktualizuj;
}
