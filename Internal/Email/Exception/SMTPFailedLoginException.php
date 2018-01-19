<?php namespace ZN\Email\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Exception;

class SMTPFailedLoginException extends Exception
{
    const lang = 
    [
        'en' => 'Failed to send AUTH LOGIN command! %',
        'tr' => 'AUTH LOGIN komutunu gönderilemedi! %'
    ];
}
