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
        return $this->_data($number, $count, __FUNCTION__);
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
        return $this->_data($number, $count, __FUNCTION__);
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
        return $this->_data($number, $count, __FUNCTION__);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Data
    //--------------------------------------------------------------------------------------------------------
    // 
    // @param string $number
    // @param int    $count
    // @param string $type: average, down, up
    //
    //--------------------------------------------------------------------------------------------------------
    protected function _data($number, $count, $type)
    {
        if( is_int($number) )
        { 
            return $number;
        }
        
        if( $type === 'average' )
        {
            return round($number, $count);
        }
        
        if( $type === 'down' )
        {
            if( $count == 0 ) 
            {
                return floor($number);  
            }
            
            $numbers = explode(".", $number);
            
            $edit = 0;
            
            if( ! empty($numbers[1]) )
            {
                $edit = substr($numbers[1], 0, $count);
                
                return (float)$numbers[0].".".$edit;
            }
        }
        if( $type === 'up' )
        {
            if($count == 0)
            { 
                return ceil($number);
            }
            
            $numbers = explode(".", $number);
            
            $edit = 0;
            
            if( ! empty($numbers[1]) )
            {
                $edit = substr($numbers[1], 0, $count);
                
                return (float)$numbers[0].".".($edit + 1);
            }   
        }       
    }
}