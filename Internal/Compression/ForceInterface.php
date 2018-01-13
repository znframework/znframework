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

interface ForceInterface
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
    public function extract(String $source, String $target = NULL, String $password = NULL) : Bool;

    /**
     * Write data to file
     * 
     * @param string $file
     * @param string $data
     * 
     * @return bool
     */
    public function write(String $file, String $data) : Bool;

    /**
     * Read file
     * 
     * @param string $file
     * 
     * @return bool
     */
    public function read(String $file) : String;

    /**
     * Force do
     * 
     * @param string $data
     * 
     * @return string
     */
    public function do(String $data) : String;

    /**
     * Force undo
     * 
     * @param string $data
     * 
     * @return string
     */
    public function undo(String $data) : String;
}
