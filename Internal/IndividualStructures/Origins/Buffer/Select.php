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

class Select
{
    //--------------------------------------------------------------------------------------------------------
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $name
    // @return callable/content
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(String $name)
    {
        return \Session::select(md5('OB_DATAS_'.$name));
    }
}
