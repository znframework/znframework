<?php namespace ZN\IndividualStructures\Import;

use Import;
use ZN\IndividualStructures\Import\Exception\FileNotFoundException;

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
    public function use(String $page, Array $data = NULL, Bool $obGetContents = false)
    {
        if( $return = Import::page($page, $data, $obGetContents, INTERNAL_TEMPLATES_DIR) )
        {
            return $return;
        }
        elseif( $return = Import::page($page, $data, $obGetContents, TEMPLATES_DIR) )
        {
            return $return;
        }
        elseif( $return = Import::page($page, $data, $obGetContents, EXTERNAL_TEMPLATES_DIR) )
        {

            return $return;
        }
        else
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $page);
        }
    }
}
