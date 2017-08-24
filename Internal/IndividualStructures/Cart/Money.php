<?php namespace ZN\IndividualStructures\Cart;

class Money
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
    // Money Format
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $money
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function format(Int $money, String $type = NULL) : String
    {
        $moneyFormat = '';
        $money       = round($money, 2);
        $strEx      = explode(".",$money);
        $join        = [];
        $str         = strrev($strEx[0]);

        for( $i = 0; $i < strlen($str); $i++ )
        {
            if( $i%3 === 0 )
            {
                array_unshift($join, '.');
            }

            array_unshift($join, $str[$i]);
        }

        for( $i = 0; $i < count($join); $i++ )
        {
            $moneyFormat .= $join[$i];
        }

        $type = ! empty($type)
                ? ' '.$type
                : '';

        $remaining = $strEx[1] ?? '00';

        if( strlen($remaining) === 1 )
        {
            $remaining .= '0';
        }

        $moneyFormat = substr($moneyFormat,0,-1).','.$remaining.$type;

        return $moneyFormat;
    }
}
