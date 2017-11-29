<?php namespace ZN\FileSystem\File;

use ZN\FileSystem\Exception\FileNotFoundException;

class Transfer
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
