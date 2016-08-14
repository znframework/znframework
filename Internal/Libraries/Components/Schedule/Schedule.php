<?php namespace ZN\Components;

class InternalSchedule extends \CallController implements ScheduleInterface
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
	// Create
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param array $data
	//
	//--------------------------------------------------------------------------------------------------------
	public function create(Array $data) : String
	{ 			
		return $this->_element($data, '', 0);
	}
	
	//--------------------------------------------------------------------------------------------------------
	// Protected Element
	//--------------------------------------------------------------------------------------------------------
	// 
	// @param mixed   $data
	// @param string  $tab
	// @param numeric $data
	//
	//--------------------------------------------------------------------------------------------------------
	protected function _element($data, $tab, $start)
	{
		static $start;
		
		$eof 	 = EOL;
		$output  = '';
		$attrs 	 = '';
		$tab 	 = str_repeat("\t", $start);
		
		if( ! is_array($data) )
		{
			return $data.$eof;	
		}
		else
		{
			foreach( $data as $k => $v )
			{
				if( is_numeric($k) )
				{
					$k = 'li';
				}	
				
				$end = "/".\Arrays::getFirst(explode(' ', $k));
				
				if( ! is_array($v) )
				{			
					$output .= "$tab<$k>$v<$end>$eof";
				}
				else
				{
					$output .= $tab."<$k>$eof".$this->_element($v, $tab, $start++).$tab."<$end>".$tab.$eof;	
					$start--;
				}
			}
		}
		
		return $output;
	}	
}