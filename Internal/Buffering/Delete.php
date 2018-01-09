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

class Delete extends Singleton
{
    /**
     * Delete key
     * 
     * @param mixed $name
     * 
     * @return bool
     */
    public static function do($name) : Bool
    {
        if( is_array($name) )
        {
            foreach( $name as $delete )
            {
                self::$session->delete(md5('OB_DATAS_'.$delete));
            }

            return true;
        }
        elseif( is_scalar($name) )
        {
            return self::$session->delete(md5('OB_DATAS_'.$name));
        }

        return false;
    }
}
