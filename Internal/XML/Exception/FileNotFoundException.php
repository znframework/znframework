<?php namespace ZN\XML\Exception;
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

class FileNotFoundException extends GeneralException
{
    const lang = 
    [
        'en' => 'Error: `%` file was not found!',
        'tr' => 'Hata: `%` dosyasi bulunamadi!'
    ];
}
