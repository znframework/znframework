<?php namespace ZN\DataTypes\Arrays;

use ZN\DataTypes\Arrays\Exception\LogicException;

class Including
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
    // including
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizi elemanlarından istenen elemanlar belirtilir. Ancak istenmeyen eleman hem anahtar içinde hem de
    // değerler içinde aranır. Bu nedenle beklediğinizden farklı sonuçlar alabilirsiniz. Bu yöntemin en
    // doğru kullanımı anahtar veri içeren dizilerle kullanılmasıdır.
    //
    // @param array   $array
    // @param array   $including
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(Array $array, Array $including) : Array
    {
        $newArray = [];

        if( count($including) > count($array) )
        {
            throw new LogicException
            (
                'DataTypes',
                'array:notExceedLength',
                ['%' => '2.($including)', '#' => '1.($array)']
            );
        }

        foreach( $array as $key => $val )
        {
            if( in_array($val, $including) || in_array($key, $including) )
            {
                $newArray[$key] = $val;
            }
        }

        return $newArray;
    }
}
