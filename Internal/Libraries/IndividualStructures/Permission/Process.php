<?php namespace ZN\IndividualStructures\Permission;

class Process extends PermissionExtends implements ProcessInterface
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
    // start()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $roleId : 0
    // @param string  $process: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function start(Int $roleId = 0, String $process = NULL)
    {
        $this->content = $this->use($roleId, $process, 'object');

        ob_start();
    }

    //--------------------------------------------------------------------------------------------------------
    // end()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function end()
    {
        if( ! empty($this->content) )
        {
            $content = ob_get_contents();
        }
        else
        {
            $content = '';
        }

        ob_end_clean();

        $this->content = NULL;

        echo $content;
    }

    //--------------------------------------------------------------------------------------------------------
    // process()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param numeric $roleId : 0
    // @param string  $process: empty
    // @param string  $object : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(Int $roleId = 0, String $process = NULL, String $object = NULL) : String
    {
        $this->permission = INDIVIDUALSTRUCTURES_PERMISSION_CONFIG['process'];

        if( isset($this->permission[$roleId]) )
        {
            $rules = $this->permission[$roleId];
        }
        else
        {
            return false;
        }

        $currentUrl = $process;

        switch( $rules )
        {
            case 'all' :
                return $object;
            break;

            case 'any' :
                return false;
            break;
        }

        if( is_array($rules) ) // Birden fazla yetki var ise..........
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
                    if( strpos($currentUrl, $rule) > -1 )
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

                    if( strpos($currentUrl, $rule) > -1 )
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
            // tek bir yetki varsa

            if( $rules[0] === "!" )
            {
                $page = substr(trim($rules), 1);
            }
            else
            {
                $page = trim($rules);
            }

            if( strpos($currentUrl, $page) > -1 )
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
}
