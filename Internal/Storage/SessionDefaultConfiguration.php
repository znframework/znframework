<?php namespace ZN\Storage;
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
class SessionDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | Session
    |--------------------------------------------------------------------------
    |
    | Contains settings related to session. 
    | 
    | encode: The cookie keys are set to which algorithm to encrypt.
    |
    */

    public $encode     = 'md5';
    public $regenerate = true;
}
