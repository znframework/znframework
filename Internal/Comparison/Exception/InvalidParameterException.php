<?php namespace ZN\Comparison\Exception;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Exception;

class InvalidParameterException extends Exception
{
    const lang = 
    [
        'en' => '[Benchmark::&(\'%\')] -> Parameter is not a valid test #!'
    ];
}
