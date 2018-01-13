<?php namespace ZN\Storage\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\ErrorHandling\GeneralException;

class AuthenticationFailedException extends GeneralException
{
    const lang = 
    [
        'en' => 'Authentication failed!',
        'tr' => 'Geçersiz giriş!'
    ];
}
