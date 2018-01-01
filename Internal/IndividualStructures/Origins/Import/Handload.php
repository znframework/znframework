<?php namespace ZN\IndividualStructures\Import;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Handload
{
    //--------------------------------------------------------------------------------------------------------
    // handload()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param variadic $args
    //
    //--------------------------------------------------------------------------------------------------------
    public static function use(...$args)
    {
        if( ! empty($args) ) foreach( $args as $file )
        {
            $suffix     = suffix($file, '.php');
            $commonFile = EXTERNAL_HANDLOAD_DIR.$suffix ;
            $file       = HANDLOAD_DIR.$suffix;

            if( is_file($file) )
            {
                import($file); // Local File
            }
            elseif( is_file($commonFile) )
            {
                import($commonFile); // Common File
            }
        }
    }
}
