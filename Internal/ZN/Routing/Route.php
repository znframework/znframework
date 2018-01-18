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

class Route extends FilterProperties implements RouteInterface
{
    use PropertyCreatorTrait;

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

        $this->containerDefaultVariables();
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
        $this->usable($usable);
        
        $path = rtrim($path, '/');

        $routeConfig = $this->getConfig;

        if( ! strstr($path, '/') )
        {
            $path = Base::suffix($path) . $routeConfig['openFunction'];
        }

        $lowerPath = strtolower($path);

        $this->setFilters($lowerPath);

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
            $this->routes['changeUri'][$routeString] = $this->getStringRoute($path, $this->route)[$this->route];
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

            $this->defaultVariable();
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

                $this->import($functionName);

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
    protected function setFilters($lowerPath)
    {
        foreach( $this->getFilters() as $type ) if( isset($this->filters[$type]) )
        {
            $this->filters[$type . 's'][$lowerPath][$type] = $this->filters[$type];

            $this->isContainer($this->filters[$type]);
        }
    }

    /**
     * Protected String Route
     */
    protected function getStringRoute($functionName, $route)
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
    protected function import($function)
    {
        Kernel::viewPathFinder($function, $viewPath, $wizardPath);
        Kernel::viewAutoload($wizardPath, $viewPath);
    }

    /**
     * Protected Is Container
     */
    protected function isContainer(&$data)
    {
        if( $this->container !== true )
        {
            $data = NULL;
        }
    }

    /**
     * Container Default Variables
     */
    protected function containerDefaultVariables()
    {
        $this->filters = [];
    }

    /**
     * Default Variable
     */
    protected function defaultVariable()
    {
        $this->route  = [];
        $this->method = [];
        $this->routes = [];
    }
}
