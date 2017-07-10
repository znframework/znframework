<?php namespace ZN\DataTypes\Arrays;

class AddElement
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
    // Add First
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    //
    //--------------------------------------------------------------------------------------------------------
    public function first(Array $array, $element, $type = 'array_unshift') : Array
    {
        if( ! is_array($element) )
        {
            $type($array, $element);
        }
        else
        {
            if( $type === 'array_unshift' )
            {
                $array = array_merge($element, $array);
            }
            else
            {
                $array = array_merge($array, $element);
            }
        }

        return $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Add Last
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $array
    // @param mixed $element
    //
    //--------------------------------------------------------------------------------------------------------
    public function last(Array $array, $element) : Array
    {
        return $this->first($array, $element, 'array_push');
    }
}
