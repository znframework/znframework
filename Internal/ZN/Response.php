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

class Response
{   
    /**
     * Prefix 
     * 
     * @var string
     */
    protected static $fix = 'redirect:';

    /**
     * Redirect Invalid Request
     */
    public static function redirectInvalidRequest()
    {
        $invalidRequest = Config::get('Services', 'route')['requestMethods'];

        if( empty($invalidRequest['page']) )
        {
            Helper::report('Error', Lang::select('Error', 'invalidRequest'), 'InvalidRequestError');
            Base::trace(Lang::select('Error', 'invalidRequest'));
        }
        else
        {
            self::redirect($invalidRequest['page']);
        }
    }

    /**
     * Location
     *
     * @param string $url  = NULL
     * @param int    $time = 0
     * @param array  $data = NULL
     * @param bool   $exit = true
     */
    public static function redirect(String $url = NULL, Int $time = 0, Array $data = NULL, Bool $exit = true, $type = 'location')
    {
        if( ! IS::url((string) $url) )
        {
            $url = Request::getSiteURL($url);
        }

        if( ! empty($data) )
        {
            foreach( $data as $k => $v )
            {
                $_SESSION[self::$fix . $k] = $v;
            }
        }
        
        if( $type === 'location' )
        {
            if( $time > 0 )
            {
                sleep($time);
            }
    
            header('Location: ' . $url, true);   
        }
        else
        {
            header('Refresh:'.$time.'; url='.$url);
        }

        if( $exit === true )
        {
            exit;
        }
    }
}