<?php namespace ZN\DataTypes\Separator;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Encode extends SeparatorExtends
{
    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $data
    // @param string $key
    // @param string $separator
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Array $data, String $key = NULL, String $separator = NULL) : String
    {
        $word      = NULL;
        $key       = $key       ?: self::$key;
        $separator = $separator ?: self::$separator;
 
        foreach( $data as $k => $v )
        {
            $word .= self::_security($k).$key.self::_security($v).$separator;
        }

        return mb_substr($word, 0, -(mb_strlen($separator)));
    }
}
