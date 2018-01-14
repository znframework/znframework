<?php namespace ZN\Remote\Exception;
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

class FileNotFoundException extends Exception
{
    const lang = 
    [
        'en' => 'Error: `%` file was not found!',
        'tr' => 'Hata: `%` dosyasi bulunamadi!'
    ];
}
