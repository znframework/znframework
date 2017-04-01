<?php namespace ZN\Requirements\System;

use Arrays;
use ZN\Core\Structure;

class Zerocore
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
    // Protected Php
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $php;

    //--------------------------------------------------------------------------------------------------------
    // Protected Zerocore
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $zerocore;

    //--------------------------------------------------------------------------------------------------------
    // Protected Default Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function commander($commands)
    {
        self::$php      = divide(server('SUDO_COMMAND'), ' ');
        self::$zerocore = $commands[0];
        $commands       = Arrays::removeFirst($commands);

        if( ($commands[0] ?? NULL) !== 'project-name' )
        {
            $commands = Arrays::addFirst($commands, DEFAULT_PROJECT);
            $commands = Arrays::addFirst($commands, 'project-name');
        }

        self::$project = $commands[1] ?? DEFAULT_PROJECT;
        $command       = $commands[2] ?? NULL;
        self::$command = $commands[3] ?? NULL;

        if( $command === NULL )
        {
            self::_commandList(); exit;
        }

        $parameters = Arrays::removeFirst($commands, 4);

        echo self::_output();

        switch( $command )
        {
            case 'run-uri'        :
            case 'run-controller' : self::_runController(); break;
            case 'run-model'      :
            case 'run-class'      : self::_runModel($parameters); break;
            case 'run-command'    : self::_runCommand($parameters); break;
            case 'run-function'   : self::_runFunction($parameters); break;
            case 'command-list'   :
            default               : self::_commandList();
        }

        echo EOL . self::_line();
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Line
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _line()
    {
        return '--------------------------------------------------------------------' . EOL;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Output
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $message
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _output($message = 'OUTPUT')
    {
        $str  = self::_line();
        $str .= '| ' . $message . EOL;
        $str .= self::_line();

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Command List
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _commandList()
    {
        echo self::_output('COMMAND LIST');

        echo implode
        (EOL, [
            'Command Name    Usage of Example' . EOL,
            'run-uri         run-uri controller/function/p1/p2/.../pN',
            'run-controller  run-controller controller/function/p1/p2/.../pN',
            'run-model       run-model model:function p1 p2 ... pN',
            'run-class       run-class class:function p1 p2 ... pN',
            'run-command     run-command command:function p1 p2 ...pN',
            'run-function    run-function function p1 p2 ... pN'
        ]);

        echo EOL . self::_line();
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
        $datas      = Structure::data(self::$command);
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
    // Protected Run Model
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _runCommand($parameters)
    {
        $runModel    = self::$command;
        $runModelEx  = explode(':', $runModel);
        $class       = PROJECT_COMMANDS_NAMESPACE . $runModelEx[0];
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
