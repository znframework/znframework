<?php namespace ZN\Routing;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Lang;
use ZN\Helper;
use ZN\Kernel;
use ZN\Config;
use ZN\Request;
use ZN\Response;
use ZN\Datatype;
use ZN\Singleton;
use ZN\Request\URI;
use ZN\ErrorHandling\Errors;

class Route implements RouteInterface
{
    /**
     * Keeps Container Data
     * 
     * @var bool
     */
    protected $container, $useRunMethod = false;

    /**
     * Keeps Array Data
     * 
     * @var array
     */
    protected $route = [], $routes = [], $status = [];

    /**
     * Keeps Filters
     * 
     * @var array
     */
    protected $filters = [];

    /**
     * Magic Constructor
     * 
     * Get route configuration.
     */
    public function __construct()
    {
        $this->getConfig = Config::get('Services', 'route');
    }

    /**
     * Magic Destructor
     */
    public function __destruct()
    {
        if( $this->useRunMethod === true && empty($this->status) )
        {
            $this->redirectShow404(CURRENT_CFUNCTION);
        }
    }

    /**
     * Route Show404
     * 
     * @param string $controllerAndMethod
     */
    public function show404(String $controllerAndMethod)
    {
        if( empty( $this->route ) )
        {
            $this->change('404');
        }

        Config::set('Services', 'route', ['show404' => $this->route]);

        $this->uri($controllerAndMethod);
    }

    /**
     * Container
     * 
     * @param callable $callback
     */
    public function container(Callable $callback)
    {
        $this->container = true;

        $callback();

        $this->container = false;

        $this->_containerDefaultVariables();
    }

    /**
     * Restore
     * 
     * @param string|array $ips
     * @param string       $uri = NULL
     * 
     * @return Route
     */
    public function restore($ips, String $uri = NULL) : Route
    {
        $this->filters['restore']['ips'] = (array) $ips;
        $this->filters['restore']['uri'] = $uri;

        return $this;
    }

    /**
     * Cache
     * 
     * @param string|int  $time     = 60
     * @param string|bool $compress = false
     * @param string      $driver   = 'file'
     * 
     * @return Route
     */
    public function cache($time = 60, $compress = false, String $driver = 'file') : Route
    {
        $this->filters['cache']['time']     = $time;
        $this->filters['cache']['compress'] = $compress;
        $this->filters['cache']['driver']   = $driver;
        $this->filters['cache']['status']   = true;

        return $this;
    }

    /**
     * No Cache
     * 
     * @return Route
     */
    public function nocache() : Route
    {
        $this->filters['nocache']['status'] = false;

        return $this;
    }

    /**
     * CSRF
     * 
     * @param string $uri = 'post'
     * 
     * @return Route
     */
    public function CSRF(String $uri = 'post') : Route
    {
        $this->filters['csrf'] = $uri;

        return $this;
    }

    /**
     * Ajax
     * 
     * @return Route
     */
    public function ajax() : Route
    {
        $this->filters['ajax'] = true;

        return $this;
    }

    /**
     * CURL
     * 
     * @return Route
     */
    public function curl() : Route
    {
        $this->filters['curl'] = true;

        return $this;
    }

    /**
     * Restful
     * 
     * @return Route
     */
    public function restful() : Route
    {
        $this->filters['restful'] = true;

        return $this;
    }

    /**
     * Callback
     * 
     * @param callable $callback
     * 
     * @return Route
     */
    public function callback(Callable $callback) : Route
    {
        $this->filters['callback'] = $callback;

        return $this;
    }

    /**
     * Apply Filters
     */
    public function filter()
    {
        foreach( $this->getFilters() as $filter )
        {
            new Filter($filter, $this->filters, $this->getConfig);
        }
    }

    /**
     * Sets methods
     * 
     * @param string ...$methods
     * 
     * @return Route
     */
    public function method(String ...$methods) : Route
    {
        $this->filters['method'] = $methods;

        return $this;
    }

    /**
     * Sets redirect
     * 
     * @param string $redirect
     * 
     * @return Route
     */
    public function redirect(String $redirect) : Route
    {
        $this->filters['redirect'] = $redirect;

        return $this;
    }

    /**
     * Get Filters
     * 
     * @return array
     */
    public function getFilters() : Array
    {
        return array_keys($this->filters);
    }

    /**
     * Sets old URI
     * 
     * @param string $path   = NULL
     * @param bool   $usable = true
     */
    public function uri(String $path = NULL, Bool $usable = true)
    {
        $path = rtrim($path, '/');

        $routeConfig = $this->getConfig;

        if( ! strstr($path, '/') )
        {
            $path = Base::suffix($path) . $routeConfig['openFunction'];
        }

        $lowerPath = strtolower($path);

        $filters = $this->getFilters();

        array_push($filters, 'redirect');

        $filters = array_unique(array_diff($filters, ['usable']));

        $this->setFilters($filters, $lowerPath);

        if( empty($this->route) )
        {
            return false;
        }

        $configPatternType = $routeConfig['patternType'];

        if( $configPatternType === 'classic' )
        {
            $routeString = Singleton::class('ZN\Regex')->special2classic($this->route);
        }
        elseif( $configPatternType === 'special' )
        {
            $routeString = $this->route;
        }

        # 5.3.21[edited] is empty
        if( trim($routeString, '/') )
        {
            $this->routes['changeUri'][$routeString] = $this->_stringRoute($path, $this->route)[$this->route];
        }

        if( $usable === false )
        {
            $this->filters['usable'][$lowerPath]['usable'] = $path;
        }

        $this->route = NULL;
    }

    /**
     * Sets all route
     */
    public function all()
    {
        if( ! empty($this->routes) )
        {
            $config = $this->getConfig;

            Config::set('Services', 'route',
            [
                'changeUri' => array_merge($this->routes['changeUri'], $config['changeUri'])
            ]);

            $this->_defaultVariable();
        }
    }

    /**
     * Change URI
     * 
     * @param string $route
     * 
     * @return Route
     */
    public function change(String $route) : Route
    {
        $route        = trim($route, '/');
        $return       = true;
        $routeSegment = explode('/', $route);

        // Database Routing
        $route = preg_replace_callback
        (
            '/\[(\w+|\.)\:(\w+|\.)(\s*\,\s*((json|serial|separator))(\:(.*?))*)*\]/i', 
            function($match) use (&$count, &$return, $routeSegment)
            {
                $count   = array_search($match[0], $routeSegment);
                $decoder = $match[4] ?? NULL;
                $value   = $val = URI::segment($count + 1);
                $column  = $match[2];
                $dbClass = Singleton::class('ZN\Database\DB');

                // Json, Serial or Separator
                if( $decoder !== NULL )
                {
                    $column = $match[2] . ' like';
                    $value  = $dbClass->like($value, 'inside');
                }

                $return = $dbClass->select($match[2])->where($column, $value)->get($match[1])->value();

                // Json, Serial or Separator
                if( $decoder !== NULL )
                {
                    $row       = $match[6] ?? Lang::get();
                    $rows      = $decoder::decode($return);
                    $rowsArray = $decoder::decodeArray($return);
                    $return    = $rows->$row ?? NULL;

                    // Current Lang Manipulation
                    if( $return !== $value && in_array($val, $rowsArray) )
                    {
                        $arrayTransform = array_flip($rowsArray);

                        $newRow = $arrayTransform[$val];
                        $return = $rows->$newRow;

                        if( Lang::shortCodes($newRow) )
                        {
                            Lang::set($newRow);
                        }
                    }
                }

                return $return;

            }, 
            $route
        );

        if( empty($return) )
        {
            $this->route = NULL;
        }
        else
        {
            $this->route = $route;
        }

        return $this;
    }

    /**
     * Run Route Controller
     * 
     * @param string   $functionName
     * @param callable $functionRun = NULL
     * @param bool     $usable      = true
     */
    public function run(String $functionName, Callable $functionRun = NULL, Bool $usable = true)
    {
        if( in_array($functionName, ['construct', 'destruct']) )
        {
            call_user_func_array($functionRun, CURRENT_CPARAMETERS);
        }

        if( is_file(CURRENT_CFILE) )
        {
            $matches = ( $usable === true ? $functionName === CURRENT_CFUNCTION : false );

            if( $matches )
            {
                $this->uri(CURRENT_CFURI);

                $this->filter();

                call_user_func_array($functionRun, CURRENT_CPARAMETERS);

                $this->_import($functionName);

                $this->status[] = $functionName;

                return;
            }
        }

        $this->useRunMethod = true;
    }

    /**
     * Redirect Show 404
     * 
     * @param string $function
     * @param string $lang
     * @param report
     */
    public function redirectShow404(String $function, String $lang = 'callUserFuncArrayError', String $report = 'SystemCallUserFuncArrayError')
    {
        if( ! $routeShow404 = $this->getConfig['show404'] )
        {
            Helper::report('Error', Lang::select('Error', $lang, $function), $report);
            
            exit(Errors::message('Error', $lang, $function));
        }
        else
        {
            Response::redirect($routeShow404);
        }
    }

    /**
     * Protected Filter
     */
    protected function setFilters($types, $lowerPath)
    {
        foreach( $types as $type ) if( ! empty($this->filters[$type]) )
        {
            $this->filters[$type . 's'][$lowerPath][$type] = $this->filters[$type];

            $this->_isContainer($this->filters[$type]);
        }
    }

    /**
     * Protected String Route
     */
    protected function _stringRoute($functionName, $route)
    {
        preg_match_all('/\:\w+/', $route, $match);

        $newMatch = [];

        $matchAll = $match[0] ?? [];

        foreach( $matchAll as $key => $val )
        {
            $key++;

            $newMatch[] = "$$key";
        }

        $changeRoute = str_replace($matchAll, $newMatch, $route);
        $changeRoute = str_replace(Datatype::divide($route, '/'), $functionName, $changeRoute);
        $route       = [$route => $changeRoute];

        return $route;
    }

    /**
     * Protected Import
     */
    protected function _import($function)
    {
        Kernel::viewPathFinder($function, $viewPath, $wizardPath);
        Kernel::viewAutoload($wizardPath, $viewPath);
    }

    /**
     * Protected View
     */
    protected static function _view($view, $fix)
    {
        if( $subdir = STRUCTURE_DATA['subdir'] )
        {
            $view = $subdir;
        }

        return PAGES_DIR . $view . $fix;
    }

    /**
     * Protected Is Container
     */
    protected function _isContainer(&$data)
    {
        if( $this->container !== true )
        {
            $data = NULL;
        }
    }

    /**
     * Container Default Variables
     */
    protected function _containerDefaultVariables()
    {
        $this->filters['method']   = NULL;
        $this->filters['redirect'] = NULL;
        $this->filters['restore']  = NULL;
        $this->filters['cache']    = NULL;
        $this->filters['nocache']  = NULL;
        $this->filters['csrf']     = NULL;
        $this->filters['ajax']     = NULL;
        $this->filters['curl']     = NULL;
        $this->filters['restful']  = NULL;
    }

    /**
     * Default Variable
     */
    protected function _defaultVariable()
    {
        $this->route       = [];
        $this->method      = [];
        $this->routes      = [];
    }
}
