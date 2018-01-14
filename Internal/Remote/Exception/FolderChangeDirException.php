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

class FolderChangeDirException extends Exception
{
    const lang = 
    [
        'en' => '`%` Can not change the working directory!',
        'tr' => '`%` çalışma dizini olarak değiştirilemiyor!'
    ];
}
