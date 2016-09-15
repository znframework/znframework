<?php namespace ZN\FileSystem;

use ZN\FileSystem\FTP\Connection;

class InternalFTP extends Connection implements FTPInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // createFolder()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function createFolder(String $path) : Bool
    {
        return FTPFactory::class('FTPForge')->createFolder($path);
    }

    //--------------------------------------------------------------------------------------------------------
    // deleteFolder()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteFolder(String $path) : Bool
    {
        return FTPFactory::class('FTPForge')->deleteFolder($path);
    }

    //--------------------------------------------------------------------------------------------------------
    // changeFolder()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function changeFolder(String $path) : Bool
    {
        return FTPFactory::class('FTPForge')->changeFolder($path);
    }

    //--------------------------------------------------------------------------------------------------------
    // rename()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $oldName: empty
    // @param string $newName: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function rename(String $oldName, String $newName) : Bool
    {
        return FTPFactory::class('FTPForge')->rename($oldName, $newName);
    }

    //--------------------------------------------------------------------------------------------------------
    // deleteFile()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteFile(String $path) : Bool
    {
        return FTPFactory::class('FTPForge')->deleteFile($path);
    }

    //--------------------------------------------------------------------------------------------------------
    // upload()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $localPath : empty
    // @param string $remotePath: empty
    // @param string $type      : binary, ascii
    //
    //--------------------------------------------------------------------------------------------------------
    public function upload(String $localPath, String $remotePath, String $type = 'ascii') : Bool
    {
        return FTPFactory::class('FTPFileTransfer')->upload($localPath, $remotePath, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // dowload()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $remotePath: empty
    // @param string $localPath : empty
    // @param string $type      : binary, ascii
    //
    //--------------------------------------------------------------------------------------------------------
    public function download(String $remotePath, String $localPath, String $type = 'ascii') : Bool
    {
        return FTPFactory::class('FTPFileTransfer')->download($remotePath, $localPath, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // permission()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path: empty
    // @param int $type   : 0755
    //
    //--------------------------------------------------------------------------------------------------------
    public function permission(String $path, Int $type = 0755) : Bool
    {
        return FTPFactory::class('FTPForge')->permission($path, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // files()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path     : empty
    // @param string $extension: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function files(String $path, String $extension = NULL) : Array
    {
        return FTPFactory::class('FTPInfo')->files($path, $extension);
    }

    //--------------------------------------------------------------------------------------------------------
    // fileSize()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path   : empty
    // @param string $type   : b, kb, mb, gb
    // @param int    $decimal: 2
    //
    //--------------------------------------------------------------------------------------------------------
    public function fileSize(String $path, String $type = 'b', Int $decimal = 2) : Float
    {
        return FTPFactory::class('FTPInfo')->fileSize($path, $type, $decimal);
    }
}
