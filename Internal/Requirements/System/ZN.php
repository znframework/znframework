<?php namespace Project\Controllers;

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
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Küresel Use Kullanımı
    //--------------------------------------------------------------------------------------------------
    //
    // $this ile erişilemeyen yerlerde zn::$use ile erişim sağlanılabilmesi için oluşturulmuştur.
    //
    // @var object
    //
    //--------------------------------------------------------------------------------------------------
    public static $use;

    //--------------------------------------------------------------------------------------------------
    // Constant Version
    //--------------------------------------------------------------------------------------------------
    //
    // return string
    //
    //--------------------------------------------------------------------------------------------------
    const VERSION = ZN_VERSION;

    //--------------------------------------------------------------------------------------------------
    // Constant Required PHP Version
    //--------------------------------------------------------------------------------------------------
    //
    // return string
    //
    //--------------------------------------------------------------------------------------------------
    const REQUIRED_PHP_VERSION = REQUIRED_PHP_VERSION;

    //--------------------------------------------------------------------------------------------------
    // Protected Static Upgrade
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    public static function upgrade()
    {
        $return = self::_restful();

        if( ! empty($return) )
        {
            foreach( $return as $file => $content )
            {
                $dirname = pathInfos($file, 'dirname');

                if( PROJECT_TYPE === 'SE' )
                {
                    $dirname = self::_spath($dirname);
                    $file    = self::_spath($file);

                    if( $file === 'zerocore.php' )
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

    //--------------------------------------------------------------------------------------------------
    // Upgrade Files
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    public static function upgradeFiles()
    {
        return array_keys(self::_restful());
    }

    //--------------------------------------------------------------------------------------------------
    // ZN Run
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
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

    //--------------------------------------------------------------------------------------------------------
    // Magic Call Static
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $class
    // @param array  $parameters
    //
    //--------------------------------------------------------------------------------------------------------
    public static function __callStatic($class, $parameters)
    {
        return uselib($class, $parameters);
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Restful
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _restful()
    {
        $return = \Restful::post('https://api.znframework.com/statistics/upgrade', ['version' => ZN_VERSION]);

        return Separator\Decode::array($return);
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Spath
    //--------------------------------------------------------------------------------------------------
    //
    // @param string $path
    //
    //--------------------------------------------------------------------------------------------------
    protected static function _spath($path)
    {
        return str_replace(['Internal/', 'External/', 'Settings/'], ['Libraries/', NULL, 'Config/'], $path);
    }
}

class_alias('Project\Controllers\ZN', 'ZN');
