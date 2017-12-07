<?php namespace ZN\Core;

use ZN\In;
use ZN\Helpers\Logger;
use ZN\FileSystem\File;
use ZN\FileSystem\Folder;
use ZN\IndividualStructures\IS;
use ZN\IndividualStructures\Lang;
use ZN\IndividualStructures\Import;
use GeneralException;
use ZN\ErrorHandling\Errors;
use ZN\ErrorHandling\Exceptions;

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
        set_error_handler('ZN\ErrorHandling\Exceptions::table');
        
        if( $autoloaderAliases = \Config::get('Autoloader')['aliases'] ) foreach( $autoloaderAliases as $alias => $origin )
        {
            class_alias($origin, $alias);
        }

        $appcon = \Config::get('Project');

        if( empty($appcon) ) trace('["Container"] Not Found! Check the [\'containers\'] setting in the [Settings/Projects.php] file.');

        define('PROJECT_MODE', strtolower($appcon['mode']));

        In::projectMode(PROJECT_MODE, $appcon['errorReporting']);

        $htaccessConfig = \Config::get('Htaccess');

        if( $htaccessConfig['cache']['obGzhandler'] && substr_count(server('acceptEncoding'), 'gzip') )
        {
            ob_start('ob_gzhandler');
        }
        else
        {
            ob_start();
        }
        
        headers(\Config::get('Project', 'headers'));

        if( IS::timeZone($timezone = \Config::get('DateTime', 'timeZone')) ) date_default_timezone_set($timezone);
        
        //--------------------------------------------------------------------------------------------------
        // Middle Top Layer
        //--------------------------------------------------------------------------------------------------
        layer('MiddleTop');
        //--------------------------------------------------------------------------------------------------

        if( $iniSet = $htaccessConfig['ini']['settings'] ) \Config::iniSet($iniSet);
        if( \Config::htaccess('createFile') === true ) In::createHtaccessFile();
        if( \Config::robots  ('createFile') === true ) In::createRobotsFile();

        $generateConfig = \Config::get('FileSystem', 'generate');

        if( $generateConfig['databases'] === true ) \Generate::databases();

        if( $grandVision = $generateConfig['grandVision'] )
        {
            $databases = is_array($grandVision) ? $grandVision : NULL;

            \Generate::grandVision($databases);
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

        if( $composer = \Config::get('Autoloader', 'composer') ) self::_composer($composer);
        if( ($starting = \Config::get('Starting'))['autoload']['status'] === true ) self::_starting($starting);
        if( ! empty($starting['handload']) ) Import\Handload::use(...$starting['handload']);
        if( PROJECT_MODE === 'restoration' ) \Restoration::mode();

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
                    array_unshift($parameters, $function);
                    
                    $function = $openFunction;
                }

                if( is_callable([$page, $function]) )
                {     
                    self::viewPathFinder($function, $viewPath, $wizardPath);

                    $pageClass = uselib($page);

                    $pageClass->$function(...$parameters);

                    self::viewAutoload($wizardPath, $viewPath, (array) $pageClass->view, (array) $pageClass->masterpage);          
                }
                else
                {
                    \Route::redirectShow404($function);
                }
            }
        }
        else
        {
            \Route::redirectShow404(CURRENT_CONTROLLER, 'notFoundController', 'SystemNotFoundControllerError');
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
        $viewNameType = \Config::get('ViewObjects', 'viewNameType') ?: 'file';

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
        if( \Config::get('ViewObjects', 'ajaxCodeContinue') === false && \Http::isAjax() )
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

        $data = array_merge((array) $pageClassMasterpage, $inData, \Masterpage::$data);

        if( ($data['masterpage'] ?? NULL) === true || ! empty($data) )
        {
            (new Import\Masterpage)->headData($data)->bodyContent($usableView ?? '')->use($data);
        }
        elseif( ! empty($usableView) )
        {
            echo $usableView;
        }
    }
    
    //--------------------------------------------------------------------------------------------------
    // End
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    public static function end()
    {
        In::startingConfig('destruct');

        //----------------------------------------------------------------------------------------------
        // Bottom Top Layer
        //----------------------------------------------------------------------------------------------
        layer('BottomTop');
        //----------------------------------------------------------------------------------------------

        if( \Config::get('Project', 'log')['createFile'] === true && $errorLast = Errors::last() )
        {
            $lang    = Lang::select('Templates');
            $message = $lang['line']   .':'.$errorLast['line'].', '.
                       $lang['file']   .':'.$errorLast['file'].', '.
                       $lang['message'].':'.$errorLast['message'];

            Logger::report('GeneralError', $message, 'GeneralError');
        }

        restore_error_handler();

        ob_end_flush();
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Starting Autoload -> 5.4.5|5.4.52[edited]
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _starting($starting)
    {   
        $autoloadRecursive = $starting['autoload']['recursive'];

        $startingAutoload  = array_merge
        (
            Folder\FileList::allFiles(AUTOLOAD_DIR         , $autoloadRecursive), 
            Folder\FileList::allFiles(EXTERNAL_AUTOLOAD_DIR, $autoloadRecursive)
        );

        if( ! empty($startingAutoload) ) foreach( $startingAutoload as $file )
        {
            if( File\Extension::get($file) === 'php' )
            {
                if( is_file($file) )
                {
                    import($file);
                }
            }
        }
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Composer -> 5.4.5
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _composer($composer)
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

                throw new GeneralException('Error', 'fileNotFound', $path);
            }
        }
        elseif( is_file($composer) )
        {
            import($composer);
        }
        else
        {
            $path = suffix($composer) . $path;

            Logger::report('Error', Lang::select('Error', 'fileNotFound', $path) ,'AutoloadComposer');

            throw new GeneralException('Error', 'fileNotFound', $path);
        }
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
        return Import\View::use(str_replace(PAGES_DIR, NULL, $path), $data, true);
    }
}
