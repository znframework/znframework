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

class Request
{   
    /**
     * Request CURL
     * 
     * @return bool
     */
    public static function isCurl() : Bool
    {
        return ! empty($_SERVER['HTTP_COOKIE'])
               ? false
               : true;
    }

    /**
     * Request method type
     * 
     * @param string ...$methods
     * 
     * @returm bool
     */
    public static function isMethod(...$methods) : Bool
    {
        if( ! in_array(strtolower($_SERVER['REQUEST_METHOD'] ?? false), $methods) )
        {
            return false;
        }

        return true;
    }

    /**
     * Request is ajax
     * 
     * @param bool
     */
    public static function isAjax() : Bool
    {
        if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * IP v4
     * 
     * @param void
     * 
     * @return string
     */
    public static function ipv4() : String
    {
        $localIP = '127.0.0.1';

        if( isset($_SERVER['HTTP_CLIENT_IP']) )
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif( isset($_SERVER['HTTP_X_FORWARDED_FOR']) )
        {
            $ip = Datatype::divide($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'] ?? $localIP;
        }

        if( $ip === '::1')
        {
            $ip = $localIP;
        }

        return $ip;
    }

    /**
     * Get active URL
     * 
     * @param bool $fullPath = false
     * 
     * @return string
     */
    public static function getActiveURL(Bool $fullPath = false) : String
    {
        # 5.3.22[edited]
        $requestUri = Base::suffix($_SERVER['REQUEST_URI'] ?? false);
       
        $currentUri = ! empty(BASE_DIR)
                      ? str_replace(Base::prefix(BASE_DIR, '/'), '', $requestUri)
                      : substr($requestUri, 1);
        
        if( $fullPath === false )
        {
            $currentUri = In::cleanURIPrefix($currentUri, In::getCurrentProject());

            if( $currentLang = Lang::current() )
            {
                $isLang = Datatype::divide($currentUri, '/');

                if( strlen($isLang) === 2 )
                {
                    $currentLang = $isLang;
                }

                $currentUri  = In::cleanURIPrefix($currentUri, $currentLang);
            }
        }

        return ! empty($currentUri) ? $currentUri : (Config::get('Services', 'route')['openController'] ?? 'home');
    }

    /**
     * Get site URL
     * 
     * @param string $uri = NULL
     * 
     * @return string
     */
    public static function getSiteURL(String $uri = NULL) : String
    {
        return self::getHostName
        (
               BASE_DIR.
               In::getCurrentProject().
               Base::suffix(Lang::current()).
               $uri
         );
    }

    /**
     * Get base URL
     * 
     * @param string $uri = NULL
     * 
     * @return string
     */
    public static function getBaseURL(String $uri = NULL) : String
    {
        return self::getHostName(BASE_DIR . $uri);
    }


    /**
     * Get host name
     * 
     * @param string $uri = NULL
     * 
     * @return string
     */
    public static function getHostName(String $uri = NULL) : String
    {
        return SSL_STATUS . Base::host() . '/' . In::cleanInjection(ltrim($uri, '/'));
    }
}