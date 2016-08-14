<?php namespace ZN\FileSystem;

class InternalDownload extends \CallController implements DownloadInterface
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
    // Start
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function start(String $file)
    {
        if( ! file_exists($file) )
        {
            return \Exceptions::throws('FileSystem', 'file:notFoundError', $file);
        }
    
        $fileEx   = explode("/", $file);
        $fileName = $fileEx[count($fileEx)-1];
        $filePath = trim($file, $fileName);
        
        header("Content-type: application/x-download");
        header("Content-Disposition: attachment; filename=".$fileName);
        
        readfile($filePath.$fileName);
    }   
}