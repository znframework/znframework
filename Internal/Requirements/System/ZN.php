<?php namespace Project\Controllers;

use Restful, Separator, Strings, Lang, URI, Route;
use ZN\Core\Kernel, Cache, Config, User;
use ZN\DataTypes\Arrays\Element;
use ZN\DataTypes\Arrays\Exists;
use ZN\FileSystem\File\Content;
use ZN\FileSystem\Folder\Forge;
use ZN\Helpers\Converter\Unicode;
use ZN\IndividualStructures\Buffer\Callback as BufferCallback;

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

                Forge::create($dirname);
                Content::write($file, $content);
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
        return Element::keys(self::_restful());
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
        Route::filter();

        $projectConfig = Config::get('Project', 'cache');

        if
        (
            ($projectConfig['status'] ?? NULL) === true                                                                    &&
            ( ! Exists::value(($projectConfig['machinesIP'] ?? []), User::ip()) )                                    &&
            ( empty($projectConfig['include']) || Exists::value(($projectConfig['include'] ?? []), CURRENT_CFPATH) ) &&
            ( empty($projectConfig['exclude']) || ! Exists::value(($projectConfig['exclude'] ?? []), CURRENT_CFPATH) )
        )
        {
            $converterName = Unicode::slug(URI::active());

            $cacheName = ($projectConfig['prefix'] ?? Lang::get()) . '-' . $converterName;

            Cache::driver($projectConfig['driver']);

            if( ! $select = Cache::select($cacheName, $projectConfig['compress']) )
            {
                $kernel = BufferCallback::do(function()
                {
                    Kernel::run();
                });

                Cache::insert($cacheName, $kernel, $projectConfig['time'], $projectConfig['compress']);

                echo $kernel;
            }
            else
            {
                echo $select;
            }
        }
        else
        {
            Kernel::run();
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
        $return = Restful::post('https://api.znframework.com/statistics/upgrade', ['version' => ZN_VERSION]);

        return Separator::decodeArray($return);
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
