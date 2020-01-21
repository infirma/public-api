<?php
declare(strict_types=1);


namespace InFirmaApi\WspolneAkcje;


use InFirmaApi\Exceptions\InFirmaApiException;

trait Dodaj
{
    /**
     * @param $dane
     *
     * @return mixed
     * @throws InFirmaApiException
     */
    public function dodaj($dane)
    {
        return parent::wyslij('POST', parent::getApiKatalog(), $dane);
    }
}
