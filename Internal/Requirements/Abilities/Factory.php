<?php 
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\DataTypes\Strings;

trait FactoryAbility
{
    /**
     * Get class
     * 
     * @param string $class
     * 
     * @return mixed 
     */
    public static function class(String $class)
    {
        $namespace = NULL;

        if( defined('static::namespace') )
        {
            $namespace = suffix(static::namespace, '\\');
        }
        else
        {
            $calledClass = get_called_class();
            $namespace   = str_ireplace(Strings\Split::divide($calledClass, '\\', -1), NULL, $calledClass);
        }

        $class = $namespace . $class;

        return uselib($class);
    }
}
