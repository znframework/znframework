<?php namespace ZN\DataTypes\Arrays;

use ZN\DataTypes\Arrays\Exception\LogicException;

class ArrayExclude implements ArrayExcludeInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // excluding
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizi elemanlarından istenmeyen elemanlar belirtilir. Ancak istenmeyen eleman hem anahtar içinde hem de
    // değerler içinde aranır. Bu nedenle beklediğinizden farklı sonuçlar alabilirsiniz. Bu yöntemin en
    // doğru kullanımı anahtar veri içeren dizilerle kullanılmasıdır.
    //
    // @param array $array
    // @param array $excluding
    //
    //--------------------------------------------------------------------------------------------------------
    public function excluding(Array $array, Array $excluding) : Array
    {
        $newArray = [];

        if( count($excluding) > count($array) )
        {
            throw new LogicException
            (
                'DataTypes',
                'array:notExceedLength',
                ['%' => '2.($excluding)', '#' => '1.($array)']
            );
        }

        foreach( $array as $key => $val )
        {
            if( ! in_array($val, $excluding) && ! in_array($key, $excluding) )
            {
                $newArray[$key] = $val;
            }
        }

        return $newArray;
    }

    //--------------------------------------------------------------------------------------------------------
    // excluding
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array   $array
    // @param array   $excluding
    //
    //--------------------------------------------------------------------------------------------------------
    public function exclude(Array $array, Array $excluding) : Array
    {
        return $this->excluding($array, $excluding);
    }
}
