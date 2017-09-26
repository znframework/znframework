<?php namespace ZN\Services\Response;

use Config, CLController, Encode, IS;

class InternalSession extends CLController implements InternalSessionInterface, SessionCookieCommonInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.zntr.net
    // Lisans     : The MIT License
    // Telif Hakkı: Copyright ConfigController(c) 2012-2016, zntr.net
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'Services:session';

    //--------------------------------------------------------------------------------------------------------
    // Session Cookie Common
    //--------------------------------------------------------------------------------------------------------
    //
    // methods
    //
    //--------------------------------------------------------------------------------------------------------
    use SessionCookieCommonTrait;

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
        parent::__construct();

        Config::iniSet(Config::get('Htaccess', 'session')['settings']);

        $this->start();
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public function insert(String $name, $value) : Bool
    {
        if( ! empty($this->encode) )
        {
            if( isset($this->encode['name']) )
            {
                if( IS::hash($this->encode['name']) )
                {
                    $name = Encode::type($name, $this->encode['name']);
                }
            }

            if( isset($this->encode['value']) )
            {
                if( IS::hash($this->encode['value']) )
                {
                    $value = Encode::type($value, $this->encode['value']);
                }
            }
        }

        $sessionConfig = SERVICES_SESSION_CONFIG;

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
                    $name = Encode::type($name, $encode);
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
                $name = Encode::type($name, $this->encode['name']);
                $this->encode = [];
            }
        }
        else
        {
            $encode = SERVICES_SESSION_CONFIG['encode'];

            if( $encode === true )
            {
                $name = md5($name);
            }
            elseif( is_string($encode) )
            {
                if( IS::hash($encode) )
                {
                    $name = Encode::type($name, $encode);
                }
            }
        }

        return $_SESSION[$name] ?? false;
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
        return $_SESSION;
    }

    //--------------------------------------------------------------------------------------------------------
    // Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function start()
    {
        if( ! isset($_SESSION) )
        {
            session_start();
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $name) : Bool
    {
        $sessionConfig = SERVICES_SESSION_CONFIG;

        if( isset($this->encode['name']) )
        {
            if( IS::hash($this->encode['name']) )
            {
                $name = Encode::type($name, $this->encode['name']);
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
                    $name = Encode::type($name, $encode);
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

    //--------------------------------------------------------------------------------------------------------
    // Delete All
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteAll() : Bool
    {
        return session_destroy();
    }
}
