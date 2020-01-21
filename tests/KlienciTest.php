<?php
declare(strict_types=1);

namespace Tests;

use InFirmaApi\Exceptions\InFirmaApiException;
use InFirmaApi\Klienci;

class KlienciTest extends TestCase
{
    public function testPobierzListe()
    {
        $wyniki = $this->getKlienci()->pobierzListe(1, null, ['firma_id'], null, 3);
        $this->assertCount(3, $wyniki);
    }

    private function getKlienci()
    {
        $klienci = new Klienci($this->getAutoryzacja());

        return $klienci;
    }

    public function testPobierzLiczbeWynikow()
    {
        $liczbaWynikow = $this->getKlienci()->pobierzLiczbeWynikow();
        $this->assertGreaterThan(1, $liczbaWynikow);
    }

    public function testPobierzSzczegoly()
    {
        $dane = $this->getKlienci()->pobierzSzczegoly(1);
        $this->assertArrayHasKey('nazwa_skrocona', $dane);
    }

    public function testDodajBledne()
    {
        $this->expectException(InFirmaApiException::class);
        $this->expectDeprecationMessageMatches('/Wprowadź nazwę skróconą klienta/');
        $this->getKlienci()->dodaj(['asdsadsad' => 'asdsadsa']);
    }

    public function testZaktualizuj()
    {
        $zakres = 'asdsadsa';
        $wyniki = $this->getKlienci()->zaktualizuj(1, ['zakres_dzialalnosci' => $zakres]);
        $this->assertEquals($zakres, $wyniki['zakres_dzialalnosci']);
    }
}
