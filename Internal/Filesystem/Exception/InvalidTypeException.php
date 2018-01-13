<?php namespace ZN\Filesystem\Exception;
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

class InvalidTypeException extends GeneralException
{
    const lang = 
    [
        'tr' => 'Geçersiz tür tanımlaması! Kullanılabilir seçenekler: %',
        'en' => 'Invalid type definition! Available options: %'
    ];
}
