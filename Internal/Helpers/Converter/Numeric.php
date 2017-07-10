<?php namespace ZN\Helpers\Converter;

use Cart;

class Numeric
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
    // Byte
    //--------------------------------------------------------------------------------------------------------
    //
    // @param float $bytes
    // @param int   $precision
    // @param bool  $unit
    //
    //--------------------------------------------------------------------------------------------------------
    public function byte(Float $bytes, Int $precision = 1, Bool $unit = true) : String
    {
        $byte   = 1024;
        $kb     = 1024 * $byte;
        $mb     = 1024 * $kb;
        $gb     = 1024 * $mb;
        $tb     = 1024 * $gb;
        $pb     = 1024 * $tb;
        $eb     = 1024 * $pb;

        if( $bytes <= $byte && $bytes > -1 )
        {
            $un = ( ! empty($unit) )
                  ? " Bytes"
                  : "";

            $return = $bytes.$un;
        }
        elseif( $bytes <= $kb && $bytes > $byte )
        {
            $un = ( ! empty($unit) )
                  ? " KB"
                  : "";

            $return =  round(($bytes / $byte),$precision).$un;
        }
        elseif( $bytes <= $mb && $bytes > $kb )
        {
            $un = ( ! empty($unit) )
                  ? " MB"
                  : "";

            $return =  round(($bytes / $kb),$precision).$un;
        }
        elseif( $bytes <= $gb && $bytes > $mb )
        {
            $un = ( ! empty($unit) )
                  ? " GB"
                  : "";

            $return =   round(($bytes / $mb),$precision).$un;
        }
        elseif( $bytes <= $tb && $bytes > $gb )
        {
            $un = ( ! empty($unit) )
                  ? " TB"
                  : "";

            $return =   round(($bytes / $gb),$precision).$un;
        }
        elseif( $bytes <= $pb && $bytes > $tb )
        {
            $un = ( ! empty($unit) )
                  ? " PB"
                  : "";

            $return =   round(($bytes / $tb),$precision).$un;
        }
        elseif( $bytes <= $eb && $bytes > $pb )
        {
            $un = ( ! empty($unit) )
                  ? " EB"
                  : "";

            $return =   round(($bytes / $pb),$precision).$un;
        }
        else
        {
            $un = ( ! empty($unit) )
                  ? " Bytes"
                  : "";

            $return = str_replace(",", ".", number_format($bytes)).$un;
        }

        return $return;
    }

    //--------------------------------------------------------------------------------------------------------
    // Money
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $money
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function money(Int $money = 0, String $type = NULL) : String
    {
        return Cart::moneyFormat($money, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // Time
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $count
    // @param string $type
    // @param string $output
    //
    //--------------------------------------------------------------------------------------------------------
    public function time(Int $count, String $type = 'second', String $output = 'day') : Float
    {
        if( $output === "second" ) $out = 1;
        if( $output === "minute" ) $out = 60;
        if( $output === "hour" )   $out = 60 * 60;
        if( $output === "day" )    $out = 60 * 60 * 24;
        if( $output === "month" )  $out = 60 * 60 * 24 * 30;
        if( $output === "year" )   $out = 60 * 60 * 24 * 30 * 12;

        if( $type === "second" ) $time = $count;
        if( $type === "minute" ) $time = 60 * $count;
        if( $type === "hour" )   $time = 60 * 60 * $count;
        if( $type === "day" )    $time = 60 * 60 * 24 * $count;
        if( $type === "month" )  $time = 60 * 60 * 24 * 30 * $count;
        if( $type === "year" )   $time = 60 * 60 * 24 * 30 * 12 * $count;

        return $time / $out;
    }
}
