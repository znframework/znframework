<?php namespace ZN\Services\Request;

use ZN\Core\Structure;
use Arrays, Config, Errors, Controller, Http;

class InternalRoute extends Controller implements InternalRouteInterface
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
    // Pattern Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $patternType = 'special';

    //--------------------------------------------------------------------------------------------------------
    // Change
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $route
    //
    //--------------------------------------------------------------------------------------------------------
    public function change(Array $route, String $type = 'special') : InternalRoute
    {
        $this->route      = $route;
        $this->paternType = $type;

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
    public function run(String $functionName, Callable $functionRun = NULL, Array $route = NULL, String $type = NULL)
    {
        if( ! empty($this->route) )
        {
            $route = $this->route;
        }

        if( ! empty($route) )
        {
            Config::set('Services', 'route', ['changeUri' => $route, 'patternType' => $type ?? $this->patternType]);
        }

        $datas      = Structure::data();
        $parameters = $datas['parameters'];
        $isFile     = $datas['file'];
        $function   = $datas['function'];

        if( Arrays::valueExists(['construct', 'destruct'], $functionName) )
        {
            call_user_func_array($functionRun, $parameters);
        }

        if( is_file($isFile) )
        {
            if( $functionName === $function )
            {
                if( Http::isRequestMethod(...$this->method) === false )
                {
                    $this->redirectInvalidRequest();
                }

                call_user_func_array($functionRun, $parameters);

                $this->_defaultVariable();

                exit;
            }
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
    // Protected Default Variable -> 4.3.1
    //--------------------------------------------------------------------------------------------------------
    //
    //  @return void
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _defaultVariable()
    {
        $this->route       = [];
        $this->method      = [];
        $this->patternType = 'special';
    }
}
