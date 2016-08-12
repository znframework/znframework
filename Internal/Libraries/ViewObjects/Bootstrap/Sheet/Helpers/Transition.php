<?php
namespace ZN\ViewObjects\Sheet\Helpers;

use ZN\ViewObjects\SheetTrait;

class Transition extends \CallController
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
	// Style Sheet Trait
	//----------------------------------------------------------------------------------------------------
	// 
	// methods
	//
	//----------------------------------------------------------------------------------------------------
	use SheetTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Property
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $property
	//
	//----------------------------------------------------------------------------------------------------
	public function property(String $property) : Transition
	{
		$this->transitions .= $this->_transitions("transition-property:$property;".EOL);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Duration
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $duration
	//
	//----------------------------------------------------------------------------------------------------
	public function duration(String $duration) : Transition
	{
		if( is_numeric($duration) )
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-duration:$duration;".EOL);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delay
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $delay
	//
	//----------------------------------------------------------------------------------------------------
	public function delay(String $delay) : Transition
	{
		if( is_numeric($delay) )
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-delay:$delay;".EOL);
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Easing
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $easing
	//
	//----------------------------------------------------------------------------------------------------
	public function easing(String $easing) : Transition
	{
		$this->transitions .= $this->_transitions("transition-timing-function:$easing;".EOL);
		
		return $this;
	}
}