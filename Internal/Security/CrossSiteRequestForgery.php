<?php namespace ZN\Security;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Security;

class CrossSiteRequestForgery
{
    /**
     * Cross Site Request Forgery
     * 
     * @param string $uri  = NULL
     * @param string $type = 'post'
     * 
     * @return void
     */
    public static function token(String $uri = NULL, String $type = 'post')
    {
        Security::CSRFToken($uri, $type);
    }

    /**
     * Get
     * 
     * @param string $uri = NULL
     * 
     * @return void
     */
    public static function get(String $uri = NULL)
    {
        self::token($uri, 'get');
    }
}
