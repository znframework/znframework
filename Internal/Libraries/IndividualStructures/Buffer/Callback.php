<?php namespace ZN\IndividualStructures\Buffer;

use ZN\IndividualStructures\Buffer\Exception\InvalidArgumentException;

class Callback implements CallbackInterface
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
    // Do -> 4.2.8[edited]
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string/callable $func
    // @param  array           $params
    // @return callable
    //
    //--------------------------------------------------------------------------------------------------------
    public static function do($func, Array $params = [])
    {
        if( ! is_callable($func) )
        {
            throw new InvalidArgumentException('Error', 'callableParameter', '1.($func)');
        }

        ob_start();

        if( ! empty($params) )
        {
            call_user_func_array($func, $params);
        }
        else
        {
            $func();
        }

        $contents = ob_get_contents();

        ob_end_clean();

        return $contents;
    }
}
