<?php namespace Project\Controllers;

//------------------------------------------------------------------------------------------------------------
// SYSTEM
//------------------------------------------------------------------------------------------------------------
//
// Author   : ZN Framework
// Site     : www.znframework.com
// License  : The MIT License
// Copyright: Copyright (c) 2012-2016, znframework.com
//
//------------------------------------------------------------------------------------------------------------

use Restful, Import;

class Version extends Controller
{
    //--------------------------------------------------------------------------------------------------------
    // Converter
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function notes(String $params = NULL)
    {
        if( ! $versions = Restful::post('https://api.znframework.com/statistics/versions') )
        {
            redirect();
        }

        Import::handload('Functions');
        $this->masterpage->pdata['notes'] = $versions;
        $this->masterpage->page           = 'versions-notes';
    }
}
