# iagentesms-laravel

## Instalação via composer

```bash
$ composer require gabrieljperez/iagentesms-laravel
```

- Insira em config/services.php

```php
    'iagentesms' => [
        'user' => env('IAGENTE_USER', ''),
        'pass' => env('IAGENTE_PASS', ''),
    ],
```

- Insira em .env
```php
    IAGENTE_USER=""
    IAGENTE_PASS=""
```
