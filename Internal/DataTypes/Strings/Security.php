<?php namespace ZN\DataTypes\Strings;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Security
{
    /**
     * Add Slashes
     * 
     * @param string $string
     * @param string $addDifferentChars = NULL
     * 
     * @return string
     */
    public static function addSlashes(String $string, String $addDifferentChars = NULL) : String
    {
        $return = addslashes($string);

        if( ! empty($addDifferentChars) )
        {
            $return = addcslashes($return, $addDifferentChars);
        }

        return $return;
    }

    /**
     * Remove Slashes
     * 
     * @param string $string
     * 
     * @return string
     */
    public static function removeSlashes(String $string) : String
    {
        return stripslashes(stripcslashes($string));
    }
}
