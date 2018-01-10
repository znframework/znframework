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

class ConnectionRefusedException extends GeneralException
{
    const lang = 
    [
        'en' => 'Connection refused! Error:`%`',
        'tr' => 'Bağlantı sağlanamadı! Hata:`%`'
    ];
}
