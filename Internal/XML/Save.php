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

class Save
{
    /**
     * Keeps XML file extension
     * 
     * @var string
     */
    protected static $extension = '.xml';

    /**
     * It saves an XML document.
     * 
     * @param string $file
     * @param string $data
     * 
     * @return bool
     */
    public static function do(String $file, String $data) : Bool
    {
        $file = Base::suffix($file, self::$extension);

        return file_put_contents($file, $data);
    }
}
