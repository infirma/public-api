<?php
declare(strict_types=1);

namespace Tests;

use InFirmaApi\Autoryzacja;

class AutoryzacjaTest extends TestCase
{
    public function testGetApiKey()
    {
        $key = $this->getInFirmaKey();
        $autoryzacja = new Autoryzacja($key, 'system');
        $this->assertEquals($key, $autoryzacja->getApiKey());
    }

    public function testGetWersja()
    {
        $key = $this->getInFirmaKey();
        $autoryzacja = new Autoryzacja($key, 'system', 10, '3.2.0');
        $this->assertEquals('3.2.0', $autoryzacja->getWersja());
    }
}
