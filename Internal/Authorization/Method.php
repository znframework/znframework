<?php namespace ZN\Authorization;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Method extends PermissionExtends
{
    /**
     * Post
     * 
     * @param mixed $roleId = 6
     * 
     * @return bool
     */
    public static function post($roleId = 6) : Bool
    {
        return self::use($roleId, __FUNCTION__);
    }

    /**
     * Get
     * 
     * @param mixed $roleId = 6
     * 
     * @return bool
     */
    public static function get($roleId = 6) : Bool
    {
        return self::use($roleId, __FUNCTION__);
    }

    /**
     * Request
     * 
     * @param mixed $roleId = 6
     * 
     * @return bool
     */
    public static function request($roleId = 6) : Bool
    {
        return self::use($roleId, __FUNCTION__);
    }

    /**
     * Method
     * 
     * @param mixed  $roleId = 6
     * @param string $method = 'post'
     * 
     * @return bool
     */
    public static function use($roleId = 6, $method = 'post') : Bool
    {
        return self::common(PermissionExtends::$roleId ?? $roleId, $method, NULL, 'method');
    }
}
