API dla systemu CRM inFirma.pl - skrytpy pomocowe dla PHP
=========================================================

Instalacja
----------

```
composer require infirma/public-api
```

Użycie
------

```php

use InFirmaApi\Autoryzacja;
use InFirmaApi\Klienci;

$inFirmaKlucz = 'klucz';
$inFirmaSubdomena = 'subdomena';

$autoryzacja = new Autoryzacja($inFirmaKlucz, $inFirmaSubdomena);

$klienci = new Klienci($autoryzacja);

$warunki = [
    'nazwa_skrocona'=>['value'=>'Lukana', 'operator'=>'equals']
];
$wyniki = $klienci->pobierzListe($warunki);



```
