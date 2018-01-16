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

use ZN\Ability\Driver;
use ZN\Compression\Exception\InvalidArgumentException;

class Force implements ForceInterface
{
    use Driver;

    /**
     * Driver
     * 
     * @param array driver
     */
    const driver =
    [
        'options'   => ['gz', 'bz', 'lzf', 'rar', 'zip', 'zlib'],
        'namespace' => 'ZN\Compression\Drivers',
        'default'   => 'ZN\Compression\CompressionDefaultConfiguration'
    ];

    /**
     * Extract data
     * 
     * @param string $source
     * @param string $target   = NULL
     * @param string $password = NULL
     * 
     * @return bool
     */
    public function extract(String $source, String $target = NULL, String $password = NULL) : Bool
    {
        if( ! is_file($source) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($source)');
        }

        return $this->driver->extract($source, $target, $password);
    }

    /**
     * Write data to file
     * 
     * @param string $file
     * @param string $data
     * 
     * @return bool
     */
    public function write(String $file, String $data) : Bool
    {
        return $this->driver->write($file, $data);
    }

    /**
     * Read file
     * 
     * @param string $file
     * 
     * @return bool
     */
    public function read(String $file) : String
    {
        return $this->driver->read($file);
    }

    /**
     * Force do
     * 
     * @param string $data
     * 
     * @return string
     */
    public function do(String $data) : String
    {
        return $this->driver->do($data);
    }

    /**
     * Force undo
     * 
     * @param string $data
     * 
     * @return string
     */
    public function undo(String $data) : String
    {
        return $this->driver->undo($data);
    }
}
