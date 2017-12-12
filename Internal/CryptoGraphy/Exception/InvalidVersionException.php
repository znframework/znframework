<?php namespace ZN\CryptoGraphy\Exception;

class InvalidVersionException extends \GeneralException
{
    const lang = 
    [
        'en' => 'In order to use [password_*] methods need to be installed PHP version [5.5]!',
        'tr' => '[password_ *] yöntemlerini kullanmak için PHP sürümünün en az [5.5] olması gerekiyor!'
    ];
}
