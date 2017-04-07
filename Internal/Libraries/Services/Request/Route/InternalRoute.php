<?php namespace ZN\Services\Request;

use ZN\Core\Structure;
use Arrays, Config, Errors, BaseController, Http, Import, Regex;

class InternalRoute extends BaseController implements InternalRouteInterface
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
    // Method -> 4.3.1
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $method = [];

    //--------------------------------------------------------------------------------------------------------
    // Route
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $route = [];

    //--------------------------------------------------------------------------------------------------------
    // Use Run Method
    //--------------------------------------------------------------------------------------------------------
    //
    // @var bool
    //
    //--------------------------------------------------------------------------------------------------------
    protected $useRunMethod = false;

    //--------------------------------------------------------------------------------------------------------
    // Route
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $routes = [];

    //--------------------------------------------------------------------------------------------------------
    // Status
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $status = [];

    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $data = [];

    //--------------------------------------------------------------------------------------------------------
    // Masterpage Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $mdata = [];

    //--------------------------------------------------------------------------------------------------------
    // Pattern Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $patternType = 'special';

    //--------------------------------------------------------------------------------------------------------
    // Destruct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __destruct()
    {
        if( $this->useRunMethod === true && empty($this->status) )
        {
            $this->redirectShow404(CURRENT_CFUNCTION);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Method 404 -> 4.3.1
    //--------------------------------------------------------------------------------------------------------
    //
    //  @param  variadic ...$function
    //  @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function method(...$methods) : InternalRoute
    {
        $this->method = $methods;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // URI
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    // @param bool   $usable
    //
    //--------------------------------------------------------------------------------------------------------
    public function uri(String $path = NULL, $usable = true)
    {
        if( empty($this->route) )
        {
            return false;
        }

        if( $usable === false )
        {
            if( stripos(requestURI(), $path) === 0 )
            {
                $this->redirectShow404($path);
            }
        }

        $configPatternType = Config::get('Services', 'route')['patternType'];

        if( $this->patternType === 'classic' && $configPatternType === 'classic' )
        {
            $routeString = $this->route;
            $this->route = Regex::classic2special($this->route);
        }
        elseif( $this->patternType === 'special' && $configPatternType === 'classic' )
        {
            $routeString = Regex::special2classic($this->route);
        }
        elseif( $this->patternType === 'special' && $configPatternType === 'special' )
        {
            $routeString = $this->route;
        }
        elseif( $this->patternType === 'classic' && $configPatternType === 'special' )
        {
            $routeString = Regex::classic2special($this->route);
            $this->route = $routeString;
        }

        $this->routes['allowMethods'][$path]     = $this->method;
        $this->routes['changeUri'][$routeString] = $newRoute = $this->_stringRoute($path, $this->route)[$this->route];
    }

    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function all()
    {
        if( ! empty($this->routes) )
        {
            $config = Config::get('Services', 'route');

            Config::set('Services', 'route',
            [
                'requestMethods'      =>
                [
                    'disallowMethods' => array_merge([], $config['requestMethods']['disallowMethods']),
                    'allowMethods'    => array_merge($this->routes['allowMethods'], $config['requestMethods']['allowMethods'])
                ],
                'changeUri'           => array_merge($this->routes['changeUri'], $config['changeUri'])
            ]);

            $this->_defaultVariable();
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function data(Array $data = NULL)
    {
        $this->data = $data;
    }

    //--------------------------------------------------------------------------------------------------------
    // Wizard Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function wdata(Array $data = NULL)
    {
        $this->data = $data;
    }

    //--------------------------------------------------------------------------------------------------------
    // Masterpage Data
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function mdata(Array $data = NULL)
    {
        $this->mdata = $data;
    }

    //--------------------------------------------------------------------------------------------------------
    // Change
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $route
    //
    //--------------------------------------------------------------------------------------------------------
    public function change($route, String $type = 'special') : InternalRoute
    {
        $this->route       = $route;
        $this->patternType = $type;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------------
    // Genel Kullanım: Çalıştırılmak istenen kod bloklarını yönetmek için kullanılır.
    //
    //  @param  string   $functionName
    //  @param  function $functionRun
    //  @param  array    $route
    //  @param  string   $type
    //  @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function run(String $functionName, Callable $functionRun = NULL, $route = NULL, String $type = NULL)
    {
        if( ! empty($this->route) )
        {
            $route = $this->route;
        }

        if( ! empty($route) )
        {
            if( is_string($route) )
            {
                $route = $this->_stringRoute($functionName, $route);
            }

            Config::set('Services', 'route', ['changeUri' => $route, 'patternType' => $type ?? $this->patternType]);
        }

        $datas        = Structure::data();
        $parameters   = $datas['parameters'];
        $view         = $datas['page'];
        $isFile       = $datas['file'];
        $function     = $datas['function'];
        $openFunction = $datas['openFunction'];

        if( Arrays::valueExists(['construct', 'destruct'], $functionName) )
        {
            call_user_func_array($functionRun, $parameters);
        }

        if( is_file($isFile) )
        {
            if( $functionName === $function )
            {
                if( ! empty($this->method) && Http::isRequestMethod(...$this->method) === false )
                {
                    $this->redirectInvalidRequest();
                }

                call_user_func_array($functionRun, $parameters);

                $this->_import($functionName, $openFunction, $view);

                $this->status[] = $functionName;

                exit;
            }
        }

        $this->useRunMethod = true;

        $this->_defaultVariable();
    }

    //--------------------------------------------------------------------------------------------------------
    // Redirect Invalid Request -> 4.3.1
    //--------------------------------------------------------------------------------------------------------
    //
    //  @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function redirectInvalidRequest()
    {
        $invalidRequest = Config::get('Services', 'route')['requestMethods'];

        if( empty($invalidRequest['page']) )
        {
            report('Error', lang('Error', 'invalidRequest'), 'InvalidRequestError');
            trace(lang('Error', 'invalidRequest'));
        }
        else
        {
            redirect($invalidRequest['page']);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Redirect Show 404 -> 4.2.7
    //--------------------------------------------------------------------------------------------------------
    //
    //  @param  string $function
    //  @param  string $lang
    //  @param  string $report
    //
    //--------------------------------------------------------------------------------------------------------
    public function redirectShow404(String $function, String $lang = 'callUserFuncArrayError', String $report = 'SystemCallUserFuncArrayError')
    {
        if( ! $routeShow404 = Config::get('Services', 'route')['show404'] )
        {
            report('Error', lang('Error', $lang), $report);
            die(Errors::message('Error', $lang, $function));
        }
        else
        {
            redirect($routeShow404);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected String Route
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $functionName
    // @param string $route
    //
    //--------------------------------------------------------------------------------------------------------
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
        $changeRoute = str_replace(divide($route, '/'), $functionName, $changeRoute);
        $route       = [$route => $changeRoute];

        return $route;
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Import
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $function
    // @param string $openFunction
    // @param string $view
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _import($function, $openFunction, $view)
    {
        $viewFunction = $function === $openFunction ? NULL : '-'.$function;
        $viewDir      = PAGES_DIR . $view . $viewFunction;
        $viewPath     = $viewDir  . '.php';
        $wizardPath   = $viewDir  . '.wizard.php';

        if( ! empty($this->mdata) )
        {
            Config::set('Masterpage', $this->mdata);

            Import::masterpage($this->mdata);
        }
        elseif( is_file($wizardPath) && ! isImport($viewPath) && ! isImport($wizardPath) )
        {
            Import::view(str_replace(PAGES_DIR, NULL, $wizardPath), $this->data);
        }
        elseif( is_file($viewPath) && ! isImport($viewPath) && ! isImport($wizardPath) )
        {
            Import::view(str_replace(PAGES_DIR, NULL, $viewPath), $this->data);
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Default Variable -> 4.3.1
    //--------------------------------------------------------------------------------------------------------
    //
    //  @return void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _defaultVariable()
    {
        $this->mdata       = [];
        $this->data        = [];
        $this->route       = [];
        $this->method      = [];
        $this->routes      = [];
        $this->patternType = 'special';
    }
}
