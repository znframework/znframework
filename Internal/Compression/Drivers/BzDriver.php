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

class BzDriver extends DriverMappingAbstract
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
        Support::func('bzopen', 'BZ');
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
        Support::func('bzextract', 'BZ Driver Extract');
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
        $open = bzopen($file, 'w');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = bzwrite($open, $data, strlen($data));

        bzclose($open);

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
        $open = bzopen($file, 'r');

        if( empty($open) )
        {
            throw new FileNotFoundException('Error', 'fileNotFound', $file);
        }

        $return = bzread($open, 8096);

        bzclose($open);

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
        return bzcompress($data);
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
        return bzdecompress($data);
    }
}
