<?php namespace ZN\Requirements\System;

use Arrays;
use ZN\Core\Structure;

class ZeroCore
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
    // Protected Project
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $project = DEFAULT_PROJECT;

    //--------------------------------------------------------------------------------------------------------
    // Protected Project
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $command;

    //--------------------------------------------------------------------------------------------------------
    // Protected Default Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function commander($commands)
    {
        $commands = Arrays::removeFirst($commands);

        if( ($commands[0] ?? NULL) !== 'project-name' )
        {
            $commands = Arrays::addFirst($commands, DEFAULT_PROJECT);
            $commands = Arrays::addFirst($commands, 'project-name');
        }

        self::$project = $commands[1] ?? DEFAULT_PROJECT;
        self::$command = $commands[3] ?? NULL;
        $command       = $commands[2] ?? NULL;

        if( $command === NULL )
        {
            exit(lang('Commands', 'emptyCommand'));
        }

        $parameters = Arrays::removeFirst($commands, 4);

        switch( $command )
        {
            case 'run-uri'        :
            case 'run-controller' : self::_runController(); break;
            case 'run-model'      :
            case 'run-class'      : self::_runModel($parameters); break;
            case 'run-function'   : self::_runFunction($parameters); break;
            default               : exit(lang('Commands', 'invalidCommand', $command));
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Run Controller
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _runController()
    {
        $datas = Structure::data(self::$command);

        $page       = $datas['page'];
        $function   = $datas['function'] ?? 'main';
        $namespace  = $datas['namespace'];
        $parameters = $datas['parameters'];
        $file       = $datas['file'];
        $class      = $namespace . $page;

        import($file);

        echo uselib($class)->$function($parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Run Model
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _runModel($parameters)
    {
        $runModel    = self::$command;
        $runModelEx  = explode(':', $runModel);
        $class       = $runModelEx[0];
        $method      = $runModelEx[1] ?? NULL;

        echo uselib($class)->$method(...$parameters);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Run Function
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _runFunction($parameters)
    {
        $method = self::$command;

        echo $method(...$parameters);
    }
}

class_alias('ZN\Requirements\System\Zerocore', 'Zerocore');
