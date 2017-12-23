<?php namespace ZN\IndividualStructures\Import;

use ZN\IndividualStructures\Exception\FileNotFoundException;

class Template
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
    // template()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $page
    // @param array  $data
    // @param bool   $obGetContents
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(String $page, Array $data = NULL, Bool $obGetContents = false)
    {
        if( $return = View::use($page, $data, $obGetContents, TEMPLATES_DIR) )
        {
            return $return;
        }
        elseif( $return = View::use($page, $data, $obGetContents, EXTERNAL_TEMPLATES_DIR) )
        {
            return $return;
        }
        else
        {
            return false;
        }
    }
}
