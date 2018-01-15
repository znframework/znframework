<?php namespace ZN\XML;
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
use ZN\XML\Exception\FileNotFoundException;

class Loader
{
    /**
     * Loads an XML file.
     * 
     * @param string $file
     * 
     * @return string
     */
    public static function do(String $file) : String
    {
        $file = Base::suffix($file, '.xml');

        if( is_file($file) )
        {
            return file_get_contents($file);
        }
        else
        {
            throw new FileNotFoundException(NULL, $file);
        }
    }
}
