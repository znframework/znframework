<?php namespace ZN\IndividualStructures\Compress\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Support;
use ZN\Filesystem\File;
use ZN\IndividualStructures\Abstracts\CompressDriverMappingAbstract;

class ZipDriver extends CompressDriverMappingAbstract
{
    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        Support::library('ZipArchive', 'ZIP Archive');  
    }

    //--------------------------------------------------------------------------------------------------------
    // Extract
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param  string $source
    // @param  string $target
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function extract($source, $target, $password = NULL)
    {
        return File\Forge::zipExtract($source, $target);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Write
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function write($file, $data)
    {
        return uselib('GZDriver')->write($file, $data);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function read($file)
    {
        return uselib('GZDriver')->read($file);
    }

    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function do($data)
    {
        return uselib('GZDriver')->do($data);
    }
    
    //--------------------------------------------------------------------------------------------------------
    // Undo
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function undo($data)
    {
        return uselib('GZDriver')->undo($data);
    }
}