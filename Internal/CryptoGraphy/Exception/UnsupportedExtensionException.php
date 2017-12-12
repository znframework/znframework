<?php namespace ZN\CryptoGraphy\Exception;

class UnsupportedExtensionException extends \GeneralException
{
    const lang =
    [
        'en'        => '% extensions is unsupported since #!',
        'tr'        => '# \'den beri % uzantıları desteklenmiyor!',
        'placement' => 
        [
            '#' => '[PHP 7.2]', 
            '%' => 'mcrypt_ *'
        ]
    ];
}
