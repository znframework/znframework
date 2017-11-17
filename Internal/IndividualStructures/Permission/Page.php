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
    public function use($roleId = 6)
    {
        return $this->common(PermissionExtends::$roleId ?? $roleId, NULL, NULL, 'page');
    }
}
