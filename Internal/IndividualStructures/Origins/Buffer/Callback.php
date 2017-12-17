<?php namespace ZN\IndividualStructures\Buffer;

use ZN\ErrorHandling\Exceptions;
use ZN\ErrorHandling\Errors;

class Callback
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

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
