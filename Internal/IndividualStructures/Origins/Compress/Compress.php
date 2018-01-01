<?php namespace ZN\IndividualStructures;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\IndividualStructures\Exception\InvalidArgumentException;

class Compress implements CompressInterface
{
    use \DriverAbility;

    //--------------------------------------------------------------------------------------------------------
    // Consts
    //--------------------------------------------------------------------------------------------------------
    //
    // @const string
    //
    //--------------------------------------------------------------------------------------------------------
    const driver =
    [
        'options'   => ['bz', 'gz', 'lzf', 'rar', 'zip', 'zlib'],
        'namespace' => 'ZN\IndividualStructures\Compress\Drivers',
        'config'    => 'IndividualStructures:compress'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Extract
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $source
    // @param  string $target
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function extract(String $source, String $target = NULL, String $password = NULL) : Bool
    {
        if( ! is_file($source) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($source)');
        }

        return $this->driver->extract($source, $target, $password);
    }

    //--------------------------------------------------------------------------------------------------------
    // Write
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function write(String $file, String $data) : Bool
    {
        return $this->driver->write($file, $data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Read
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $file
    //
    //--------------------------------------------------------------------------------------------------------
    public function read(String $file) : String
    {
        return $this->driver->read($file);
    }

    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $data) : String
    {
        return $this->driver->do($data);
    }

    //--------------------------------------------------------------------------------------------------------
    // Undo
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function undo(String $data) : String
    {
        return $this->driver->undo($data);
    }
}
