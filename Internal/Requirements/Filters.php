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

use Cookie;
use Server;
use Session;
use ZN\Helpers\Converter;

class Filters
{
    /**
     * Get
     * 
     * @param string $varName
     * 
     * @return bool
     */
    public static function get(String $varName) : Bool
    {
        return (bool) ($_GET[$varName] ?? NULL);
    }

    /**
     * Post
     * 
     * @param string $varName
     * 
     * @return bool
     */
    public static function post(String $varName) : Bool
    {
        return (bool) ($_POST[$varName] ?? NULL);
    }

    /**
     * Cookie
     * 
     * @param string $varName
     * 
     * @return bool
     */
    public static function cookie(String $varName) : Bool
    {
        return (bool) (Cookie::select($varName) || ($_COOKIE[$varName] ?? NULL));
    }

    /**
     * Session
     * 
     * @param string $varName
     * 
     * @return bool
     */
    public static function session(String $varName) : Bool
    {
        return (bool) (Session::select($varName) || ($_SESSION[$varName] ?? NULL));
    }

    /**
     * Env
     * 
     * @param string $varName
     * 
     * @return bool
     */
    public static function env(String $varName) : Bool
    {
        return (bool) ($_ENV[$varName] ?? NULL);
    }

    /**
     * Server
     * 
     * @param string $varName
     * 
     * @return bool
     */
    public static function server(String $varName) : Bool
    {
        return (bool) (Server::data($varName) || ($_SERVER[$varName] ?? NULL));
    }

    /**
     * ID
     * 
     * @param string $filterName
     * 
     * @return int
     */
    public static function id(String $filterName) : Int
    {
        return filter_id($filterName);
    }

    /**
     * List
     * 
     * @return array
     */
    public static function list() : Array
    {
        return filter_list();
    }

    /**
     * Input Array
     * 
     * @param string $type       = 'post'
     * @param mixed  $definition = NULL
     * @param bool   $addEmpty   = true
     * 
     * @return mixed
     */
    public static function inputArray(String $type = 'post', $definition = NULL, Bool $addEmpty = true)
    {
        return filter_input_array(self::_inputConstant($type), $definition, $addEmpty);
    }

    /**
     * Input
     * 
     * @param string $var
     * @param string $type    = 'post'
     * @param string $filter  = 'default'
     * @param mixed  $options = NULL
     * 
     * @return mixed
     */
    public static function input(String $var, String $type = 'post', String $filter = 'default' , $options = NULL)
    {
        return filter_input(self::_inputConstant($type), $var, self::_filterConstant($filter), $options);
    }

    /**
     * Input Array
     * 
     * @param array  $data
     * @param mixed  $definition = NULL
     * @param bool   $addEmpty   = true
     * 
     * @return mixed
     */
    public static function varArray(Array $data, $definition = NULL, Bool $addEmpty = true)
    {
        return filter_var_array($data, $definition, $addEmpty);
    }

    /**
     * Var
     * 
     * @param string $var
     * @param string $filter  = 'default'
     * @param mixed  $options = NULL
     * 
     * @return mixed
     */
    public static function var($var, String $filter = 'default', $options = NULL)
    {
        return filter_var($var, self::_filterConstant($filter), $options);
    }

    /**
     * Sanitize
     * 
     * @param string $const
     * 
     * @return int
     */
    public static function sanitize(String $const)
    {
        return self::_validate($const, __FUNCTION__);
    }

    /**
     * Validate
     * 
     * @param string $const
     * 
     * @return int
     */
    public static function validate(String $const)
    {
        return self::_validate($const, __FUNCTION__);
    }

    /**
     * Force
     * 
     * @param string $const
     * 
     * @return int
     */
    public static function force(String $const)
    {
        return self::_validate($const, __FUNCTION__);
    }

    /**
     * Flag
     * 
     * @param string $const
     * 
     * @return int
     */
    public static function flag(String $const)
    {
        return self::_validate($const, __FUNCTION__);
    }

    /**
     * Require
     * 
     * @param string $const
     * 
     * @return int
     */
    public static function require(String $const)
    {
        return self::_validate($const, 'require');
    }

    /**
     * Protected Var
     * 
     * @param string $varName = ''
     * @param string $type
     * 
     * @return bool
     */
    protected static function _var($varName = '', $type)
    {
        return filter_has_var(self::_inputConstant($type), $varName);
    }

    /**
     * Protected Input Constant
     * 
     * @param string $const
     * 
     * @return int
     */
    protected static function _inputConstant($const)
    {
        return Converter::toConstant($const, 'INPUT_');
    }

    /**
     * Protected Filter Constant
     * 
     * @param string $const
     * 
     * @return int
     */
    protected static function _filterConstant($const)
    {
        return Converter::toConstant($const, 'FILTER_');
    }

    /**
     * Protected Validate Constant
     * 
     * @param string $const
     * 
     * @return int
     */
    protected static function _validate($const, $type)
    {
        return constant('FILTER_'.strtoupper($type).'_'.strtoupper($const));
    }
}
