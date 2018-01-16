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

use ZN\Buffering;

class Callback
{
    /**
     * Buffer code
     * 
     * @param string $randomBufferClassCallbackCode
     * @param array  $randomBufferClassCallbackData
     * 
     * @return mixed
     */
    public static function code(String $randomBufferClassCallbackCode, Array $randomBufferClassCallbackData = NULL)
    {
        return Buffering::code($randomBufferClassCallbackCode, $randomBufferClassCallbackData);
    }

    /**
     * Buffer closure
     * 
     * @param callable $func
     * @param array    $params = []
     * 
     * @return mixed
     */
    public static function do(Callable $func, Array $params = [])
    {
        ob_start();

        echo $func(...$params);

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}
