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
    //
    //--------------------------------------------------------------------------------------------------------
    public function change(Array $route) : InternalRoute;

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
    public function run(String $functionName, $functionRun, Array $route = NULL);

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
