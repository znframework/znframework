<?php namespace ZN\FileSystem\FTP;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\FileSystem\Exception\FolderAllreadyException;
use ZN\FileSystem\Exception\FolderNotFoundException;
use ZN\FileSystem\Exception\FolderChangeDirException;
use ZN\FileSystem\Exception\FolderChangeNameException;
use ZN\FileSystem\Exception\IOException;

class Forge extends Connection
{
    //--------------------------------------------------------------------------------------------------------
    // createFolder()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function createFolder(String $path) : Bool
    {
        if( ftp_mkdir($this->connect, $path) )
        {
            return true;
        }
        else
        {
            throw new FolderAllreadyException($path);
        }
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
        if( ftp_rmdir($this->connect, $path) )
        {
            return true;
        }
        else
        {
            throw new FolderNotFoundException($path);
        }
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
        if( ftp_chdir($this->connect, $path) )
        {
            return true;
        }
        else
        {
            throw new FolderChangeDirException($path);
        }
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
        if( ftp_rename($this->connect, $oldName, $newName) )
        {
            return true;
        }
        else
        {
            throw new FolderChangeNameException($oldName);
        }
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
        if( ftp_delete($this->connect, $path) )
        {
            return true;
        }
        else
        {
            throw new FileNotFoundException($path);
        }
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
        if( ftp_chmod($this->connect, $type, $path) )
        {
            return true;
        }
        else
        {
            throw new IOException('Error', 'emptyVariable', 'Connect');
        }
    }
}
