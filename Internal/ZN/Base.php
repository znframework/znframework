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

class Base
{
    /**
     * illustrate
     * 
     * Returns the constant value. If the constant is undefined, 
     * it defines the constant according to 
     * the specified value and returns the value.
     * 
     * @param string $const
     * @param mixed  $value = ''
     *
     * @return mixed
     */
    public static function illustrate(String $const, $value = '')
    {
        if( ! defined($const) )
        {
            define($const, $value);
        }
        else
        {
            if( $value !== '' )
            {
                return $value;
            }
        }

        return constant($const);
    }

    /**
     * layer
     * 
     * Loads the layer files.
     * 
     * @param string $layer
     * 
     * @return void
     * 
     */
    public static function layer(String $layer)
    {
        $path = $layer . '.php';

        if( is_file($require = (LAYERS_DIR . $path)) )
        {
            require $require;
        }

        if( is_file($require = (EXTERNAL_LAYERS_DIR . $path)) )
        {
            require $require;
        }
    }

    /**
     * import
     * 
     * Include files once. Performance is better than require_once function.
     * 
     * @param string $file
     * 
     * @return mixed
     */
    public static function import(String $file)
    {
        $constant = 'ImportFilePrefix' . $file;

        if( ! defined($constant) )
        {
            define($constant, true);

            if( is_file($file) )
            {
                return require $file;
            }

            return false;
        }
    }

    /**
     * host
     * 
     * Returns the system host information.
     * 
     * @param void
     * 
     * @return string
     */
    public static function host() : String
    {
        if( isset($_SERVER['HTTP_X_FORWARDED_HOST']) )
        {
            $host     = $_SERVER['HTTP_X_FORWARDED_HOST'];
            $elements = explode(',', $host);
            $host     = trim(end($elements));
        }
        else
        {
            $host = $_SERVER['HTTP_HOST']   ??
                    $_SERVER['SERVER_NAME'] ??
                    $_SERVER['SERVER_ADDR'] ??
                    '';
        }

        return trim($host);
    }

    /**
     * suffix 
     * 
     * It is used to append a suffix to any string.
     * 
     * @param string = NULL
     * @param string = $fix = '/'
     * 
     * @return string
     */
    public static function suffix(String $string = NULL, String $fix = '/') : String
    {
        return self::prefix($string, $fix, __FUNCTION__);
    }

    /**
     * prefix 
     * 
     * It is used to append a prefix to any string.
     * 
     * @param string = NULL
     * @param string = $fix = '/'
     * 
     * @return string
     */
    public static function prefix(String $string = NULL, String $fix = '/', $type = __FUNCTION__) : String
    {
        $stringFix = $type === 'prefix' ? $fix . $string : $string . $fix;

        if( strlen($fix) <= strlen($string) )
        {
            $prefix = $type === 'prefix' ? substr($string, 0, strlen($fix)) : substr($string, -strlen($fix));

            if( $prefix !== $fix )
            {
                $string = $stringFix;
            }
        }
        else
        {
            $string = $stringFix;
        }

        if( $string === $fix )
        {
            return false;
        }

        return $string;
    }

    /**
     * prefix 
     * 
     * Used to append both suffixes and prefixes to any string.
     * 
     * @param string = NULL
     * @param string = $fix = '/'
     * 
     * @return string
     */
    public static function presuffix(String $string = NULL, String $fix = '/') : String
    {
        return self::suffix(self::prefix(empty($string) ? $fix . $string . $fix : $string, $fix), $fix);
    }

    /**
     * headers
     * 
     * Send HTTP headers in singular or plural structure.
     * 
     * @param mixed $header
     * 
     * @return void
     */
    public static function headers($header)
    {
        if( ! is_array($header) )
        {
            header($header);
        }
        else
        {
            if( ! empty($header) ) foreach( $header as $k => $v )
            {
                header($v);
            }
        }
    }

    /**
     * server
     * 
     * The compiled version of the $_SERVER global variable.
     * 
     * @param string $type
     * 
     * @return mixed
     */
    public static function server(String $type = NULL)
    {
        $server =
        [
            NULL                         => $_SERVER,
            'name'                       => $_SERVER['SERVER_NAME']           ?? false,
            'admin'                      => $_SERVER['SERVER_ADMIN']          ?? false,
            'addr'                       => $_SERVER['SERVER_ADDR']           ?? false,
            'port'                       => $_SERVER['SERVER_PORT']           ?? false,
            'protocol'                   => $_SERVER['SERVER_PROTOCOL']       ?? false,
            'signature'                  => $_SERVER['SERVER_SIGNATURE']      ?? false,
            'software'                   => $_SERVER['SERVER_SOFTWARE']       ?? false,
            'remoteAddr'                 => $_SERVER['REMOTE_ADDR']           ?? false,
            'remotePort'                 => $_SERVER['REMOTE_PORT']           ?? false,
            'requestMethod'              => $_SERVER['REQUEST_METHOD']        ?? false,
            'requestUri'                 => $_SERVER['REQUEST_URI']           ?? false,
            'requestScheme'              => $_SERVER['REQUEST_SCHEME']        ?? false,
            'requestTime'                => $_SERVER['REQUEST_TIME']          ?? false,
            'requestTimeFloat'           => $_SERVER['REQUEST_TIME_FLOAT']    ?? false,
            'accept'                     => $_SERVER['HTTP_ACCEPT']           ?? false,
            'acceptCharset'              => $_SERVER['HTTP_ACCEPT_CHARSET']   ?? false,
            'acceptEncoding'             => $_SERVER['HTTP_ACCEPT_ENCODING']  ?? false,
            'acceptLanguage'             => $_SERVER['HTTP_ACCEPT_LANGUAGE']  ?? false,
            'clientIp'                   => $_SERVER['HTTP_CLIENT_IP']        ?? false,
            'xForwardedHost'             => $_SERVER['HTTP_X_FORWARDED_HOST'] ?? false,
            'xForwardedFor'              => $_SERVER['HTTP_X_FORWARDED_FOR']  ?? false,
            'xOriginalUrl'               => $_SERVER['HTTP_X_ORIGINAL_URL']   ?? false,
            'xRequestedWith'             => $_SERVER['HTTP_X_REQUESTED_WITH'] ?? false,
            'connection'                 => $_SERVER['HTTP_CONNECTION']       ?? false,
            'host'                       => $_SERVER['HTTP_HOST']             ?? false,
            'referer'                    => $_SERVER['HTTP_REFERER']          ?? false,
            'userAgent'                  => $_SERVER['HTTP_USER_AGENT']       ?? false,
            'cookie'                     => $_SERVER['HTTP_COOKIE']           ?? false,
            'cacheControl'               => $_SERVER['HTTP_CACHE_CONTROL']    ?? false,
            'https'                      => $_SERVER['HTTPS']                 ?? false,
            'scriptFileName'             => $_SERVER['SCRIPT_FILENAME']       ?? false,
            'scriptName'                 => $_SERVER['SCRIPT_NAME']           ?? false,
            'path'                       => $_SERVER['PATH']                  ?? false,
            'pathInfo'                   => $_SERVER['PATH_INFO']             ?? false,
            'currentPath'                => $_SERVER['PATH_INFO']             ?? $_SERVER['QUERY_STRING'] ?? false,
            'pathTranslated'             => $_SERVER['PATH_TRANSLATED']       ?? false,
            'pathext'                    => $_SERVER['PATHEXT']               ?? false,
            'redirectQueryString'        => $_SERVER['REDIRECT_QUERY_STRING'] ?? false,
            'redirectUrl'                => $_SERVER['REDIRECT_URL']          ?? false,
            'redirectStatus'             => $_SERVER['REDIRECT_STATUS']       ?? false,
            'phpSelf'                    => $_SERVER['PHP_SELF']              ?? false,
            'queryString'                => $_SERVER['QUERY_STRING']          ?? false,
            'documentRoot'               => $_SERVER['DOCUMENT_ROOT']         ?? false,
            'windir'                     => $_SERVER['WINDIR']                ?? false,
            'comspec'                    => $_SERVER['COMSPEC']               ?? false,
            'systemRoot'                 => $_SERVER['SystemRoot']            ?? false,
            'gatewayInterface'           => $_SERVER['GATEWAY_INTERFACE']     ?? false
        ];

        if( isset($server[$type]) )
        {
            if( is_array($server[$type]) )
            {
                return $server[$type];
            }
            else
            {
                $return = htmlspecialchars($server[$type], ENT_QUOTES, "utf-8");
            }
        }
        elseif( isset($_SERVER[$type]) )
        {
            $return = htmlspecialchars($_SERVER[$type], ENT_QUOTES, "utf-8");
        }

        // 5.4.3[edited]
        return str_replace('&amp;', '&', $return) ?: false;
    }

    /**
     * trace
     * 
     * Produces formatted output that terminates the operation.
     * 
     * @param string $message
     * 
     * @return void
     */
    public static function trace(String $message)
    {
        $style  = 'border:solid 1px #E1E4E5;';
        $style .= 'background:#FEFEFE;';
        $style .= 'padding:10px;';
        $style .= 'margin-bottom:10px;';
        $style .= 'font-family:Calibri, Ebrima, Century Gothic, Consolas, Courier New, Courier, monospace, Tahoma, Arial;';
        $style .= 'color:#666;';
        $style .= 'text-align:left;';
        $style .= 'font-size:14px;';

        $message = preg_replace('/\[(.*?)\]/', '<span style="color:#990000;">$1</span>', $message);

        $str  = "<div style=\"$style\">";
        $str .= $message;
        $str .= '</div>';

        exit($str);
    }
}