<?php
class CSSTransition
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use SheetTrait;
	
	use CallUndefinedMethodTrait;
	
	/******************************************************************************************
	* TRANSITION PROPERTY                                                                     *
	*******************************************************************************************
	| Genel Kullanım: transition-duration kullanımıdır.    				  			  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @property => Özellikler bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->property('color') 		  									  	 	 	  |
	|          																				  |
	******************************************************************************************/
	public function property($property = '')
	{
		if( ! is_scalar($property))
		{
			Error::set(lang('Error', 'valueParameter', 'property'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-property:$property;".eol());
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSITION DURATION                                                                     *
	*******************************************************************************************
	| Genel Kullanım: transition-duration kullanımıdır.    				  			  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @duration => Süre bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->duration(2) 		  									  	 	 	  |
	|          																				  |
	******************************************************************************************/
	public function duration($duration = '')
	{
		if( ! is_scalar($duration))
		{
			Error::set(lang('Error', 'valueParameter', 'duration'));
			return $this;	
		}
		
		if(is_numeric($duration))
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-duration:$duration;".eol());
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSITION DELAY                                                                         *
	*******************************************************************************************
	| Genel Kullanım: transition-delay kullanımıdır.    				  		  		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @delay => Geçikme bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->delay(2) 		  									  	 	 	  	  |
	|          																				  |
	******************************************************************************************/
	public function delay($delay = '')
	{
		if( ! is_scalar($delay) )
		{
			Error::set(lang('Error', 'valueParameter', 'delay'));
			return $this;	
		}
		
		if( is_numeric($delay) )
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-delay:$delay;".eol());
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSITION TIMING FUNCTION                                                              *
	*******************************************************************************************
	| Genel Kullanım: transition-timing-function kullanımıdır.    				  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @easing => Animasyon türü bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->easing('ease-in-out') 		  									  	  |
	|          																				  |
	******************************************************************************************/
	public function easing($easing = '')
	{
		if( ! is_scalar($easing))
		{
			Error::set(lang('Error', 'valueParameter', 'easing'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-timing-function:$easing;".eol());
		
		return $this;
	}
}