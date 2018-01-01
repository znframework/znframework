<?php namespace ZN\FileSystem\File;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Content
{
    //--------------------------------------------------------------------------------------------------------
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public static function read(String $file) : String
    {
        return file_get_contents(Info::rpath($file));
    }

    //--------------------------------------------------------------------------------------------------------
    // Find
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function find(String $file, String $data) : \stdClass
    {
        $contents = self::read($file);
        $index    = strpos($contents, $data);

        return (object)
        [
            'index'    => $index,
            'contents' => $contents
        ];
    }

    //--------------------------------------------------------------------------------------------------------
    // Write
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function write(String $file, String $data) : Int
    {
        return file_put_contents(Info::rpath($file), $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Append
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function append(String $file, String $data) : Int
    {
        return file_put_contents(Info::rpath($file), $data, FILE_APPEND);
    }
}
