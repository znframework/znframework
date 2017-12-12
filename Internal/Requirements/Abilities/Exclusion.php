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
    // Construct -> 5.4.6[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $file
    // @param string $message
    // @param mixed  $changed
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct($file = NULL, $message = NULL, $changed = NULL)
    {
        if( defined('static::lang') && $file === NULL )
        {
            $file = static::lang[Lang::get()] ?? 'No Exception Lang';

            $message = static::lang['placement'] ?? $message;

            if( is_array($message) )
            {
                $file = str_replace(array_keys($message), array_values($message), $file);
            }
            
            $message = $file;
        }
        else
        {
            if( $data = Lang::select($file, $message, $changed) )
            {
                $message = $data;
            }
            elseif( is_object($file) )
            {
                $message = $file->getMessage();
            }
            else
            {
                $message = $file;
            }    
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
