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

class Callback
{
    //--------------------------------------------------------------------------------------------------------
    // Code -> 5.3.2
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $code
    // @param arrau  $data
    //
    //--------------------------------------------------------------------------------------------------------
    public static function code(String $randomBufferClassCallbackCode, Array $randomBufferClassCallbackData = NULL)
    {
        if( is_array($randomBufferClassCallbackData) )
        {
            extract($randomBufferClassCallbackData, EXTR_OVERWRITE, 'ZN');
        }

        ob_start();

        eval('?>' . $randomBufferClassCallbackCode);
       
        $randomBufferClassCallbackContents = ob_get_contents();
        
        ob_end_clean();

        return $randomBufferClassCallbackContents;
    }

    //--------------------------------------------------------------------------------------------------------
    // Do -> 4.2.8[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string/callable $func
    // @param  array           $params
    // @return callable
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do(Callable $func, Array $params = [])
    {
        ob_start();

        echo $func(...$params);

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}
