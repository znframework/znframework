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

use ZN\FileSystem\Exception\FileNotFoundException;

class Transfer
{
    //--------------------------------------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $set
    //
    //--------------------------------------------------------------------------------------------------------
    public static function settings(Array $set = [])
    {
        return Upload::settings($set);
    }

    //--------------------------------------------------------------------------------------------------------
    // Upload
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public static function upload(String $fileName = 'upload', String $rootDir = UPLOADS_DIR) : Bool
    {
        return Upload::start($fileName, $rootDir);
    }

    //--------------------------------------------------------------------------------------------------------
    // Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public static function download(String $file)
    {
        if( ! Info::available($file) )
        {
            throw new FileNotFoundException($file);
        }

        $fileEx   = explode('/', $file);
        $fileName = $fileEx[count($fileEx) - 1];
        $filePath = trim($file, $fileName);

        header("Content-type: application/x-download");
        header("Content-Disposition: attachment; filename=".$fileName);

        readfile($filePath.$fileName);
    }
}
