<?php namespace ZN\Compression;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

abstract class DriverMappingAbstract
{
    /**
     * Extract data
     * 
     * @param string $source
     * @param string $target   = NULL
     * @param string $password = NULL
     * 
     * @return bool
     */
    abstract public function extract($source, $target, $password);
    
    /**
     * Write data to file
     * 
     * @param string $file
     * @param string $data
     * 
     * @return bool
     */
    abstract public function write($file, $data);
    
    /**
     * Read file
     * 
     * @param string $file
     * 
     * @return bool
     */
    abstract public function read($file);

    /**
     * Force do
     * 
     * @param string $data
     * 
     * @return string
     */
    abstract public function do($data);

    /**
     * Force undo
     * 
     * @param string $data
     * 
     * @return string
     */
    abstract public function undo($data);
}