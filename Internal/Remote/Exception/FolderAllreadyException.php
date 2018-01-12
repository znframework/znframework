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

class FolderAllreadyException extends GeneralException
{
    const lang = 
    [
        'en' => '`%` folder already exists!',
        'tr' => '`%` dizini zaten var!'
    ];
}
