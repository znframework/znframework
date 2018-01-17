<?php namespace ZN;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\ErrorHandling\Errors;
use ZN\Inclusion\Project\Theme;
use ZN\ErrorHandling\Exceptions;
use ZN\Inclusion\Project\Masterpage;

class Kernel
{
    /**
     * The system initializes the kernel.
     * 
     * @param void
     * 
     * @return void
     */
    public static function start()
    {  
        # If the use of alias is obvious, it will activate this operation.
        if( $autoloaderAliases = Config::get('Autoloader')['aliases'] ) foreach( $autoloaderAliases as $alias => $origin )
        {
            if( class_exists($origin) )
            {
                class_alias($origin, $alias);
            }
        }
        
        $appcon = Config::get('Project');

        if( empty($appcon) ) 
        {
            Base::trace('["Container"] Not Found! Check the [\'containers\'] setting in the [Settings/Projects.php] file.');
        }

        define('PROJECT_MODE', strtolower($appcon['mode']));

        # Activates the project mode.
        In::projectMode(PROJECT_MODE, $appcon['errorReporting']);

        if( PROJECT_MODE !== 'publication' ) 
        {
            Exceptions::handler(); Errors::handler();
        }

        # Enables the ob_gzhandler method if it is turned on.
        $htaccess = Config::get('Htaccess');

        # OB process is starting.
        if( $htaccess['cache']['obGzhandler'] && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'] ?? NULL, 'gzip') )
        {
            ob_start('ob_gzhandler');
        }
        else
        {
            ob_start();
        }

        # Session process is starting.
        session_start();
        
        # Sends defined header information.
        Base::headers(Config::get('Project', 'headers'));

        if( IS::timeZone($timezone = Config::get('DateTime', 'timezone')) ) date_default_timezone_set($timezone);
        
        # The codes to be written to this layer will run just before the kernel comes into play. 
        # However, htaccess is enabled after Autoloder and Header configurations.
        Base::layer('MiddleTop');
        
        # Enables defined ini configurations.
        if( $iniset = Config::get('Ini') )
        {
            Config::iniset($iniset);
        } 

        # The software apache and htaccess allow 
        # the .htaccess file to be rearranged according to the changes 
        # if the file is open for writing.
        if( $htaccess['createFile'] === true )
        {
            Htaccess::create($htaccess);
        }      
        
        # Enables processing of changes to the robots.txt file if it is open.
        if( Config::robots ('createFile') === true )
        {
            In::createRobotsFile();
        }   
        
        # Sets the system's language.
        if( Lang::current() )
        {
            $langFix = str_ireplace([Base::suffix((string) Base::illustrate('_CURRENT_PROJECT'))], '', Base::currentPath());
            $langFix = explode('/', $langFix)[1] ?? NULL;

            if( strlen($langFix) === 2 )
            {
                Lang::set($langFix);
            }
        }

        # Configures the use of Composer autoloader.
        if( $composer = Config::get('Autoloader', 'composer') ) 
        {
            self::_composer($composer);
        }
        
        # If the setting is active, it loads the startup files.
        if( ($starting = Config::get('Starting'))['autoload']['status'] === true ) 
        {
            self::_starting($starting);
        }
        
        # If the project mode restoration is set, restoration is started.
        if( PROJECT_MODE === 'restoration' ) 
        {
            Restoration::mode();
        }
        
        # It checks for invalid requests.
        In::invalidRequest('disallowMethods', true);
        In::invalidRequest('allowMethods', false);

        # Configures the startup controller setting.
        In::startingConfig('controller');
    }

    /**
     * Run the system kernel.
     * 
     * @param void
     * 
     * @return void
     */
    public static function run()
    {
        # The kernel is starting.
        self::start();

        # This layer works only after the initialization codes of the core have been switched on.
        # Additional rotations, vendor downloads, startup files will be added to the codes 
        # running on the other layer before this layer.
        Base::layer('Middle');
        
        $parameters   = CURRENT_CPARAMETERS;
        $function     = CURRENT_CFUNCTION;
        $openFunction = CURRENT_COPEN_PAGE;
        $page         = CURRENT_CNAMESPACE . CURRENT_CONTROLLER;
         
        # If an invalid parameter is entered, it will redirect to the opening method.
        if( ! is_callable([$page, $function]) )
        {
            array_unshift($parameters, $function);
            
            $function = $openFunction;

            # If the request is invalid, it will be redirected.
            if( ! is_callable([$page, $function]) )
            {
                Helper::report('InvalidRequest', "Invalid request made to {$page}/{$function} page!");

                Response::redirect(Config::get('Services', 'route')['show404']);
            }
        }
        
        # The view path is being controlled so that the view can be loaded automatically.
        self::viewPathFinder($function, $viewPath, $wizardPath);

        # The controller is being called.
        Singleton::class($page)->$function(...$parameters);
        
        # The view is automatically loading.
        self::viewAutoload($wizardPath, $viewPath);          

        # This layer comes into play after your core works.
        # The codes in the other layer will run before this layer.
        # This layer only enters the kernel immediately before the end codes.
        Base::layer('MiddleBottom');
        
        # The operation of the system core is completes.
        self::end();
    }

    /**
     * View path finder
     * 
     * @param string $function
     * @param string &$viewpath
     * @param string &$wizardPath
     * 
     * @return void
     */
    public static function viewPathFinder($function, &$viewPath, &$wizardPath)
    {
        $viewNameType = Config::get('ViewObjects', 'viewNameType') ?: 'file';

        if( $viewNameType === 'file' )
        {
            $viewFunction = $function === CURRENT_COPEN_PAGE ? NULL : '-' . $function;
            $viewDir      = self::_view($viewFunction);
        }
        else
        {
            $viewFunction = $function === CURRENT_COPEN_PAGE ? CURRENT_COPEN_PAGE : $function;
            $viewDir      = self::_view('/' . $viewFunction);
        }

        $viewPath   = $viewDir . '.php';
        $wizardPath = $viewDir . '.wizard.php';
    }

    /**
     * Autoload view.
     * 
     * @param string $wizardPath
     * @param string $viewPath
     * 
     * @return void
     */
    public static function viewAutoload($wizardPath, $viewPath)
    {
        # 5.3.62[added]|5.3.77[edited]
        if( Config::get('ViewObjects', 'ajaxCodeContinue') === false && Request::isAjax() )
        {
            return;
        }
        
        if( is_file($wizardPath) && ! IS::import($viewPath) && ! IS::import($wizardPath) )
        {
            $usableView = self::_load($wizardPath);
        }
        elseif( is_file($viewPath) && ! IS::import($viewPath) && ! IS::import($wizardPath) )
        {
            $usableView = self::_load($viewPath);
        }

        if( ! empty($masterpageData = In::$masterpage) )
        {
            $inData = array_merge(...$masterpageData);
        }
        else
        {
            $inData = [];
        }

        $data = array_merge($inData, Masterpage::$data);
        
        if( ($data['masterpage'] ?? NULL) === true || ! empty($data) )
        {
            (new Inclusion\Masterpage)->headData($data)->bodyContent($usableView ?? '')->use($data);
        }
        elseif( ! empty($usableView) )
        {
            echo $usableView;
        }
    }
    
    /** 
     * End kernel.
     * 
     * @param void
     * 
     * @return void
     */
    public static function end()
    {
        In::startingConfig('destruct');

        # In this layer, all the processes, including the kernel end codes, are executed.
        # Code to try immediately after the core is placed on this layer.
        Base::layer('BottomTop');

        if( Config::get('Project', 'log')['createFile'] === true && $errorLast = Errors::last() )
        {
            $lang    = Lang::select('Templates');
            $message = $lang['line']   .':'.$errorLast['line'].', '.
                       $lang['file']   .':'.$errorLast['file'].', '.
                       $lang['message'].':'.$errorLast['message'];

            Helper::report('GeneralError', $message);
        }

        if( PROJECT_MODE !== 'publication' ) 
        {
            Exceptions::restore(); Errors::restore();
        }

        ob_end_flush();
    }

    /**
     * protected starting
     * 
     * @param array $starting
     * 
     * @return void
     */
    protected static function _starting($starting)
    {   
        $autoloadRecursive = $starting['autoload']['recursive'];

        $startingAutoload  = array_merge
        (
            Filesystem::getRecursiveFiles(AUTOLOAD_DIR         , $autoloadRecursive), 
            Filesystem::getRecursiveFiles(EXTERNAL_AUTOLOAD_DIR, $autoloadRecursive)
        );

        if( ! empty($startingAutoload) ) foreach( $startingAutoload as $file )
        {
            if( Filesystem::getExtension($file) === 'php' )
            {
                if( is_file($file) )
                {
                    require $file;
                }
            }
        }
    }

    /**
     * protected composer
     * 
     * @param mixed $composer
     * 
     * @return void
     */
    protected static function _composer($composer)
    {
        $path = 'vendor/autoload.php';

        if( $composer === true )
        {
            if( is_file($path) )
            {
                require $path;
            }
            else
            {
                return false;
            }
        }
        elseif( is_file($composer) )
        {
            require composer;
        }
        else
        {
            $path = Base::suffix($composer) . $path;

            Helper::report('Error', Lang::select('Error', 'fileNotFound', $path) ,'AutoloadComposer');

            throw new Exception('Error', 'fileNotFound', $path);
        }
    }

    /**
     * protected view
     * 
     * @param string $fix
     * 
     * @return string
     */
    protected static function _view($fix)
    {
        $view = CURRENT_CONTROLLER;

        if( $subdir = STRUCTURE_DATA['subdir'] )
        {
            $view = $subdir;
        }

        $view .= $fix;

        if( ($active = Theme::$active) !== NULL )
        {
            if( is_dir(PAGES_DIR . $active) )
            {
                $view = $active . $view;
            }
        }

        return PAGES_DIR . $view;
    }

    /**
     * protected load view
     * 
     * @param string $path
     * 
     * @return mixed
     */
    protected static function _load($path)
    {
        return Inclusion\View::use(str_replace(PAGES_DIR, NULL, $path), NULL, true);
    }
}
