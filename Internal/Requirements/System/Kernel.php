<?php namespace ZN\Core;

use Arrays, Import, Route, Throwable, Exceptions, Config, Errors, Generate, Folder, File, Restoration, URL, Lang, IS;

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
        if( $autoloaderAliases = Config::get('Autoloader')['aliases'] ) foreach( $autoloaderAliases as $alias => $origin )
        {
            class_alias($origin, $alias);
        }

        $appcon = Config::get('Project');

        if( empty($appcon) )
        {
            trace('["Container"] Not Found! Check the [\'containers\'] setting in the [Projects/Projects.php] file.');
        }

        define('PROJECT_MODE', strtolower($appcon['mode']));

        \ZN\In::projectMode(PROJECT_MODE, $appcon['errorReporting']);

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
            \ZN\In::createHtaccessFile();
        }

        if( Config::get('Robots','createFile') === true )
        {
            \ZN\In::createRobotsFile();
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

        if( Lang::current() )
        {
            $langFix = str_ireplace([suffix((string) illustrate('_CURRENT_PROJECT'))], '', server('currentPath'));
            $langFix = explode('/', $langFix)[1] ?? NULL;

            if( strlen($langFix) === 2 )
            {
                Lang::set($langFix);
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
                    \Logger::report('Error', \Lang::select('Error', 'fileNotFound', $path) ,'AutoloadComposer');

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

                \Logger::report('Error', \Lang::select('Error', 'fileNotFound', $path) ,'AutoloadComposer');

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
                if( File::extension($file) === 'php' )
                {
                    if( is_file($file) )
                    {
                        import($file);
                    }
                }
            }

            if( ! empty($commonStartingAutoload) ) foreach( $commonStartingAutoload as $file )
            {
                if( File::extension($file) === 'php' )
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

        \ZN\In::invalidRequest('disallowMethods', true);
        \ZN\In::invalidRequest('allowMethods', false);
        \ZN\In::startingConfig('controller');

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
        $isFile       = CURRENT_CFILE;
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
                        if( ! $viewNameType = Config::get('ViewObjects', 'viewNameType') )
                        {
                            $viewNameType = 'file';
                        }

                        if( $viewNameType === 'file' )
                        {
                            $viewFunction = $function === $openFunction ? NULL : '-' . $function;
                            $viewDir      = PAGES_DIR . $view . $viewFunction;
                        }
                        else
                        {
                            $viewFunction = $function === $openFunction ? $openFunction : $function;
                            $viewDir      = PAGES_DIR . $view . DS . $viewFunction;
                        }

                        $viewPath   = $viewDir  . '.php';
                        $wizardPath = $viewDir  . '.wizard.php';

                        $pageClass = uselib($page);

                        $pageClass->$function(...$parameters);

                        if( is_file($wizardPath) && ! IS::import($viewPath) && ! IS::import($wizardPath) )
                        {
                            $data = (array) ( ! empty((array) $pageClass->wizard) ? $pageClass->wizard : $pageClass->view );
                            $usableView = Import::view(str_replace(PAGES_DIR, NULL, $wizardPath), $data, true);
                        }
                        elseif( is_file($viewPath) && ! IS::import($viewPath) && ! IS::import($wizardPath) )
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
        \ZN\In::startingConfig('destruct');

        if( PROJECT_MODE !== 'publication' )
        {
            restore_error_handler();
        }
        else
        {
            if(  Config::get('General', 'log')['createFile'] === true && $errorLast = Errors::last() )
            {
                $lang    = \Lang::select('Templates');
                $message = $lang['line']   .':'.$errorLast['line'].', '.
                           $lang['file']   .':'.$errorLast['file'].', '.
                           $lang['message'].':'.$errorLast['message'];

                \Logger::report('GeneralError', $message, 'GeneralError');
            }
        }

        ob_end_flush();
    }
}
