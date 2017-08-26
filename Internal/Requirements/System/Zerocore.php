<?php namespace ZN\Requirements\System;

use Arrays, Json, Crontab, IS;
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
    // Protected Parameters
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $parameters;

    //--------------------------------------------------------------------------------------------------------
    // Protected Default Variables
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function commander($commands)
    {
        \Logger::report('TerminalCommands', implode(' ', $commands), 'TerminalCommands');

        $commands = Arrays::removeFirst($commands);

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

        self::$parameters = Arrays::forceValues($parameters, function($data)
        {
            $return = $data;

            if( Json::check($return) )
            {
                $return = Json::decodeArray($return);
            }

            return $return;
        });

        switch( $command )
        {
            case 'run-uri'              :
            case 'run-controller'       : self::_runController();                       break;
            case 'run-model'            :
            case 'run-class'            : self::_runClass();                            break;
            case 'run-cron'             : self::_runCron();                             break;
            case 'cron-list'            : echo Crontab::list();                         break;
            case 'remove-cron'          : self::_removeCron();                          break;
            case 'run-command'          : self::_runClass(PROJECT_COMMANDS_NAMESPACE);  break;
            case 'run-external-command' : self::_runClass(EXTERNAL_COMMANDS_NAMESPACE); break;
            case 'run-function'         : self::_runFunction();                         break;
            case 'upgrade'              : self::_result(\ZN::upgrade());                break;
            case 'upgrade-files'        : self::_result(\ZN::upgradeFiles());           break;
            case 'create-project'       : self::_result(\Generate::project(self::$command));  break;
            case 'command-list'         :
            default                     : self::_commandList();
        }
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
        echo implode
        (EOL, [
            '+----------------------+--------------------------------------------------------------------------------+',
            '| Command Name         | Usage of Example                                                               |',
            '+----------------------+--------------------------------------------------------------------------------+',
            '| upgrade              | upgrade                                                                        |',
            '| upgrade-files        | upgrade-files                                                                  |',
            '| create-project       | create-project project name                                                    |',
            '| run-uri              | run-uri controller/function/p1/p2/.../pN                                       |',
            '| run-controller       | run-controller controller/function/p1/p2/.../pN                                |',
            '| run-model            | run-model model:function p1 p2 ... pN                                          |',
            '| run-class            | run-class class:function p1 p2 ... pN                                          |',
            '| run-cron             | run-cron controller/method func param func param ...                           |',
            '| run-cron             | run-cron command:method func param func param ...                              |',
            '| run-cron             | run-cron http://example.com/                                                   |',
            '| cron-list            | Cron Job List                                                                  |',
            '| remove-cron          | remove-cron cronID                                                             |',
            '| run-command          | run-command command:function p1 p2 ...pN                                       |',
            '| run-external-command | run-command command:function p1 p2 ...pN                                       |',
            '| run-function         | run-function function p1 p2 ... pN                                             |',
            '+----------------------+--------------------------------------------------------------------------------+',
        ]);
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

        self::_result(uselib($class)->$function(...$parameters));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Run Cron
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _runCron()
    {
        $parameters = self::$parameters;

        for( $index = 0, $rindex = 1; $index < count($parameters); $index += 2, $rindex += 2 )
        {
            $func = $parameters[$index]  ?? NULL;
            $prm  = $parameters[$rindex] ?? NULL;
            Crontab::$func($prm);
        }

        if( IS::url(self::$command) )
        {
            echo Crontab::wget(self::$command);
        }
        elseif( strstr(self::$command, '/') )
        {
            echo Crontab::controller(self::$command);
        }
        else
        {
            echo Crontab::command(self::$command);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Run Cron
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _removeCron()
    {
        echo Crontab::remove(self::$parameters[0] ?? NULL);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Result
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $result
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _result($result)
    {
        if( $result === true || $result === NULL )
        {
            echo \Lang::select('Success', 'success');
        }
        elseif( $result === false )
        {
            echo \Lang::select('Error', 'error');
        }
        else
        {
            if( is_array($result) )
            {
                print_r($result);
            }
            else
            {
                echo $result;
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Run Class
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _runClass($namespace = NULL)
    {
        self::_classMethod($class, $method);

        $className = $namespace . $class;

        self::_result(uselib($className)->$method(...self::$parameters));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Run Function
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _runFunction()
    {
        $method = self::$command;

        self::_result($method(...self::$parameters));
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Class Method
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    protected static function _classMethod(&$class = NULL, &$method = NULL)
    {
        $commandEx = explode(':', self::$command);
        $class     = $commandEx[0];
        $method    = $commandEx[1] ?? NULL;
    }
}

class_alias('ZN\Requirements\System\Zerocore', 'Zerocore');
