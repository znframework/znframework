<?php namespace ZN\Services;

class Method implements MethodInterface
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
    // Post
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function post(String $name = NULL, $value = NULL)
    {
        return self::_method($name, $value, $_POST ,__FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Get
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function get(String $name = NULL, $value = NULL)
    {
        return self::_method($name, $value, $_GET, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Request
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function request(String $name = NULL, $value = NULL)
    {
        return self::_method($name, $value, $_REQUEST, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Env
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function env(String $name = NULL, $value = NULL)
    {
        return self::_method($name, $value, $_ENV, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Server
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    //
    //--------------------------------------------------------------------------------------------------------
    public static function server(String $name = '', $value = NULL)
    {
        // @value parametresi boş değilse
        if( ! empty($value) )
        {
            $_SERVER[$name] = $value;
        }

        return server($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // Files
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $filename
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public static function files(String $fileName = NULL, String $type = 'name')
    {
        return $_FILES[$fileName][$type];
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $input
    // @param string $name
    //
    //--------------------------------------------------------------------------------------------------------
    public static function delete(String $input, String $name)
    {
        switch( $input )
        {
            case 'post'     : unset($_POST[$name]);    break;
            case 'get'      : unset($_GET[$name]);     break;
            case 'env'      : unset($_ENV[$name]);     break;
            case 'server'   : unset($_SERVER[$name]);  break;
            case 'request'  : unset($_REQUEST[$name]); break;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Method -> 5.4.7[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $name
    // @param mixed  $value
    // @param var    $input
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _method($name, $value, $input, $type)
    {
        if( empty($name) )
        {
            return $input;
        }

        // @value parametresi boş değilse 5.4.7[edited]
        if( $value !== NULL )
        {
            switch( $type )
            {
                case 'post'    : $_POST[$name]    = $value; break;
                case 'get'     : $_GET[$name]     = $value; break;
                case 'request' : $_REQUEST[$name] = $value; break;
                case 'env'     : $_ENV[$name]     = $value; break;
                default        : $_POST[$name]    = $value; break;
            }

            return true;
        }

        if( isset($input[$name]) )
        {
            if( is_scalar($input[$name]) )
            {
                return htmlspecialchars($input[$name], ENT_QUOTES, "utf-8");
            }
            elseif( is_array($input[$name]) )
            {
                return array_map('ZN\IndividualStructures\Security\Html::encode', $input[$name]);
            }

            return $input[$name];
        }

        return false;
    }
}
