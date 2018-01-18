<?php namespace ZN\Inclusion;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;

class Handload
{
    /**
     * Import Handload
     * 
     * @param string ...$args
     * 
     * @return mixed
     */
    public static function use(...$args)
    {
        if( ! empty($args) ) foreach( $args as $file )
        {
            $suffix     = Base::suffix($file, '.php');
            $commonFile = EXTERNAL_HANDLOAD_DIR.$suffix ;
            $file       = HANDLOAD_DIR.$suffix;

            if( is_file($file) )
            {
                require_once $file; # Local File
            }
            elseif( is_file($commonFile) )
            {
                require_once $commonFile; # Common File
            }
        }
    }
}
