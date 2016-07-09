<?php
namespace ZN\ViewObjects\Sheet\Helpers;

use ZN\ViewObjects\SheetTrait;

class Animation
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
	
	use \CallUndefinedMethodTrait;

	/******************************************************************************************
	* ANIMATION NAME                                                                          *
	*******************************************************************************************
	| Genel Kullanım: animation-name nesnesine ait verilecek isim bilgisi.    		  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @name  => Animasyon ismi.		     			      					  |
	|          																				  |
	| Örnek Kullanım: ->name('animasyon') 		  									  		  |
	|          																				  |
	******************************************************************************************/
	public function name($name = '')
	{
		if( ! is_scalar($name) )
		{
			\Errors::set('Error', 'valueParameter', 'name');
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-name:$name;".EOL);
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION DIRECTION                                                                     *
	*******************************************************************************************
	| Genel Kullanım: animation-directon nesnesinin kullanımıdır.    		  		 		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @direction => Animasyonun yönü. Varsayılan:reverse    					  |
	|          																				  |
	| Örnek Kullanım: ->direction('reverse') 		  									  	  |
	|          																				  |
	******************************************************************************************/
	public function direction($direction = 'reverse')
	{
		if( ! is_scalar($direction) )
		{
			\Errors::set('Error', 'valueParameter', 'direction');
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-direction:$direction;".EOL);
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION PLAY STATE                                                                    *
	*******************************************************************************************
	| Genel Kullanım: animation-play-state nesnesinin kullanımıdır.    		  		 		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @status => Animasyonun oynatılma durumu.			   					  |
	|          																				  |
	| Örnek Kullanım: ->status('pause') 		  									  	 	  |
	|          																				  |
	******************************************************************************************/
	public function status($status = '')
	{
		if( ! is_scalar($status) )
		{
			\Errors::set('Error', 'valueParameter', 'status');
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-play-state:$status;".EOL);
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION FILL MODE                                                                     *
	*******************************************************************************************
	| Genel Kullanım: animation-fill-mode kullanımıdır.    		  		 		  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @fill => Özellik bilgisi.			   					  	  			  |
	|          																				  |
	| Örnek Kullanım: ->fill() 		  									  	 	 		      |
	|          																				  |
	******************************************************************************************/
	public function fill($fill = '')
	{
		if( ! is_scalar($fill) )
		{
			\Errors::set('Error', 'valueParameter', 'fill');
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-fill-mode:$fill;".EOL);
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION ITERATION COUNT                                                               *
	*******************************************************************************************
	| Genel Kullanım: animation-iteration-count kullanımıdır.    				  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. numeric var @repeat => Tekrar bilgisi.			   					  	  			  |
	|          																				  |
	| Örnek Kullanım: ->repeat(2) 		  									  	 	 		  |
	|          																				  |
	******************************************************************************************/
	public function repeat($repeat = '')
	{
		if( ! is_scalar($repeat) )
		{
			\Errors::set('Error', 'valueParameter', 'repeat');
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-iteration-count:$repeat;".EOL);
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION DURATION                                                                      *
	*******************************************************************************************
	| Genel Kullanım: animation-duration kullanımıdır.    				  			  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @duration => Süre bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->duration(2) 		  									  	 	 	  |
	|          																				  |
	******************************************************************************************/
	public function duration($duration = '')
	{
		if( ! is_scalar($duration) )
		{
			\Errors::set('Error', 'valueParameter', 'duration');
			return $this;	
		}
		
		if(is_numeric($duration))
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("animation-duration:$duration;".EOL);
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION DELAY                                                                         *
	*******************************************************************************************
	| Genel Kullanım: animation-delay kullanımıdır.    				  			  		      |
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
			\Errors::set('Error', 'valueParameter', 'delay');
			return $this;	
		}
		
		if( is_numeric($delay) )
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("animation-delay:$delay;".EOL);
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION TIMING FUNCTION                                                               *
	*******************************************************************************************
	| Genel Kullanım: animation-timing-function kullanımıdır.    				  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @easing => Animasyon türü bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->easing('ease-in-out') 		  									  	  |
	|          																				  |
	******************************************************************************************/
	public function easing($easing = '')
	{
		if( ! is_scalar($easing) )
		{
			\Errors::set('Error', 'valueParameter', 'easing');
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-timing-function:$easing;".EOL);
		
		return $this;
	}
}