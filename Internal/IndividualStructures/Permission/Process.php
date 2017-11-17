<?php namespace ZN\IndividualStructures\Permission;

class Process extends PermissionExtends
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
    public function start($roleId = 0, $process = NULL)
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
    // @param mixed   $roleId : 0
    // @param string  $process: empty
    // @param string  $object : empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function use($roleId = 0, $process = NULL, $object = NULL)
    {
        if( PermissionExtends::$roleId !== NULL )
        {
            $object  = $process;
            $process = $roleId;
            $roleId  = PermissionExtends::$roleId;
        }

        return $this->common($roleId, $process, $object, 'process');
    }
}
