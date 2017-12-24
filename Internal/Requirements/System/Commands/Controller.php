<?php namespace ZN\Requirements\System\Commands;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Core\Structure;

class Controller
{
    /**
     * Magic constructor
     * 
     * @param string $command
     * 
     * @return void
     */
    public function __construct($command)
    {   
        $datas      = Structure::data($command);
        $page       = $datas['page'];
        $function   = $datas['function'] ?? 'main';
        $namespace  = $datas['namespace'];
        $parameters = $datas['parameters'];
        $file       = $datas['file'];
        $class      = $namespace . $page;

        import($file);

        new Result( uselib($class)->$function(...$parameters) );
    }
}