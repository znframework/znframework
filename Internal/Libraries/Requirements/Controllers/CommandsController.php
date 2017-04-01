<?php namespace Project\Commands;

class CommandsController extends \BaseController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    public function __construct()
    {
        if( server('documentRoot') )
        {
            throw new \GeneralException
            (
                'Commands',
                'canNotCommandClass'
            );
        }
    }
}

class_alias('Project\Commands\CommandsController', 'CommandsController');
