<?php
//--------------------------------------------------------------------------------------------------------
// Kernel
//--------------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// URI Datas
//--------------------------------------------------------------------------------------------------------
//  Get URI Datas
//--------------------------------------------------------------------------------------------------------
$parameters   = CURRENT_CPARAMETERS;
$page         = CURRENT_CONTROLLER;
$isFile       = CURRENT_CFILE;
$function     = CURRENT_CFUNCTION;
$openFunction = CURRENT_COPEN_PAGE;
$namespace    = CURRENT_CNAMESPACE;
//--------------------------------------------------------------------------------------------------------

//--------------------------------------------------------------------------------------------------------
// Running Controller
//--------------------------------------------------------------------------------------------------------
//  Running Controller
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
                    $data = ! empty((array) $pageClass->wizard) ? $pageClass->wizard : $pageClass->view;

                    Import::view(str_replace(PAGES_DIR, NULL, $wizardPath), (array) $data);
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
