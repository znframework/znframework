<?php namespace ZN\FileSystem\FTP;

use ZN\FileSystem\File;

class Info extends Connection
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
    // files()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path     : empty
    // @param string $extension: empty
    //
    //--------------------------------------------------------------------------------------------------------
    public function files(String $path, String $extension = NULL) : Array
    {
        $list = ftp_nlist($this->connect, $path);

        if( ! empty($list) ) foreach( $list as $file )
        {
            if( $file !== '.' && $file !== '..' )
            {
                if( ! empty($extension) && $extension !== 'dir' )
                {
                    if( File\Extension::get($file) === $extension )
                    {
                        $files[] = $file;
                    }
                }
                else
                {
                    if( $extension === 'dir' )
                    {
                        $extens = File\Extension::get($file);

                        if( empty($extens) )
                        {
                            $files[] = $file;
                        }
                    }
                    else
                    {
                        $files[] = $file;
                    }
                }
            }
        }

        if( ! empty($files) )
        {
            return $files;
        }
        else
        {
            return [];
        }
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
        $size = 0;

        $extension = File\Extension::get($path);

        if( ! empty($extension) )
        {
            $size = ftp_size($this->connect, $path);
        }
        else
        {
            if( $this->files($path) )
            {
                foreach( $this->files($path) as $val )
                {
                    $size += ftp_size($this->connect, $path."/".$val);
                }

                $size += ftp_size($this->connect, $path);
            }
            else
            {
                $size += ftp_size($this->connect, $path);
            }
        }

        switch( $type )
        {
            case 'b' : return $size;
            case 'kb': return round($size / 1024, $decimal);
            case 'mb': return round($size / (1024 * 1024), $decimal);
            case 'gb': return round($size / (1024 * 1024 * 1024), $decimal);
        }
    }
}
