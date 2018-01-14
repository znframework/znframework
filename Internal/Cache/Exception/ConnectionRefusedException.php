<?php namespace ZN\Cache\Exception;
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

class ConnectionRefusedException extends Exception
{
    const lang = 
    [
        'en' => 'Connection refused! Error:`%`',
        'tr' => 'Bağlantı sağlanamadı! Hata:`%`'
    ];
}
