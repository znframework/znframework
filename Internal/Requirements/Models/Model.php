<?php namespace ZN\Requirements\Models;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Model
{

    /**
     * Magic get
     * 
     * @param string $class
     * 
     * @return mixec
     */
    public function __get($class)
    {
        if( ! isset($this->$class) )
        {
            return $this->$class = uselib($class);  
        }
    }
}

# Alias Model
class_alias('ZN\Requirements\Models\Model', 'Model');