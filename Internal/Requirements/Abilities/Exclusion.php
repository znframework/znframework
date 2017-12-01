<?php 

use ZN\IndividualStructures\Lang;
use ZN\ErrorHandling\Exceptions;

trait ExclusionAbility
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
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $message
    // @param mixed  $changed
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct(String $file, String $message = NULL, $changed = NULL)
    {
        if( $data = Lang::select($file, $message, $changed) )
        {
            $message = $data;
        }
        else
        {
            $message = $file;
        }

        parent::__construct($message);
    }

    //--------------------------------------------------------------------------------------------------------
    // Continue
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $msg
    // @param string $file
    // @param string $line
    //
    //--------------------------------------------------------------------------------------------------------
    public function continue()
    {
        echo Exceptions::continue($this->getMessage(), $this->getFile(), $this->getLine());
    }
}
