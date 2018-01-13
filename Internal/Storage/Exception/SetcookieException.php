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

class SetcookieException extends GeneralException
{
    /**
     * Exception language settings
     * 
     * @param string en
     * @param string tr
     */
    const lang = 
    [
        'en' => 'Could not set the cookie!',
        'tr' => 'Çerez tanımlanamadı!'
    ];
}
