<?php
declare(strict_types=1);

namespace Tests;

use InFirmaApi\Exceptions\InFirmaApiException;
use InFirmaApi\Kontakty;

class KontaktyTest extends TestCase
{
    public function testPobierzListe()
    {
        $wyniki = $this->getKontakty()->pobierzListe(1, null, ['firma_id'], null, 3);
        $this->assertCount(3, $wyniki);
    }

    private function getKontakty()
    {
        $kontakty = new Kontakty($this->getAutoryzacja());

        return $kontakty;
    }

    public function testPobierzLiczbeWynikow()
    {
        $liczbaWynikow = $this->getKontakty()->pobierzLiczbeWynikow();
        $this->assertGreaterThan(1, $liczbaWynikow);
    }

    public function testDodajBledne()
    {
        $this->expectException(InFirmaApiException::class);
        $this->expectDeprecationMessageMatches('/Podaj nazwę kontaktu/');
        $this->getKontakty()->dodaj(['asdsadsad' => 'asdsadsa']);
    }
}
