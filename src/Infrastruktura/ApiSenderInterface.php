<?php
declare(strict_types=1);


namespace InFirmaApi\Infrastruktura;


use InFirmaApi\Autoryzacja;
use InFirmaApi\Exceptions\InFirmaApiException;

interface ApiSenderInterface
{
    /**
     * ApiSenderInterface constructor.
     *
     * @param Autoryzacja $autoryzacja
     */
    public function __construct(Autoryzacja $autoryzacja);

    /**
     * @param $metoda
     * @param $url
     * @param $parametry
     *
     * @return mixed
     * @throws InFirmaApiException
     */
    public function wyslij($metoda, $url, $parametry);
}
