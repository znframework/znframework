<?php namespace ZN\Services;

use Config;
use ZN\Services\Exception\SetcookieException;
use ZN\IndividualStructures\IS;
use ZN\CryptoGraphy\Encode;
use ZN\DataTypes\Json;

class Cookie implements CookieInterface, SessionCookieCommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @var int
    //
    //--------------------------------------------------------------------------------------------------------
    protected $time;

    //--------------------------------------------------------------------------------------------------------
    // Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $path;

    //--------------------------------------------------------------------------------------------------------
    // Domain
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $domain;

    //--------------------------------------------------------------------------------------------------------
    // Secure
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $secure;

    //--------------------------------------------------------------------------------------------------------
    // httpOnly
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $httpOnly;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        \Session::start();

        $this->config = Config::services('cookie');
    }

    //--------------------------------------------------------------------------------------------------------
    // Session Cookie Common
    //--------------------------------------------------------------------------------------------------------
    //
    // @methods
    //
    //--------------------------------------------------------------------------------------------------------
    use SessionCookieCommonTrait;

    //--------------------------------------------------------------------------------------------------------
    // Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int $time
    //
    //--------------------------------------------------------------------------------------------------------
    public function time(Int $time) : Cookie
    {
        $this->time = $time;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    //
    //--------------------------------------------------------------------------------------------------------
    public function path(String $path) : Cookie
    {
        $this->path = $path;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Domain
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $domain
    //
    //--------------------------------------------------------------------------------------------------------
    public function domain(String $domain) : Cookie
    {
        $this->domain = $domain;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Secure
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $secure
    //
    //--------------------------------------------------------------------------------------------------------
    public function secure(Bool $secure = false) : Cookie
    {
        $this->secure = $secure;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Http Only
    //--------------------------------------------------------------------------------------------------------
    //
    // @param bool $httpOnly
    //
    //--------------------------------------------------------------------------------------------------------
    public function httpOnly(Bool $httpOnly = true) : Cookie
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    // @param int    $time
    //
    //--------------------------------------------------------------------------------------------------------
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
            throw new SetcookieException('Services', 'cookie:setError');
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Select
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Select All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Delete All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Protected Methods
    //--------------------------------------------------------------------------------------------------------
    //
    // cookieDefaultVariable()
    //
    //--------------------------------------------------------------------------------------------------------
    protected function cookieDefaultVariable()
    {
        $this->time       = NULL;
        $this->path       = NULL;
        $this->domain     = NULL;
        $this->secure     = NULL;
        $this->httpOnly   = NULL;
    }
}
