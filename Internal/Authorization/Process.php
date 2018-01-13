<?php namespace ZN\Authorization;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Process extends PermissionExtends
{
    /**
     * Start
     * 
     * @param mixed $roleId  = 0
     * @param mixed $process = NULL
     * 
     * @return void
     */
    public static function start($roleId = 0, $process = NULL)
    {
        self::$content = self::use($roleId, $process, 'object');

        ob_start();
    }

    /**
     * End
     * 
     * @param void
     * 
     * @return void
     */
    public static function end()
    {
        if( ! empty(self::$content) )
        {
            $content = ob_get_contents();
        }
        else
        {
            $content = '';
        }

        ob_end_clean();

        self::$content = NULL;

        echo $content;
    }

    /**
     * Process
     * 
     * @param mixed $roleId  = 0
     * @param mixed $process = NULL
     * @param mixed $object  = NULL
     * 
     * @return mixed
     */
    public static function use($roleId = 0, $process = NULL, $object = NULL)
    {
        if( PermissionExtends::$roleId !== NULL )
        {
            $object  = $process;
            $process = $roleId;
            $roleId  = PermissionExtends::$roleId;
        }

        return self::common($roleId, $process, $object, 'process');
    }
}
