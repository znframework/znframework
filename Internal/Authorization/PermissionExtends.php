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

use ZN\Base;
use ZN\Config;
use ZN\Request\Method;

class PermissionExtends
{
    /**
     * Permission
     * 
     * @var array
     */
    protected static $permission = [];

    /**
     * Result
     * 
     * @var string
     */
    protected static $result;

    /**
     * Content
     * 
     * @var string
     */
    protected static $content;

    /**
     * Role ID
     * 
     * @var mixed
     */
    public static $roleId;

    /**
     * Role ID
     * 
     * @param mixed $roleId
     * 
     * @return void
     */
    public static function roleId($roleId)
    {
        self::$roleId = $roleId;
    }

    /**
     * Permission Common
     * 
     * @param mixed $roleId  = 6
     * @param mixed $process
     * @param mixed $object
     * @param mixed $function
     * 
     * @return mixed
     */
    protected static function common($roleId = 6, $process, $object, $function)
    {
        self::$permission = Config::default(new AuthorizationDefaultConfiguration)
                                  ::get('Authorization', $function);

        if( isset(self::$permission[$roleId]) )
        {
            $rules = self::$permission[$roleId];
        }
        else
        {
            return false;
        }

        if( $function === 'method' )
        {
            $currentUrl = NULL;
        }
        else
        {
            $currentUrl = $process ?? Base::currentPath();
        }

        $object = $object ?? true;
    
        switch( $rules ?? NULL )
        {
            case 'all' :
                return $object;
            break;

            case 'any' :
                return false;
            break;
        }
        
        if( is_array($rules) )
        {
            $pages = current($rules);
            $type  = key($rules);

            foreach( $pages as $page )
            {
                $page = trim($page);

                if( stripos($page[0], '!') === 0 )
                {
                    $rule = substr(trim($page), 1);
                }
                else
                {
                    $rule = trim($page);
                }

                if( $type === "perm" )
                {
                    if( self::control($currentUrl, $rule, $process, $function) )
                    {
                         return $object;
                    }
                    else
                    {
                         self::$result = false;
                    }
                }
                else
                {

                    if( self::control($currentUrl, $rule, $process, $function) )
                    {
                         return false;
                    }
                    else
                    {
                         self::$result = $object;
                    }
                }
            }

            return self::$result;
        }
        else
        {
            if( $rules[0] === "!" )
            {
                $page = substr(trim($rules),1);
            }
            else
            {
                $page = trim($rules);
            }

            if( self::control($currentUrl, $page, $process, $function) )
            {
                if( $rules[0] !== "!" )
                {
                    return $object;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return $object;
            }
        }
    }

    /**
     * Control Permission
     * 
     * @param string $currentUrl
     * @param string $page
     * @param string $process
     * @param string $function
     * 
     * @return string
     */
    protected static function control($currentUrl, $page, $process, $function)
    {
        if( $function === 'method' )
        {
            return Method::$process($page);
        }

        return strpos($currentUrl, $page) > -1;
    }
}
