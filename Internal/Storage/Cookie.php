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

use ZN\Config;
use ZN\Storage\Exception\SetcookieException;
use ZN\IndividualStructures\IS;
use ZN\Cryptography\Encode;
use ZN\DataTypes\Json;

class Cookie implements CookieInterface, SessionCookieCommonInterface
{
    use SessionCookieCommonTrait;

    /**
     * Keeps time
     * 
     * @var int
     */
    protected $time;

    /**
     * Keeps path
     * 
     * @var string
     */
    protected $path;

    /**
     * Keeps domain
     * 
     * @var string
     */
    protected $domain;

    /**
     * Keeps secure status
     * 
     * @var bool
     */
    protected $secure;

    /**
     * Keeps http status
     * 
     * @var bool
     */
    protected $httpOnly;

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        Session::start();

        $this->config = Config::get('Storage', 'cookie');
    }

    /**
     * Sets cookie time
     * 
     * @param int $time
     * 
     * @return Cookie
     */
    public function time(Int $time) : Cookie
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Sets cookie path
     * 
     * @param string $path
     * 
     * @return Cookie
     */
    public function path(String $path) : Cookie
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Sets cookie domain
     * 
     * @param string @domain
     * 
     * @return Cookie
     */
    public function domain(String $domain) : Cookie
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Sets secure status
     * 
     * @param bool $secure = false
     * 
     * @return Cookie
     */
    public function secure(Bool $secure = false) : Cookie
    {
        $this->secure = $secure;

        return $this;
    }

    /**
     * Sets only http status
     * 
     * @param bool $httpOnly = true
     * 
     * @return Cookie
     */
    public function httpOnly(Bool $httpOnly = true) : Cookie
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }

    /**
     * Insert cookie
     * 
     * @param string $name
     * @param mixed  $value
     * @param int    $time = NULL
     * 
     * @return bool
     */
    public function insert(String $name, $value, Int $time = NULL) : Bool
    {
        if( ! empty($time) ) $this->time($time);

        if( ! empty($this->encode) )
        {
            if( isset($this->encode['name']) )
            {
                if( IS::hash($this->encode['name']) )
                {
                    $name = Encode\Type::create($name, $this->encode['name']);
                }
            }

            if( isset($this->encode['value']) )
            {
                if( IS::hash($this->encode['value']) )
                {
                    $value = Encode\Type::create($value, $this->encode['value']);
                }
            }
        }

        $cookieConfig = $this->config;

        if( empty($this->time) )        $this->time     = $cookieConfig['time'];
        if( empty($this->path) )        $this->path     = $cookieConfig['path'];
        if( empty($this->domain) )      $this->domain   = $cookieConfig['domain'];
        if( empty($this->secure) )      $this->secure   = $cookieConfig['secure'];
        if( empty($this->httpOnly) )    $this->httpOnly = $cookieConfig['httpOnly'];

        if( ! isset($this->encode['name']) )
        {
            $encode = $cookieConfig["encode"];

            if( $encode === true )
            {
                $name = md5($name);
            }
            elseif( is_string($encode) )
            {
                if( IS::hash($encode) )
                {
                    $name = Encode\Type::create($name, $encode);
                }
            }
        }

        if( ! is_scalar($value) )
        {
            $value = json_encode($value);
        }

        if( setcookie($name, $value, time() + $this->time, $this->path, $this->domain, $this->secure, $this->httpOnly) )
        {
            if( $this->regenerate === true )
            {
                session_regenerate_id();
            }

            $this->defaultVariable();
            $this->cookieDefaultVariable();

            return true;
        }
        else
        {
            throw new SetcookieException;
        }
    }

    /**
     * Select cookie
     * 
     * @param string $name
     * 
     * @return mixed
     */
    public function select(String $name)
    {
        if( isset($this->encode['name']) )
        {
            if( IS::hash($this->encode['name']) )
            {
                $name = Encode\Type::create($name, $this->encode['name']);
                $this->encode = [];
            }
        }
        else
        {
            $encode = $this->config['encode'];

            if( $encode === true )
            {
                $name = md5($name);
            }
            elseif( is_string($encode) )
            {
                if( IS::hash($encode) )
                {
                    $name = Encode\Type::create($name, $encode);
                }
            }
        }

        if( ! empty($this->decode) )
        {
            $this->decode = NULL;
        }

        if( isset($_COOKIE[$name]) )
        {
            return ! Json\ErrorInfo::check($_COOKIE[$name])
                   ? $_COOKIE[$name]
                   : json_decode($_COOKIE[$name], true);
        }
        else
        {
            return false;
        }
    }

    /**
     * Select all cookie
     * 
     * @param void
     * 
     * @return array
     */
    public function selectAll() : Array
    {
        if( ! empty($_COOKIE) )
        {
            return $_COOKIE;
        }
        else
        {
            return false;
        }
    }

    /**
     * Delete cookie
     * 
     * @param string $name
     * @param string $path = NULL
     * 
     * @param bool
     */
    public function delete(String $name, String $path = NULL) : Bool
    {
        $cookieConfig = $this->config;

        if( ! empty($path) )
        {
            $this->path = $path;
        }

        if( empty($this->path) )
        {
            $this->path = $cookieConfig["path"];
        }

        if( isset($this->encode['name']) )
        {
            if( IS::hash($this->encode['name']) )
            {
                $name = Encode\Type::create($name, $this->encode['name']);
                $this->encode = [];
            }
        }
        else
        {
            $encode = $cookieConfig["encode"];

            if( $encode === true )
            {
                $name = md5($name);
            }
            elseif( is_string($encode) )
            {
                if( IS::hash($encode) )
                {
                    $name = Encode\Type::create($name, $encode);
                }
            }
        }

        if( isset($_COOKIE[$name]) )
        {
            setcookie($name, '', (time() - 1), $this->path);
            $this->path = NULL;

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Delete all cookies
     * 
     * @param void
     * 
     * @return bool
     */
    public function deleteAll() : Bool
    {
        $path = $this->config['path'];

        if( ! empty($_COOKIE) ) foreach( $_COOKIE as $key => $val )
        {
            setcookie($key, '', time() - 1, $path);
        }
        else
        {
            return false;
        }

        return true;
    }

    /**
     * Default Cookie Variable
     * 
     * @param void
     * 
     * @return void
     */
    protected function cookieDefaultVariable()
    {
        $this->time       = NULL;
        $this->path       = NULL;
        $this->domain     = NULL;
        $this->secure     = NULL;
        $this->httpOnly   = NULL;
    }
}
