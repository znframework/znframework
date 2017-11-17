<?php namespace ZN\IndividualStructures\Permission;

use Method;

class PermissionExtends extends \CLController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'IndividualStructures:permission';

    //--------------------------------------------------------------------------------------------------------
    // Permission
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $permission = [];

    //--------------------------------------------------------------------------------------------------------
    // Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $result;

    //--------------------------------------------------------------------------------------------------------
    // Content
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $content;

    //--------------------------------------------------------------------------------------------------------
    // Role ID
    //--------------------------------------------------------------------------------------------------------
    //
    // @var scalar
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $roleId;

    //--------------------------------------------------------------------------------------------------------
    // Role ID -> 5.4.4[added]
    //--------------------------------------------------------------------------------------------------------
    //
    // @var scalar
    //
    //--------------------------------------------------------------------------------------------------------
    public function roleId($roleId)
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
    protected function common($roleId = 6, $process, $object, $function)
    {
        $this->permission = INDIVIDUALSTRUCTURES_PERMISSION_CONFIG[$function];

        if( isset($this->permission[$roleId]) )
        {
            $rules = $this->permission[$roleId];
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
                    if( $this->control($currentUrl, $rule, $process, $function) )
                    {
                         return $object;
                    }
                    else
                    {
                         $this->result = false;
                    }
                }
                else
                {

                    if( $this->control($currentUrl, $rule, $process, $function) )
                    {
                         return false;
                    }
                    else
                    {
                         $this->result = $object;
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

            if( $this->control($currentUrl, $page, $process, $function) )
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
    protected function control($currentUrl, $page, $process, $function)
    {
        if( $function === 'method' )
        {
            return Method::$process($page);
        }

        return strpos($currentUrl, $page) > -1;
    }
}
