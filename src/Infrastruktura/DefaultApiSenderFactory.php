<?php
declare(strict_types=1);


namespace InFirmaApi\Infrastruktura;


use InFirmaApi\Autoryzacja;

class DefaultApiSenderFactory
{
    /**
     * @var Autoryzacja
     */
    private $autoryzacja;

    public function __construct(Autoryzacja $autoryzacja)
    {
        $this->autoryzacja = $autoryzacja;
    }

    /**
     * @return ApiSenderInterface
     */
    public function createSender(): ApiSenderInterface
    {
        $sender = new GuzzleApiSender($this->autoryzacja);

        return $sender;
    }
}
