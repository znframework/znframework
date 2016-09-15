<?php namespace ZN\Helpers;

use CallController;

class InternalRounder extends CallController implements RounderInterface
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
    // Up
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $number
    // @param int    $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function up(Float $number, Int $count = 0) : Float
    {
        if( $count === 0 )
        {
            return ceil($number);
        }

        $numbers = explode(".", $number);

        $edit = 0;

        if( ! empty($numbers[1]) )
        {
            $edit = substr($numbers[1], 0, $count);

            return (float) $numbers[0].".".($edit + 1);
        }
        
        return $number;
    }

    //--------------------------------------------------------------------------------------------------------
    // Down
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $number
    // @param int    $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function down(Float $number, Int $count = 0) : Float
    {
        if( $count === 0 )
        {
            return floor($number);
        }

        $numbers = explode(".", $number);

        $edit = 0;

        if( ! empty($numbers[1]) )
        {
            $edit = substr($numbers[1], 0, $count);

            return (float) $numbers[0].".".$edit;
        }

        return $number;
    }

    //--------------------------------------------------------------------------------------------------------
    // Average
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $number
    // @param int    $count
    //
    //--------------------------------------------------------------------------------------------------------
    public function average(Float $number, Int $count = 0) : Float
    {
        return round($number, $count);
    }
}
