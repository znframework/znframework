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
class CookieDefaultConfiguration
{
    /*
    |--------------------------------------------------------------------------
    | Cookie
    |--------------------------------------------------------------------------
    |
    | Contains settings related to cookies. 
    | Configures the parameters of the setcookie function.
    | 
    | encode: The cookie keys are set to which algorithm to encrypt.
    |
    */

    public $encode     = 'md5';
    public $regenerate = true;
    public $time       = 604800;
    public $path       = '/';
    public $domain     = '';
    public $secure     = false;
    public $httpOnly   = true;
}
