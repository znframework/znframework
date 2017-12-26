<?php namespace Project\Controllers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Core\Kernel;
use ZN\Services\URI;
use ZN\FileSystem\File;
use ZN\FileSystem\Folder;
use ZN\Helpers\Converter;
use ZN\DataTypes\Separator;
use ZN\IndividualStructures\Lang;
use ZN\IndividualStructures\Buffer;
use ZN\ErrorHandling\Exceptions;

class ZN
{
    /**
     * Use library
     * 
     * @var mixed
     */
    public static $use;

    /**
     * Get ZN version
     * 
     * @var string
     */
    const VERSION = ZN_VERSION;

    /**
     * Get required php version
     * 
     * @var string
     */
    const REQUIRED_PHP_VERSION = REQUIRED_PHP_VERSION;

    /**
     * Upgrade system
     * 
     * @param void
     * 
     * @return bool
     */
    public static function upgrade()
    {
        $return = self::_restful();

        if( ! empty($return) )
        {
            foreach( $return as $file => $content )
            {
                $dirname = File\Info::pathInfo($file, 'dirname');

                if( PROJECT_TYPE === 'SE' )
                {
                    $dirname = self::_spath($dirname);
                    $file    = self::_spath($file);

                    if( $file === 'zeroneed.php' )
                    {
                        $content = str_replace(", 'EIP'", ", 'SE'", $content);
                    }
                }

                Folder\Forge::create($dirname);
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
        return array_keys(self::_restful());
    }

    /**
     * Run ZN
     * 
     * @param void
     * 
     * @return void
     */
    public static function run()
    {
        \Route::filter();

        $projectConfig = \Config::get('Project', 'cache');

        if
        (
            ($projectConfig['status'] ?? NULL) === true                                                         &&
            ( ! in_array(\User::ip(), ($projectConfig['machinesIP'] ?? [])) )                                   &&
            ( empty($projectConfig['include']) || in_array(CURRENT_CFPATH, ($projectConfig['include'] ?? [])) ) &&
            ( empty($projectConfig['exclude']) || ! in_array(CURRENT_CFPATH, ($projectConfig['exclude'] ?? [])) )
        )
        {
            $converterName = Converter::slug(URI::active());

            $cacheName = ($projectConfig['prefix'] ?? Lang::get()) . '-' . $converterName;

            \Cache::driver($projectConfig['driver']);

            if( ! $select = \Cache::select($cacheName, $projectConfig['compress']) )
            {
                $kernel = Buffer\Callback::do(function()
                {
                    Kernel::run();
                });

                \Cache::insert($cacheName, $kernel, $projectConfig['time'], $projectConfig['compress']);

                echo $kernel;
            }
            else
            {
                echo $select;
            }
        }
        else
        {
            try 
            { 
                Kernel::run();  
            }
            catch( \Throwable $e )
            {
                if( PROJECT_MODE !== 'publication' ) 
                {
                    Exceptions::table($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace());
                }   
            }
        } 
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
        return uselib($class, $parameters);
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
        $return = \Restful::post('https://api.znframework.com/statistics/upgrade', ['version' => ZN_VERSION]);

        return Separator\Decode::array($return);
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

# Alias ZN
class_alias('Project\Controllers\ZN', 'ZN');
