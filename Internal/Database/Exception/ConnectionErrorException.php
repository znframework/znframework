<?php namespace ZN\Database\Exception;
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

class ConnectionErrorException extends Exception
{
    const lang = 
    [
        'tr' => 'Veritabanı bağlantısı sağlanamadı! Lütfen bağlantı ayarlarınızı kontrol edin!',
        'en' => 'Database connection error! Please check your connection settings!'
    ];
}
