<?php namespace ZN\Compression\Drivers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Support;
use ZN\Compression\DriverMappingAbstract;

class LzfDriver extends DriverMappingAbstract
{
    /**
     * Magic constructor
     * 
     * Checking if your driver is supported.
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        Support::func('lzf_compress', 'LZF');  
    }

    /**
     * Extract data
     * 
     * @param string $source
     * @param string $target   = NULL
     * @param string $password = NULL
     * 
     * @return bool
     */
    public function extract($source, $target, $password)
    {
        Support::func('lzf_extract', 'LZF Driver Extract');   
    }

    /**
     * Write data to file
     * 
     * @param string $file
     * @param string $data
     * 
     * @return bool
     */
    public function write($file, $data)
    {
        $data = $this->do($data);

        return file_put_contents($file, $data);
    }
    
    /**
     * Read file
     * 
     * @param string $file
     * 
     * @return bool
     */
    public function read($file)
    {
        $content = file_get_contents($file);

        return $this->undo($content);
    }

    /**
     * Force do
     * 
     * @param string $data
     * 
     * @return string
     */
    public function do($data)
    {
        return lzf_compress($data);
    }
    
    /**
     * Force undo
     * 
     * @param string $data
     * 
     * @return string
     */
    public function undo($data)
    {
        return lzf_decompress($data);
    }
}