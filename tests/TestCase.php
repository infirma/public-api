<?php
declare(strict_types=1);

namespace Tests;

use InFirmaApi\Autoryzacja;

class TestCase extends \PHPUnit\Framework\TestCase
{

    public function testOk()
    {
        $this->assertEquals(true, true);
    }

    protected function getAutoryzacja()
    {
        return new Autoryzacja($this->getInFirmaKey(), $this->getSubdomena());
    }

    protected function getInFirmaKey()
    {
        return $this->getConfig()['apiKey'];
    }

    protected function getConfig($file = null)
    {
        if ($file === null) {
            $file = __DIR__ . '/infirma-key.json';
        }
        $string = trim(file_get_contents($file));

        return json_decode($string, true);
    }

    protected function getSubdomena()
    {
        return $this->getConfig()['subdomena'];
    }
}
