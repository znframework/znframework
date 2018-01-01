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

class Page extends PermissionExtends
{
    //--------------------------------------------------------------------------------------------------------
    // page()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $roleId : 0
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use($roleId = 6)
    {
        return self::common(PermissionExtends::$roleId ?? $roleId, NULL, NULL, 'page');
    }
}
