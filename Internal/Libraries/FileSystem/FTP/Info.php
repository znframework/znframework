<?php namespace ZN\FileSystem\FTP;

class Info extends Connection implements InfoInterface
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
                    if( extension($file) === $extension )
                    {
                        $files[] = $file;
                    }
                }
                else
                {
                    if( $extension === 'dir' )
                    {
                        $extens = extension($file);

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

        $extension = extension($path);

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

        if( $type === "b" )
        {
            return  $size;
        }
        if( $type === "kb" )
        {
            return round($size / 1024, $decimal);
        }
        if( $type === "mb" )
        {
            return round($size / (1024 * 1024), $decimal);
        }
        if( $type === "gb" )
        {
            return round($size / (1024 * 1024 * 1024), $decimal);
        }
    }
}
