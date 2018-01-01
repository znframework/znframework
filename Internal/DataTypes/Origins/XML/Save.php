<?php namespace ZN\DataTypes\XML;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Save
{
    //--------------------------------------------------------------------------------------------------------
    // Extension
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected static $extension = '.xml';

    //--------------------------------------------------------------------------------------------------------
    // Save
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $file, String $data) : Bool
    {
        $file = suffix($file, self::$extension);

        return file_put_contents($file, $data);
    }
}
