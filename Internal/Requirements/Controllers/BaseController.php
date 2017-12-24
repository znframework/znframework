<?php namespace ZN\Requirements\Controllers;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use Autoloader;

class BaseController
{
    /**
     * Magic get
     * 
     * @param string $class
     * 
     * @return mixed
     */
    public function __get($class)
    {
        if( ! isset($this->$class) )
        {
            return $this->$class = uselib($class);
        }
    }

    /**
     * Reload ClassMap
     * 
     * @param void
     * 
     * @return $this
     */
    public function reload()
    {
        Autoloader::restart();

        return $this;
    }
}

# Alias BaseController 
class_alias('ZN\Requirements\Controllers\BaseController', 'BaseController');
