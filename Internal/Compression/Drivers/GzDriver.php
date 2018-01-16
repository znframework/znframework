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
use ZN\Compression\Exception\FileNotFoundException;
use ZN\Compression\DriverMappingAbstract;

class GzDriver extends DriverMappingAbstract
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
        Support::func('gzopen', 'GZ');
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
        Support::func('gzextract', 'GZ Driver Extract');
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
        $open = gzopen($file, 'w');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = gzwrite($open, $data, strlen($data));

        gzclose($open);

        return $return;
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
        $open = gzopen($file, 'r');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = gzread($open, 8096);

        gzclose($open);

        return $return;
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
        return gzcompress($data);
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
        return gzuncompress($data);
    }
}
