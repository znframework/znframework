<?php namespace ZN\DataTypes\Json;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Helpers\Converter;

class Encode
{
    //--------------------------------------------------------------------------------------------------------
    // Encode
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed  $data
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do($data, String $type = 'unescaped_unicode') : String
    {
        return json_encode($data, Converter::toConstant($type, 'JSON_'));
    }
}
