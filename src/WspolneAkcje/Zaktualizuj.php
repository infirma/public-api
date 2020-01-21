<?php
declare(strict_types=1);


namespace InFirmaApi\WspolneAkcje;


use InFirmaApi\Exceptions\InFirmaApiException;

trait Zaktualizuj
{
    /**
     * @param $id
     * @param $dane
     *
     * @return mixed
     * @throws InFirmaApiException
     */
    public function zaktualizuj($id, $dane)
    {
        if (!$id) {
            throw new InFirmaApiException('Podaj id zmienianego obiektu');
        }

        return parent::wyslij('PATCH', parent::getApiKatalog() . '/' . $id, $dane);
    }
}
