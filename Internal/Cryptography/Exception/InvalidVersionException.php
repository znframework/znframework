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

class InvalidVersionException extends \Exception
{
    const lang = 
    [
        'en' => 'In order to use [password_*] methods need to be installed PHP version [5.5]!',
        'tr' => '[password_ *] yöntemlerini kullanmak için PHP sürümünün en az [5.5] olması gerekiyor!'
    ];
}
