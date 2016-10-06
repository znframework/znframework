<?php namespace ZN\FileSystem\File;

use File;
use ZN\FileSystem\Exception\FileNotFoundException;
use ZN\FileSystem\FileSystemFactory;
use ZN\FileSystem\InternalUpload;

class Transfer implements TransferInterface
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
    public function settings(array $set = []) : InternalUpload
    {
        FileSystemFactory::class('InternalUpload')->settings($set);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Upload
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public  function upload(string $fileName = 'upload', string $rootDir = UPLOADS_DIR) : bool
    {
        return FileSystemFactory::class('InternalUpload')->start($fileName, $rootDir);
    }

    //--------------------------------------------------------------------------------------------------------
    // Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function download(string $file) : void
    {
        if( ! File::available($file) )
        {
            throw new FileNotFoundException($file);
        }

        $fileEx   = explode("/", $file);
        $fileName = $fileEx[count($fileEx) - 1];
        $filePath = trim($file, $fileName);

        header("Content-type: application/x-download");
        header("Content-Disposition: attachment; filename=".$fileName);

        readfile($filePath.$fileName);
    }
}
