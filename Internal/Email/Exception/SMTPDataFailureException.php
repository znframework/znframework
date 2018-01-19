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

class SMTPDataFailureException extends Exception
{
    const lang = 
    [
        'en' => 'Unable to send data: %',
        'tr' => 'SMPT Veri göndermek için açılamıyor: %'
    ];
}
