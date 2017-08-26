<?php namespace Project\Controllers;

use Restful, Separator, File, Folder, Arrays;

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

    protected static function _restful()
    {
        $return = Restful::post('https://api.znframework.com/statistics/upgrade', ['version' => ZN_VERSION]);

        return Separator::decodeArray($return);
    }

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

                Folder::create($dirname);
                File::write($file, $content);
            }

            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------------------------------
    // Protected Static Upgrade Files
    //--------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------
    public static function upgradeFiles()
    {
        return Arrays::keys(self::_restful());
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
}

class_alias('Project\Controllers\ZN', 'ZN');
