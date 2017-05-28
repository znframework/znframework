<?php
//--------------------------------------------------------------------------------------------------
// Ending
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Ending Controllers
//--------------------------------------------------------------------------------------------------------
if( $destruct = Config::get('Starting', 'destruct') )
{
    if( is_string($destruct) )
    {
        internalStartingController($destruct);
    }
    elseif( is_array($destruct) )
    {
        foreach( $destruct as $key => $val )
        {
            if( is_numeric($key) )
            {
                internalStartingController($val);
            }
            else
            {
                internalStartingController($key, $val);
            }
        }
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Restore Error Handler
//--------------------------------------------------------------------------------------------------------
//
// @mode = 'publication'
//
//--------------------------------------------------------------------------------------------------------
if( PROJECT_MODE !== 'publication' )
{
    restore_error_handler();
}
else
{
    if(  Config::get('General', 'log')['createFile'] === true && $errorLast = Errors::last() )
    {
        $lang    = lang('Templates');
        $message = $lang['line']   .':'.$errorLast['line'].', '.
                   $lang['file']   .':'.$errorLast['file'].', '.
                   $lang['message'].':'.$errorLast['message'];

        report('GeneralError', $message, 'GeneralError');
    }
}

//--------------------------------------------------------------------------------------------------------
// Ob End Flush
//--------------------------------------------------------------------------------------------------------
//
// Tampon kapatılıyor.
//
//--------------------------------------------------------------------------------------------------------
ob_end_flush();
