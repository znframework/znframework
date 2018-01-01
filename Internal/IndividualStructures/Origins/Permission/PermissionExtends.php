<?php namespace ZN\IndividualStructures\Permission;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Services\Method;

class PermissionExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Permission
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $permission = [];

    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $result;

    //--------------------------------------------------------------------------------------------------------
    // Content
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $content;

    //--------------------------------------------------------------------------------------------------------
    // Role ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @var scalar
    //
    //--------------------------------------------------------------------------------------------------------
    public static $roleId;

    //--------------------------------------------------------------------------------------------------------
    // Role ID -> 5.4.4[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @var scalar
    //
    //--------------------------------------------------------------------------------------------------------
    public static function roleId($roleId)
    {
        self::$roleId = $roleId;
    }

    //--------------------------------------------------------------------------------------------------------
    // common() -> 5.3.9[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $roleId : 0
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function common($roleId = 6, $process, $object, $function)
    {
        self::$permission = \Config::get('IndividualStructures', 'permission')[$function];

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
            $currentUrl = $process ?? server('currentPath');
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

     //--------------------------------------------------------------------------------------------------------
    // control() -> 5.3.9[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $roleId : 0
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function control($currentUrl, $page, $process, $function)
    {
        if( $function === 'method' )
        {
            return Method::$process($page);
        }

        return strpos($currentUrl, $page) > -1;
    }
}
