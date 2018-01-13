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

class Select extends Singleton
{
    /**
     * Select key
     * 
     * @param string $name
     * 
     * @return mixed
     */
    public static function do(String $name)
    {
        return self::$session->select(md5('OB_DATAS_'.$name));
    }
}
