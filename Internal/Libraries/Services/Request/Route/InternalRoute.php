<?php namespace ZN\Services\Request;

use ZN\Core\Structure;
use Arrays, Config, Errors, Controller;

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
    // Route
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $route = [];

    //--------------------------------------------------------------------------------------------------------
    // Change
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $route
    //
    //--------------------------------------------------------------------------------------------------------
    public function change(Array $route) : InternalRoute
    {
        $this->route = $route;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------------
    // Genel Kullanım: Çalıştırılmak istenen kod bloklarını yönetmek için kullanılır.
    //
    //  @param  string   $functionName
    //  @param  function $functionRun
    //  @return mixed
    //
    //--------------------------------------------------------------------------------------------------------
    public function run(String $functionName, Callable $functionRun = NULL, Array $route = NULL)
    {
        if( ! empty($this->route) )
        {
            $route = $this->route;
        }

        if( ! empty($route) )
        {
            Config::set('Services', 'route', ['changeUri' => $route]);
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
                call_user_func_array($functionRun, $parameters);
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Redirect Show 404 -> 4.2.7
    //--------------------------------------------------------------------------------------------------------
    //
    //  @param  string $function
    //  @param  string $lang
    //  @param  string $report
    //  @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function redirectShow404(String $function, String $lang = 'callUserFuncArrayError', String $report = 'SystemCallUserFuncArrayError')
    {
        // Sayfa bilgisine erişilemezse hata bildir.
        if( ! $routeShow404 = Config::get('Services', 'route')['show404'] )
        {
            // Hatayı rapor et.
            report('Error', lang('Error', $lang), $report);

            // Hatayı ekrana yazdır.
            die(Errors::message('Error', $lang, $function));
        }
        else
        {
            redirect($routeShow404);
        }
    }
}
