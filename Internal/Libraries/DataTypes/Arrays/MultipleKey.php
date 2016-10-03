<?php namespace ZN\DataTypes\Arrays;

class MultipleKey implements MultipleKeyInterface
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
    // Multikey
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array  $array
    // @param string $keySplit:|
    //
    //--------------------------------------------------------------------------------------------------------
    public function use(array $array, string $keySplit = '|') : array
    {
        $newArray = [];

        foreach( $array as $k => $v )
        {
            $keys = explode($keySplit, $k);

            foreach( $keys as $val )
            {
                $newArray[$val] = $v;
            }
        }

        return $newArray;
    }
}
