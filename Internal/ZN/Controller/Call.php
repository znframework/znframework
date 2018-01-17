<?php namespace ZN\Controller;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\ErrorHandling\Errors;
use ZN\Datatype;
use ZN\Exception;

class Call extends Base
{
    /**
     * Magic call
     * 
     * @param string $method
     * @param array  $param
     * 
     * @return void
     */
    public function __call($method, $param)
    {
        throw new Exception
        (
            'Error',
            'undefinedFunction',
            Datatype::divide(str_ireplace(INTERNAL_ACCESS, '', get_called_class()), '\\', -1)."::$method()"
        );
    }
}
