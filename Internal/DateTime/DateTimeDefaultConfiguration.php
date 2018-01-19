<?php namespace ZN\DateTime;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

/**
 * Default Cookie Configuration
 * 
 * Enabled when the configuration file can not be accessed.
 */
class DateTimeDefaultConfiguration
{
   /*
    |--------------------------------------------------------------------------
    | Set Locale
    |--------------------------------------------------------------------------
    |
    | Local settings for time zone.
    |
    | charset : Sets the date and time character set.
    | language: Sets the date and time language.
    |
    */

    protected $locale =
    [
        'charset'  => 'tr_TR.UTF-8',
        'language' => 'turkish',
    ];
}
