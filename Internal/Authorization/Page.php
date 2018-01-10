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

class Page extends PermissionExtends
{
    /**
     * Page
     * 
     * @param mixed $roleId = 6
     * 
     * @return mixed
     */
    public static function use($roleId = 6)
    {
        return self::common(PermissionExtends::$roleId ?? $roleId, NULL, NULL, 'page');
    }
}
