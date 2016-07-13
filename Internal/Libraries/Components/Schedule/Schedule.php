<?php
namespace ZN\Components;

class InternalSchedule implements ScheduleInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Create
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $data
	//
	//----------------------------------------------------------------------------------------------------
	public function create($data = [])
	{ 			
		return $this->_element($data, '', 0);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Element
	//----------------------------------------------------------------------------------------------------
	// 
	// @param mixed   $data
	// @param string  $tab
	// @param numeric $data
	//
	//----------------------------------------------------------------------------------------------------
	protected function _element($data = '', $tab = '', $start = 0)
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