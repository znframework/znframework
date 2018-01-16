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

use ZN\Base;
use ZN\Support;
use ZN\Singleton;
use ZN\Compression\Exception\InvalidArgumentException;
use ZN\Compression\DriverMappingAbstract;

class RarDriver extends DriverMappingAbstract
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
        Support::func('rar_open', 'RAR');
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
        $rarFile = rar_open(Base::suffix($source, '.rar'), $password);
        $list    = rar_list($rarFile);

        if( ! empty($list) ) foreach( $list as $file )
        {
            $entry = rar_entry_get($rarFile, $file);
            $entry->extract($target);
        }
        else
        {
            throw new InvalidArgumentException('Error', 'emptyVariable', '$list');
        }

        rar_close($rarFile);
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
        return Singleton::class('GzDriver')->write($file, $data);
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
        return Singleton::class('GzDriver')->read($file);
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
        return Singleton::class('GzDriver')->do($data);
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
        return Singleton::class('GzDriver')->undo($data);
    }
}
