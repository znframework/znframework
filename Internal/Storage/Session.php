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
use ZN\Cryptography\Encode;
use ZN\IS;

class Session implements SessionInterface, SessionCookieCommonInterface
{
    use SessionCookieCommonTrait;

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->config = Config::get('Storage', 'session');

        $this->start();
    }

    /**
     * Insert session
     * 
     * @param string $name
     * @param mixed  $value
     * 
     * @return bool
     */
    public function insert(String $name, $value) : Bool
    {
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

        $sessionConfig = $this->config;

        if( ! isset($this->encode['name']))
        {
            $encode = $sessionConfig["encode"];

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

        $_SESSION[$name] = $value;

        if( $_SESSION[$name] )
        {
            if( $this->regenerate === true )
            {
                session_regenerate_id();
            }

            $this->defaultVariable();

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Select session
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

        return $_SESSION[$name] ?? false;
    }

    /**
     * Select all session
     * 
     * @param void
     * 
     * @return array
     */
    public function selectAll() : Array
    {
        return $_SESSION;
    }

    /**
     * Session start
     * 
     * @param void
     * 
     * @return void
     */
    public static function start()
    {
        if( ! isset($_SESSION) )
        {
            session_start();
        }
    }

    /**
     * Delete session
     * 
     * @param string $name
     * 
     * @return bool
     */
    public function delete(String $name) : Bool
    {
        $sessionConfig = $this->config;

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
            $encode = $sessionConfig["encode"];

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

        if( isset($_SESSION[$name]) )
        {
            unset($_SESSION[$name]);

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Delete all session
     * 
     * @param void
     * 
     * @return void
     */
    public function deleteAll() : Bool
    {
        return session_destroy();
    }
}
