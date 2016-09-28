<?php namespace ZN\IndividualStructures\Import;

class Handload implements HandloadInterface
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
    // handload()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(...$args)
    {
        if( ! empty($args) ) foreach( $args as $file )
        {
            $suffix     = suffix($file, '.php');
            $commonFile = EXTERNAL_HANDLOAD_DIR.$suffix ;
            $file       = HANDLOAD_DIR.$suffix;

            if( is_file($file) )
            {
                require_once $file; // Local File
            }
            elseif( is_file($commonFile) )
            {
                require_once($commonFile); // Common File
            }
        }
    }
}
