<?php namespace ZN\FileSystem\File;

use stdClass;
use ZN\FileSystem\FileSystemCommon;

class Content extends FileSystemCommon implements ContentInterface
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
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function read(String $file) : String
    {
        return file_get_contents($this->rpath($file));
    }

    //--------------------------------------------------------------------------------------------------------
    // Find
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function find(String $file, String $data) : stdClass
    {
        $contents = $this->read($file);
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
    public function write(String $file, String $data) : Int
    {
        return file_put_contents($this->rpath($file), $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Append
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function append(String $file, String $data) : Int
    {
        return file_put_contents($this->rpath($file), $data, FILE_APPEND);
    }
}
