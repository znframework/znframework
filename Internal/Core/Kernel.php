<?php
//--------------------------------------------------------------------------------------------------
// Kernel
//--------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------
// Structure Data
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan kontrolcü dosyasının yol bilgisi.
//
//--------------------------------------------------------------------------------------------------
$datas      = ZN\Core\Structure::data();

$parameters = $datas['parameters'];
$page       = $datas['page'];
$isFile     = $datas['file'];
$function   = $datas['function'];
$namespace  = $datas['namespace'];

//--------------------------------------------------------------------------------------------------
// CURRENT_CFILE
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan kontrolcü dosyasının yol bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CFILE', $isFile);

//--------------------------------------------------------------------------------------------------
// CURRENT_CFUNCTION
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait fonksiyon bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CFUNCTION', $function);

//--------------------------------------------------------------------------------------------------
// CURRENT_CPAGE
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü dosyasının ad bilgisini.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CPAGE', $page . '.php');

//--------------------------------------------------------------------------------------------------
// CURRENT_CONTROLLER
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CONTROLLER', $page);

//--------------------------------------------------------------------------------------------------
// CURRENT_CNAMESPACE
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait namespace bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CNAMESPACE', $namespace);

//--------------------------------------------------------------------------------------------------
// CURRENT_CNAMESPACE
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait namespace bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CCLASS', $namespace . CURRENT_CONTROLLER);

//--------------------------------------------------------------------------------------------------
// CURRENT_CPATH
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon yolu   bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CFPATH', str_replace(CONTROLLERS_DIR, '', CURRENT_CONTROLLER).'/'.CURRENT_CFUNCTION);

//--------------------------------------------------------------------------------------------------
// CURRENT_CFURI
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon yolu   bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CFURI', CURRENT_CFPATH);

//--------------------------------------------------------------------------------------------------
// CURRENT_CPATH
//--------------------------------------------------------------------------------------------------
//
// @return Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon URL yol bilgisi.
//
//--------------------------------------------------------------------------------------------------
define('CURRENT_CFURL', siteUrl(CURRENT_CFPATH));

//--------------------------------------------------------------------------------------------------------
// Starting Controllers
//--------------------------------------------------------------------------------------------------------
if( $startController = Config::get('Starting', 'controller') )
{
    if( is_string($startController) )
    {
        internalStartingContoller($startController);
    }
    elseif( is_array($startController) )
    {
        foreach( $startController as $key => $val )
        {
            if( is_numeric($key) )
            {
                internalStartingContoller($val);
            }
            else
            {
                internalStartingContoller($key, $val);
            }
        }
    }
}
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// SAYFA KONTROLÜ YAPILIYOR...
//--------------------------------------------------------------------------------------------------------
//  Sayfa bilgisine erişilmişse sayfa dahil edilir.
//--------------------------------------------------------------------------------------------------------
if( is_file($isFile) )
{
    import($isFile);

    if( ! class_exists($page, false) )
    {
        $page = $namespace.$page;
    }

    if( class_exists($page, false) )
    {
        if( strtolower($function) === 'index' && ! is_callable([$page, $function]) )
        {
            $function = 'main';
        }

        if( is_callable([$page, $function]) )
        {
            try
            {
                uselib($page)->$function(...$parameters);
            }
            catch( \Throwable $e )
            {
                if( PROJECT_MODE !== 'publication' )
                {
                    \Exceptions::table($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace());
                }
            }
        }
        else
        {
            if( $routeShow404 = Config::get('Services', 'route')['show404'] )
            {
                redirect($routeShow404);
            }
            else
            {
                report('Error', lang('Error', 'callUserFuncArrayError', $function), 'SystemCallUserFuncArrayError');

                die(Errors::message('Error', 'callUserFuncArrayError', $function));
            }
        }
    }
}
else
{
    if( $routeShow404 = Config::get('Services', 'route')['show404'] )
    {
        redirect($routeShow404);
    }
    else
    {
        report('Error', lang('Error', 'notFoundController', CURRENT_CONTROLLER), 'SystemNotFoundControllerError');

        die(Errors::message('Error', 'notFoundController', CURRENT_CONTROLLER));
    }
}

//--------------------------------------------------------------------------------------------------------
// Restore Error Handler
//--------------------------------------------------------------------------------------------------------
//
// @mode = 'publication'
//
//--------------------------------------------------------------------------------------------------------
if( PROJECT_MODE !== 'publication' )
{
    restore_error_handler();
}
else
{
    if(  Config::get('General', 'log')['createFile'] === true && $errorLast = Errors::last() )
    {
        $lang    = lang('Templates');
        $message = $lang['line']   .':'.$errorLast['line'].', '.
                   $lang['file']   .':'.$errorLast['file'].', '.
                   $lang['message'].':'.$errorLast['message'];

        report('GeneralError', $message, 'GeneralError');
    }
}

//--------------------------------------------------------------------------------------------------------
// Ob End Flush
//--------------------------------------------------------------------------------------------------------
//
// Tampon kapatılıyor.
//
//--------------------------------------------------------------------------------------------------------
ob_end_flush();
