<?php namespace ZN\DataTypes;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Objects
{
    /**
     * Magic Constructor
     * 
     * @param array $array
     */
    public function __construct(Array $array)
    {
        if ( ! empty($array) )
        {
            foreach( $array as $key => $val )
            {
                $this->{$key} = $val;
            }
        }
    }
}
