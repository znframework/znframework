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

use ZN\Services\Restful;
use ZN\Protection\Separator;
use ZN\ErrorHandling\Exceptions;

class ZN
{
    /**
     * @var string
     */
    protected static $notAvailable = 'This command not available with this edition!';

    /**
     * Upgrade system
     * 
     * @param void
     * 
     * @return bool
     */
    public static function upgrade()
    {
        if( PROJECT_TYPE === 'SE' )
        {
            return self::$notAvailable;
        }

        $return = self::_restful();

        if( ! empty($return) )
        {
            foreach( $return as $file => $content )
            {
                $dirname = Filesystem\Info::pathInfo($file, 'dirname');

                Filesystem\Forge::createFolder($dirname);
                file_put_contents($file, $content);
            }

            return true;
        }

        return false;
    }

    /**
     * Get upgrade files
     * 
     * @param void
     * 
     * @return array
     */
    public static function upgradeFiles()
    {
        if( PROJECT_TYPE === 'SE' )
        {
            return self::$notAvailable;
        }
        
        return array_keys(self::_restful());
    }

    /**
     * Run ZN
     * 
     * @param string $type     = 'EIP' - options[EIP|SE]
     * @param string $version  = '5.6.0'
     * @param string $dedicate = 'Nikola Tesla'
     * 
     * @return void|false
     */
    public static function run(String $type = 'EIP', String $version = '5.6.0', String $dedicate = 'Nikola Tesla')
    {
        # PHP shows code errors.
        ini_set('display_errors', true);

        # The system starts the load time.
        define('START_BENCHMARK', microtime(true));

        # ZN Version
        define('ZN_VERSION', $version);

        # Dedicated
        define('ZN_DEDICATE', $dedicate);

        # It shows you which framework you are using. SE for single edition, EIP for multi edition.
        define('PROJECT_TYPE', $type);

        # The system directory is determined according to ZN project type.
        define('INTERNAL_DIR', (PROJECT_TYPE === 'SE' ? 'Libraries' : 'Internal') . '/');

        # It keeps path of the files needed for the system.
        define('ZEROCORE', INTERNAL_DIR . 'ZN/');

        # The system gives the knowledge of the actual root directory.
        define('REAL_BASE_DIR', pathinfo($_SERVER['SCRIPT_FILENAME'], PATHINFO_DIRNAME) . '/');

        # Predefined Functions
        require __DIR__ . '/Functions.php';

        # ZN Framework uses its own autoloader system, unlike other 
        # implementations. In this system, the libraries are written to 
        # Config/ClassMap.php file. Subsequent calls are made from this file.
        require __DIR__ . '/Autoloader.php';
        
        # Enables class loading by automatically activating the object call.
        Autoloader::register();

        # Defines constants required for system and user.
        Autoloader::defines();
        
        # The code to be written to this layer runs before the system files are 
        # loaded. For this reason, you can not use ZN libraries.
        Base::layer('Top');
       
        # You can use system constants and libraries in this layer since the code 
        # to write to this layer is used immediately after the auto loader. 
        # All Config files can be configured on this layer since this layer runs 
        # immediately after the auto installer.
        Base::layer('TopBottom');

        # Provides data about the current working url.
        Structure::defines();

        # If the operation is executed via console, the code flow is not continue.  
        if( defined('CONSOLE_ENABLED') )
        {
            return false;
        }

        Singleton::class('ZN\Routing\Route')->filter();

        try 
        { 
            Kernel::run();  
        }
        catch( Throwable $e )
        {
            if( PROJECT_MODE !== 'publication' ) 
            {
                Exceptions::table($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace());
            }   
        }

        # The system finishes the load time.
        define('FINISH_BENCHMARK', microtime(true));

        # Creates a table that calculates the operating performance of the system. 
        # To open this table, follow the steps below.
        In::benchmarkReport();
    }

    /**
     * Magic call static
     * 
     * @param string $class
     * @param array  $parameters
     * 
     * @return mixed
     */
    public static function __callStatic($class, $parameters)
    {
        return Singleton::class($class, $parameters);
    }

    /**
     * protected restful
     * 
     * @param void
     * 
     * @return array
     */
    protected static function _restful()
    {
        $return = (new Restful)->post('https://api.znframework.com/statistics/upgrade', ['version' => ZN_VERSION]);

        return Separator::decodeArray($return);
    }

    /**
     * protected spath
     * 
     * @param string $path
     * 
     * @return string
     */
    protected static function _spath($path)
    {
        return str_replace(['Internal/', 'External/', 'Settings/'], ['Libraries/', NULL, 'Config/'], $path);
    }
}
