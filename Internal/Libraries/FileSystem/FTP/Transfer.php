<?php namespace ZN\FileSystem\FTP;

use Converter;
use ZN\FileSystem\Exception\FileRemoteUploadException;
use ZN\FileSystem\Exception\FileRemoteDownloadException;

class Transfer extends Connection implements TransferInterface
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
        if( ftp_put($this->connect, $remotePath, $localPath, Converter::toConstant($type, 'FTP_')) )
        {
            return true;
        }
        else
        {
            throw new FileRemoteUploadException($localPath);
        }
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
        if( ftp_get($this->connect, $localPath, $remotePath, Converter::toConstant($type, 'FTP_')) )
        {
            return true;
        }
        else
        {
            throw new FileRemoteDownloadException($localPath);
        }
    }
}
