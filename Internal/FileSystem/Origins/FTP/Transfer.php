<?php namespace ZN\Filesystem\FTP;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helpers\Converter;
use ZN\Filesystem\Exception\FileRemoteUploadException;
use ZN\Filesystem\Exception\FileRemoteDownloadException;

class Transfer extends Connection
{
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
