<?php namespace ZN\Core;

use Arrays, Import, Route, Throwable, Exceptions, Config, Errors;
use Generate, Folder, File, Restoration, URL, Lang, IS;
use View, Masterpage, ZN\In, Logger, Http;

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
            trace('["Container"] Not Found! Check the [\'containers\'] setting in the [Settings/Projects.php] file.');
        }

        define('PROJECT_MODE', strtolower($appcon['mode']));

        In::projectMode(PROJECT_MODE, $appcon['errorReporting']);

        if( Config::get('Htaccess', 'cache')['obGzhandler'] && substr_count(server('acceptEncoding'), 'gzip') )
        {
            ob_start('ob_gzhandler');
        }
        else
        {
            ob_start();
        }

        headers(Config::get('Project', 'headers'));

        if( IS::timeZone($timezone = Config::get('DateTime', 'timeZone')) )
        {
            date_default_timezone_set($timezone);
        }

        if( PROJECT_MODE !== 'publication' )
        {
            set_error_handler('Exceptions::table');
        }

        //--------------------------------------------------------------------------------------------------
        // Middle Top Layer
        //--------------------------------------------------------------------------------------------------
        layer('MiddleTop');
        //--------------------------------------------------------------------------------------------------

        if( $iniSet = Config::get('Htaccess', 'ini')['settings'] )
        {
            Config::iniSet($iniSet);
        }

        if( Config::get('Htaccess','createFile') === true )
        {
            In::createHtaccessFile();
        }

        if( Config::get('Robots','createFile') === true )
        {
            In::createRobotsFile();
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
                    Logger::report('Error', Lang::select('Error', 'fileNotFound', $path) ,'AutoloadComposer');

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

                Logger::report('Error', Lang::select('Error', 'fileNotFound', $path) ,'AutoloadComposer');

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

        In::invalidRequest('disallowMethods', true);
        In::invalidRequest('allowMethods', false);
        In::startingConfig('controller');
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
        self::start();

        //----------------------------------------------------------------------------------------------
        // Middle Layer
        //----------------------------------------------------------------------------------------------
        layer('Middle');
        //----------------------------------------------------------------------------------------------

        $parameters   = CURRENT_CPARAMETERS;
        $page         = CURRENT_CONTROLLER;
        $function     = CURRENT_CFUNCTION;
        $openFunction = CURRENT_COPEN_PAGE;

        if( is_file(CURRENT_CFILE) )
        {
            import(CURRENT_CFILE);

            $view = $page;

            if( ! class_exists($page, false) )
            {
                $page = CURRENT_CNAMESPACE . $page;
            }

            if( class_exists($page, false) )
            {
                if( ! is_callable([$page, $function]) )
                {
                    $parameters = Arrays::addFirst($parameters, $function);
                    $function   = $openFunction;
                }

                if( is_callable([$page, $function]) )
                {
                    try
                    {
                        self::viewPathFinder($function, $viewPath, $wizardPath);

                        $pageClass = uselib($page);

                        $pageClass->$function(...$parameters);

                        self::viewAutoload($wizardPath, $viewPath, (array) $pageClass->view, (array) $pageClass->masterpage);
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

        //----------------------------------------------------------------------------------------------
        // Middle Bottom Layer
        //----------------------------------------------------------------------------------------------
        layer('MiddleBottom');
        //----------------------------------------------------------------------------------------------

        self::end();
    }

    //--------------------------------------------------------------------------------------------------
    // View Path Finder
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $function
    // @param string &$viewPath
    // @param string &$wizardPath
    //
    //--------------------------------------------------------------------------------------------------
    public static function viewPathFinder($function, &$viewPath, &$wizardPath)
    {
        if( ! $viewNameType = Config::get('ViewObjects', 'viewNameType') )
        {
            $viewNameType = 'file';
        }

        if( $viewNameType === 'file' )
        {
            $viewFunction = $function === CURRENT_COPEN_PAGE ? NULL : '-' . $function;
            $viewDir      = self::_view($viewFunction);
        }
        else
        {
            $viewFunction = $function === CURRENT_COPEN_PAGE ? CURRENT_COPEN_PAGE : $function;
            $viewDir      = self::_view(DS . $viewFunction);
        }

        $viewPath   = $viewDir . '.php';
        $wizardPath = $viewDir . '.wizard.php';
    }

    //--------------------------------------------------------------------------------------------------
    // View Path Finder -> 5.3.62
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $function
    // @param string $openFunction
    // @param string $view
    //
    //--------------------------------------------------------------------------------------------------
    public static function viewAutoload($wizardPath, $viewPath, $data, $pageClassMasterpage)
    {
        // 5.3.62[added]|5.3.77[edited]
        if( Config::get('ViewObjects', 'ajaxCodeContinue') === false && Http::isAjax() )
        {
            return;
        }

        if( is_file($wizardPath) && ! IS::import($viewPath) && ! IS::import($wizardPath) )
        {
            $usableView = self::_load($wizardPath, $data);
        }
        elseif( is_file($viewPath) && ! IS::import($viewPath) && ! IS::import($wizardPath) )
        {
            $usableView = self::_load($viewPath, $data);
        }

        if( ! empty($masterpageData = In::$masterpage) )
        {
            $inData = array_merge(...$masterpageData);
        }
        else
        {
            $inData = [];
        }

        $data = array_merge((array) $pageClassMasterpage, $inData, Masterpage::$data);

        if( ($data['masterpage'] ?? NULL) === true || ! empty($data) )
        {
            Import::headData($data)->bodyContent($usableView ?? '')->masterpage($data);
        }
        elseif( ! empty($usableView) )
        {
            echo $usableView;
        }
    }

    public static function end()
    {
        In::startingConfig('destruct');

        //----------------------------------------------------------------------------------------------
        // Bottom Top Layer
        //----------------------------------------------------------------------------------------------
        layer('BottomTop');
        //----------------------------------------------------------------------------------------------

        if( PROJECT_MODE !== 'publication' )
        {
            restore_error_handler();
        }
        else
        {
            if(  Config::get('Project', 'log')['createFile'] === true && $errorLast = Errors::last() )
            {
                $lang    = Lang::select('Templates');
                $message = $lang['line']   .':'.$errorLast['line'].', '.
                           $lang['file']   .':'.$errorLast['file'].', '.
                           $lang['message'].':'.$errorLast['message'];

                Logger::report('GeneralError', $message, 'GeneralError');
            }
        }

        ob_end_flush();
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static View -> 5.2.73
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $view
    // @param strnig $fix
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _view($fix)
    {
        $view = CURRENT_CONTROLLER;

        if( $subdir = STRUCTURE_DATA['subdir'] )
        {
            $view = $subdir;
        }

        return PAGES_DIR . $view . $fix;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Load
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $path
    // @param array  $data
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _load($path, $data)
    {
        return Import::view(str_replace(PAGES_DIR, NULL, $path), $data, true);
    }
}
