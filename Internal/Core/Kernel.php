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
$datas        = ZN\Core\Structure::data();

$parameters   = $datas['parameters'];
$page         = $datas['page'];
$isFile       = $datas['file'];
$function     = $datas['function'];
$openFunction = $datas['openFunction'];
$namespace    = $datas['namespace'];

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
// Invalid Request Page
//--------------------------------------------------------------------------------------------------------
$invalidRequest = Config::get('Services', 'route')['invalidRequest'];

if( $invalidRequest['control'] === true && Http::isInvalidRequest() )
{
    if( ! in_array(strtolower(CURRENT_CFURI), array_map('strtolower', $invalidRequest['allowPages'])) )
    {
        if( empty($invalidRequest['page']) )
        {
            trace(lang('Error', 'invalidRequest'));
        }

        redirect($invalidRequest['page']);
    }
}
//--------------------------------------------------------------------------------------------------------

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

    $view = $page;

    if( ! class_exists($page, false) )
    {
        $page = $namespace.$page;
    }

    if( class_exists($page, false) )
    {
        if( ! is_callable([$page, $function]) )
        {
            $parameters   = Arrays::addFirst($parameters, $function);
            $function     = $openFunction;
        }

        if( is_callable([$page, $function]) )
        {
            try
            {
                $viewFunction = $function === $openFunction ? NULL : '-'.$function;
                $pageClass    = uselib($page);

                $pageClass->$function(...$parameters);

                $viewDir    = PAGES_DIR . $view . $viewFunction;
                $viewPath   = $viewDir  . '.php';
                $wizardPath = $viewDir  . '.wizard.php';

                if( ! empty($data = (array) $pageClass->masterpage) )
                {
                    Config::set('Masterpage', $data);

                    Import::masterpage($data);
                }
                elseif( is_file($wizardPath) && ! isImport($viewPath) && ! isImport($wizardPath) )
                {
                    Import::view(str_replace(PAGES_DIR, NULL, $wizardPath), (array) $pageClass->wizard);
                }
                elseif( is_file($viewPath) && ! isImport($viewPath) && ! isImport($wizardPath) )
                {
                    Import::view(str_replace(PAGES_DIR, NULL, $viewPath), (array) $pageClass->view);
                }

            }
            catch( Throwable $e )
            {
                if( PROJECT_MODE !== 'publication' )
                {
                    Exceptions::table($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace());
                }
            }
        }
        else
        {
            Route::redirectShow404($function);
        }
    }
}
else
{
    Route::redirectShow404(CURRENT_CONTROLLER, 'notFoundController', 'SystemNotFoundControllerError');
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
