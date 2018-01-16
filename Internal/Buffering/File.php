<?php namespace ZN\Buffering;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Buffering;
use ZN\Buffering\Exception\InvalidArgumentException;

class File
{
    /**
     * Buffer file
     * 
     * @param string $randomBufferClassPagePath
     * @param array  $randomBufferClassDataVariable
     * 
     * @return string
     */
    public static function do(String $randomBufferClassPagePath, Array $randomBufferClassDataVariable = NULL) : String
    {
        if( ! is_file($randomBufferClassPagePath) )
        {
            throw new InvalidArgumentException('Error', 'fileParameter', '1.($file)');
        }

        return Buffering::file($randomBufferClassPagePath, $randomBufferClassDataVariable);
    }
}
