<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Security
{   
    /**
     * Get CSRF Token Key
     * 
     * @return string 
     */
    public static function getCSRFTokenKey()
    {
        return $_SESSION['token'];
    }

    /**
     * Creates CSRF Token Key
     */
    public static function createCSRFTokenKey()
    {
       $_SESSION['token'] = random_bytes(32);
    }

    /**
     * Cross Site Request Forgery
     * 
     * @param string $uri  = NULL
     * @param string $type = 'post'
     * 
     * @return void
     */
    public static function CSRFToken(String $uri = NULL, String $type = 'post')
    {
        switch( $type )
        {
            case 'post': $method = $_POST; break;
            case 'get' : $method = $_GET;  break;
        }

        if( $method ?? NULL )
        {
            $token = $method['token'];

            if( $token === false || $token !== $_SESSION['token'] )
            {
                Response::redirect($uri);
            }
        }
    }
}