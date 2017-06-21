<?php namespace ZN\Core;

use Arrays, Import, Route, Throwable, Exceptions, Config, Errors, Generate, Folder, Restoration;

class Kernel
{
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------

    public static function start()
    {
        define('BASE_URL', baseUrl());
        define('SITE_URL', siteUrl());
        define('CURRENT_URL', currentUrl());
        define('PREV_URL', prevUrl());
        define('HOST_URL', hostUrl());
        define('BASE_PATH', basePath());
        define('CURRENT_PATH', currentPath());
        define('PREV_PATH', prevPath());
        define('HOST', host());
        define('HOST_NAME', HOST);
        define('FILES_URL'    , baseUrl(FILES_DIR    ));
        define('FONTS_URL'    , baseUrl(FONTS_DIR    ));
        define('PLUGINS_URL'  , baseUrl(PLUGINS_DIR  ));
        define('SCRIPTS_URL'  , baseUrl(SCRIPTS_DIR  ));
        define('STYLES_URL'   , baseUrl(STYLES_DIR   ));
        define('THEMES_URL'   , baseUrl(THEMES_DIR   ));
        define('UPLOADS_URL'  , baseUrl(UPLOADS_DIR  ));
        define('RESOURCES_URL', baseUrl(RESOURCES_DIR));

        if( Config::get('IndividualStructures', 'cache')['obGzhandler'] && substr_count(server('acceptEncoding'), 'gzip') )
        {
            ob_start('ob_gzhandler');
        }
        else
        {
            ob_start();
        }

        headers(Config::get('General', 'headers'));

        if( PROJECT_MODE !== 'publication' )
        {
            set_error_handler('Exceptions::table');
        }

        if( $iniSet = Config::get('Htaccess', 'ini')['settings'] )
        {
            Config::iniSet($iniSet);
        }

        if( Config::get('Htaccess','createFile') === true )
        {
            internalCreateHtaccessFile();
        }

        if( Config::get('Robots','createFile') === true )
        {
            internalCreateRobotsFile();
        }

        $generateConfig = Config::get('FileSystem', 'generate');

        if( $generateConfig['databases'] === true )
        {
            Generate::databases();
        }

        if( $grandVision = $generateConfig['grandVision'] )
        {
            $databases = is_array($grandVision) ? $grandVision : NULL;

            Generate::grandVision($databases);
        }

        if( currentLang() )
        {
            $langFix = str_ireplace([suffix((string) illustrate('_CURRENT_PROJECT'))], '', server('currentPath'));
            $langFix = explode('/', $langFix)[1] ?? NULL;

            if( strlen($langFix) === 2 )
            {
                setLang($langFix);
            }
        }

        if( $composer = Config::get('Autoloader', 'composer') )
        {
            $path = 'vendor/autoload.php';

            if( $composer === true )
            {
                if( file_exists($path) )
                {
                    import($path);
                }
                else
                {
                    report('Error', lang('Error', 'fileNotFound', $path) ,'AutoloadComposer');

                    die(Errors::message('Error', 'fileNotFound', $path));
                }
            }
            elseif( is_file($composer) )
            {
                require_once($composer);
            }
            else
            {
                $path = suffix($composer) . $path;

                report('Error', lang('Error', 'fileNotFound', $path) ,'AutoloadComposer');

                die(Errors::message('Error', 'fileNotFound', $path));
            }
        }

        $starting = Config::get('Starting');

        if( $starting['autoload']['status'] === true )
        {
            $startingAutoload       = Folder::allFiles(AUTOLOAD_DIR, $starting['autoload']['recursive']);
            $commonStartingAutoload = Folder::allFiles(EXTERNAL_AUTOLOAD_DIR, $starting['autoload']['recursive']);

            if( ! empty($startingAutoload) ) foreach( $startingAutoload as $file )
            {
                if( extension($file) === 'php' )
                {
                    if( is_file($file) )
                    {
                        import($file);
                    }
                }
            }

            if( ! empty($commonStartingAutoload) ) foreach( $commonStartingAutoload as $file )
            {
                if( extension($file) === 'php' )
                {
                    $commonIsSameExistsFile = str_ireplace(EXTERNAL_AUTOLOAD_DIR, AUTOLOAD_DIR, $file);

                    if( ! is_file($commonIsSameExistsFile) && is_file($file) )
                    {
                        import($file);
                    }
                }
            }
        }

        if( ! empty($starting['handload']) )
        {
            Import::handload(...$starting['handload']);
        }

        if( PROJECT_MODE === 'restoration' )
        {
            Restoration::mode();
        }

        Route::filter();

        internalInvalidRequest('disallowMethods', true);
        internalInvalidRequest('allowMethods', false);
        internalStartingConfig('controller');

        return new self;
    }

    //--------------------------------------------------------------------------------------------------
    // Run
    //--------------------------------------------------------------------------------------------------
    //
    // Run kernel
    //
    //--------------------------------------------------------------------------------------------------
    public static function run()
    {
        $parameters   = CURRENT_CPARAMETERS;
        $page         = CURRENT_CONTROLLER;
         $isFile      = CURRENT_CFILE;
        $function     = CURRENT_CFUNCTION;
        $openFunction = CURRENT_COPEN_PAGE;
        $namespace    = CURRENT_CNAMESPACE;

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

                        if( is_file($wizardPath) && ! isImport($viewPath) && ! isImport($wizardPath) )
                        {
                            $data = (array) ( ! empty((array) $pageClass->wizard) ? $pageClass->wizard : $pageClass->view );
                            $usableView = Import::view(str_replace(PAGES_DIR, NULL, $wizardPath), $data, true);
                        }
                        elseif( is_file($viewPath) && ! isImport($viewPath) && ! isImport($wizardPath) )
                        {
                            $data = (array) $pageClass->view;
                            $usableView = Import::view(str_replace(PAGES_DIR, NULL, $viewPath), $data, true);
                        }

                        if( ($data['masterpage'] ?? NULL) === true || ! empty($data = (array) $pageClass->masterpage) )
                        {
                            Import::headData($data)->bodyContent($usableView ?? '')->masterpage($data);
                        }
                        elseif( ! empty($usableView) )
                        {
                            echo $usableView;
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

        return new self;
    }

    public static function end()
    {
        internalStartingConfig('destruct');

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

        ob_end_flush();
    }
}
