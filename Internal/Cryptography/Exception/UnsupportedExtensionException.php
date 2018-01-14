<?php namespace ZN\Cryptography\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class UnsupportedExtensionException extends \Exception
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
