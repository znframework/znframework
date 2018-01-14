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

class UnsupportedDriverException extends Exception
{
    /**
     * Exception language settings
     * 
     * @param string en
     * @param string tr
     */
    const lang = 
    [
        'en' => '`%` must be loaded to use the driver!!',
        'tr' => '`%` sürücüsünü kullanmak için yüklenmesi gerekmektedir!'
    ];
}
