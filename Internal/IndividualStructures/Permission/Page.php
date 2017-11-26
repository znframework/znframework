<?php namespace ZN\IndividualStructures\Permission;

class Page extends PermissionExtends
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
