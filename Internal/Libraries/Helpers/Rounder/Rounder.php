<?php namespace ZN\Helpers;

class InternalRounder extends \CallController implements RounderInterface
{
	//----------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Data
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $number
	// @param int    $count
	// @param string $type: average, down, up
	//
	//----------------------------------------------------------------------------------------------------
	public function data(String $number, Int $count = 0, String $type = 'average') : Float
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

	//----------------------------------------------------------------------------------------------------
	// Up
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $number
	// @param int    $count
	//
	//----------------------------------------------------------------------------------------------------
	public function up(String $number, Int $count = 0) : Float
	{
		return $this->data($number, $count, __FUNCTION__);
	}

	//----------------------------------------------------------------------------------------------------
	// Down
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $number
	// @param int    $count
	//
	//----------------------------------------------------------------------------------------------------
	public function down(String $number, Int $count = 0) : Float
	{
		return $this->data($number, $count, __FUNCTION__);
	}

	//----------------------------------------------------------------------------------------------------
	// Average
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $number
	// @param int    $count
	//
	//----------------------------------------------------------------------------------------------------
	public function average(String $number, Int $count = 0) : Float
	{
		return $this->data($number, $count, __FUNCTION__);
	}
}