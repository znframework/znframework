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

use ZN\ErrorHandling\GeneralException;

class FolderChangeNameException extends GeneralException
{
    const lang = 
    [
        'en' => 'The name of the `%` file can not be changed!',
        'tr' => '`%` dosyasının adı değiştirilemiyor!'
    ];
}
