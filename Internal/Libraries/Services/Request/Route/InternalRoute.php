<?php namespace ZN\Services\Request;

use ZN\Core\Structure;
use Config, Errors, Controller;

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
    public function run(String $functionName, $functionRun = NULL, Array $route = NULL)
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

        if( ( $functionName === 'construct' || $functionName === 'destruct' ) && is_callable($functionRun) )
        {
            call_user_func_array($functionRun, $parameters);
        }

        if( file_exists($isFile) )
        {
            if( strtolower($function) ===  'index' && strtolower($functionName) === 'main')
            {
                $function = 'main';
            }

            if( $functionName === $function )
            {
                if( is_callable($functionRun) )
                {
                    call_user_func_array($functionRun, $parameters);
                }
                else
                {
                    // Sayfa bilgisine erişilemezse hata bildir.
                    if( ! $routeShow404 = Config::get('Services', 'route')['show404'] )
                    {
                        // Hatayı rapor et.
                        report('Error', lang('Error', 'callUserFuncArrayError'), 'SystemCallUserFuncArrayError');

                        // Hatayı ekrana yazdır.
                        die(Errors::message('Error', 'callUserFuncArrayError', $functionRun));
                    }
                    else
                    {
                        redirect($routeShow404);
                    }
                }
            }
        }
    }
}
