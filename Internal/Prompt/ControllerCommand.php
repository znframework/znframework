<?php namespace ZN\Crontab;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Structure;

class ControllerCommand
{
    /**
     * Magic Constructor
     * 
     * @param string $path
     * @param string & $command
     */
    public function __constructor(String $path, String & $command)
    {
        $datas      = Structure::data($path);
        $controller = $datas['page'];
        $function   = $datas['function'] ?? 'main';
        $namespace  = $datas['namespace'];
        $parameters = $datas['parameters'];
        $class      = $namespace . $controller;
        $file       = str_replace('\\', '\\\\', $datas['file']);
        $command    = 'ZN\Base::import("'.$file.'"); ZN\Singleton::class("'.$class.'")->'.$function.
        '('. 
            implode(',', array_map(function($data)
            { 
                return '"'.$data.'"';

            }, $parameters)).
        ')';
    }
}
