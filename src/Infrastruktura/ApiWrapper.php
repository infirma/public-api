<?php
declare(strict_types=1);


namespace InFirmaApi\Infrastruktura;


use InFirmaApi\Autoryzacja;
use InFirmaApi\Exceptions\InFirmaApiException;

class ApiWrapper
{
    /**
     * @var Autoryzacja
     */
    protected $autoryzacja;

    /**
     * @var ApiSenderInterface
     */
    protected $apiSender;

    protected $apiKatalog = '';

    public function __construct(Autoryzacja $autoryzacja, ApiSenderInterface $apiSender = null)
    {
        $this->autoryzacja = $autoryzacja;
        if ($apiSender === null) {
            $factory = new DefaultApiSenderFactory($this->autoryzacja);
            $apiSender = $factory->createSender();
        }
        $this->apiSender = $apiSender;
    }

    /**
     * @param $metoda
     * @param $url
     * @param $parametry
     *
     * @return mixed
     * @throws InFirmaApiException
     */
    public function wyslij($metoda, $url, $parametry)
    {
        return $this->apiSender->wyslij($metoda, $url, $parametry);
    }

    /**
     * @return ApiSenderInterface
     */
    public function getApiSender(): ApiSenderInterface
    {
        return $this->apiSender;
    }


    /**
     * @return string
     */
    public function getApiKatalog(): string
    {
        return $this->apiKatalog;
    }
}
