<?php namespace ZN\Services\Request;

interface InternalRouteInterface
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
    // Change
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $route
    // @param string $type = 'special' Available Options: special, classic
    //
    //--------------------------------------------------------------------------------------------------------
    public function change(Array $route, String $type = 'special') : InternalRoute;

    //--------------------------------------------------------------------------------------------------------
    // Method 404 -> 4.3.1
    //--------------------------------------------------------------------------------------------------------
    //
    //  @param  variadic ...$function
    //  @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function method(...$methods) : InternalRoute;

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
    public function run(String $functionName, Callable $functionRun = NULL, Array $route = NULL, String $type = NULL);

    //--------------------------------------------------------------------------------------------------------
    // Redirect Show 404
    //--------------------------------------------------------------------------------------------------------
    //
    //  @param  string $function
    //  @param  string $lang
    //  @param  string $report
    //  @return void
    //
    //--------------------------------------------------------------------------------------------------------
    public function redirectShow404(String $function, String $lang = 'callUserFuncArrayError', String $report = 'SystemCallUserFuncArrayError');
}
