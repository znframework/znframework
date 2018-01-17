<?php namespace Project\Controllers;

//------------------------------------------------------------------------------------------------------------
// GENERATE
//------------------------------------------------------------------------------------------------------------
//
// Author   : ZN Framework
// Site     : www.znframework.com
// License  : The MIT License
// Copyright: Copyright (c) 2012-2016, znframework.com
//
//------------------------------------------------------------------------------------------------------------

class Experiments extends Controller
{
    //--------------------------------------------------------------------------------------------------------
    // Main
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $params NULL
    //
    //--------------------------------------------------------------------------------------------------------
    public function main(String $params = NULL)
    {
        Masterpage::page('experiment');
    }

    //--------------------------------------------------------------------------------------------------------
    // Ajax Alter Table
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function alterTable()
    {
        if( ! \Http::isAjax() )
        {
            return false;
        }

        $content = \Post::content();
        $type    = \Post::type();

        if( $type === 'php' )
        {
            eval('?>' . html_entity_decode($content, ENT_QUOTES)); exit;
        }
        else
        {
            $query = \DB::query($content);

            $result = \Import::view('experiments-table', ['columns' => $query->columns(), 'result' => $query->resultArray()], true);
        }

        echo $result ?: LANG['noOutput'];
    }
}
