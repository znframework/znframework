<?php namespace ZN\Core;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Classes\Config;
use ZN\DataTypes\Strings;
use ZN\In;

class Structure
{
    /**
     * Get structure data
     * 
     * @param string $requestUri = NULL
     * 
     * @return array
     */
    public static function data($requestUri = NULL)
    {
        $namespace    = PROJECT_CONTROLLER_NAMESPACE;
        $page         = '';
        $openFunction = Config::get('Services', 'route')['openFunction'];
        $function     = $openFunction ?: 'main';
        $parameters   = [];
        $segments     = '';
        $isFile       = '';
        $url          = explode('?', $requestUri ?? In::requestURI());
        $segments     = explode('/', $url[0]);

        # The controller information in the URL to be executed is captured.
        if( isset($segments[0]) )
        {
            $page   = $segments[0];
            $isFile = CONTROLLERS_DIR . suffix($page, '.php');

            if( ! is_file($isFile) )
            {
                $if        = '';
                $nsegments = $segments;

                for( $i = 0; $i < count($segments); $i++ )
                {
                    $if    .= $segments[$i].'/';
                    $ifTrim = rtrim($if, '/');
                    $isF    = CONTROLLERS_DIR . suffix($ifTrim , '.php');

                    if( is_file($isF) )
                    {
                        $page     = Strings\Split::divide($ifTrim, '/', -1);
                        $isFile   = $isF;
                        $segments = $nsegments;

                        break;
                    }

                    array_shift($nsegments);
                }
            }

            unset($segments[0]);
        }

        # The method information in the URL to be executed is captured.
        if( isset($segments[1]) )
        {
            $function = $segments[1];

            unset($segments[1]);
        }

        # The segments information in the URL to be executed is captured.
        if( isset($segments[2]) )
        {
            $parameters = $segments;
        }

        return
        [
            'page'         => $page,
            'file'         => $isFile,
            'function'     => $function,
            'namespace'    => $namespace,
            'openFunction' => $openFunction,
            'subdir'       => $ifTrim ?? NULL,
            'parameters'   => array_values($parameters)
        ];
    }

    /**
     * Structure short path descriptions.
     * 
     * @param void
     * 
     * @return void
     */
    public static function defines()
    {
        define('STRUCTURE_DATA', self::data());
        define('CURRENT_COPEN_PAGE', STRUCTURE_DATA['openFunction']);
        define('CURRENT_CPARAMETERS', STRUCTURE_DATA['parameters']);
        define('CURRENT_CFILE', STRUCTURE_DATA['file']);
        define('CURRENT_CFUNCTION', STRUCTURE_DATA['function']);
        define('CURRENT_CPAGE', ($page = STRUCTURE_DATA['page']) . '.php');
        define('CURRENT_CONTROLLER', $page);
        define('CURRENT_CNAMESPACE', $namespace = STRUCTURE_DATA['namespace'] );
        define('CURRENT_CCLASS', $namespace . CURRENT_CONTROLLER);
        define('CURRENT_CFPATH', str_replace
        (
            CONTROLLERS_DIR, '', CURRENT_CONTROLLER) . '/' . CURRENT_CFUNCTION
        );
        define('CURRENT_CFURI', strtolower(CURRENT_CFPATH));
        define('CURRENT_CFURL', SITE_URL . CURRENT_CFPATH);
    }
}
