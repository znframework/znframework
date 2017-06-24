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
    // @param numeric $roleId : 0
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(Int $roleId = 6) : Bool
    {
        $this->permission = INDIVIDUALSTRUCTURES_PERMISSION_CONFIG['page'];

        if( isset($this->permission[$roleId]) )
        {
            $rules = $this->permission[$roleId];
        }
        else
        {
            return false;
        }

        $currentUrl = server('currentPath');

        switch( $rules )
        {
            case 'all' :
                return true;
            break;

            case 'any' :
                return false;
            break;
        }

        if( is_array($rules) ) // Birden fazla sayfa var ise..........
        {
            $pages = current($rules);
            $type  = key($rules);

            foreach($pages as $page)
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
                    if( strpos($currentUrl, $rule) > -1 )
                    {
                         return true;
                    }
                    else
                    {
                         $this->result = false;
                    }
                }
                else
                {

                    if( strpos($currentUrl, $rule) > -1 )
                    {
                         return false;
                    }
                    else
                    {
                         $this->result = true;
                    }
                }
            }

            return $this->result;
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

            if( strpos($currentUrl, $page) > -1 )
            {
                if( $rules[0] !== "!" )
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return true;
            }
        }
    }
}
