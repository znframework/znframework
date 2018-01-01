<?php namespace ZN\IndividualStructures\Buffer;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Insert
{
    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string                 $name
    // @param  callable/object/string $data
    // @param  array                  $params
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $name, $data, Array $params = []) : Bool
    {
        $systemObData = md5('OB_DATAS_'.$name);

        if( is_callable($data) )
        {
            return \Session::insert($systemObData, Callback::do($data, (array) $params));
        }
        elseif( is_file($data) )
        {
            return \Session::insert($systemObData, File::do($data));
        }
        else
        {
            return \Session::insert($systemObData, $data);
        }
    }
}
