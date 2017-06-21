<?php namespace ZN\Core;

use Config, Errors;

class Ending
{
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------
    //
    // Run starting
    //
    //--------------------------------------------------------------------------------------------------
    public static function run()
    {
        internalStartingConfig('destruct');

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

        ob_end_flush();
    }
}
