<?php
namespace ZN\ViewObjects\Jquery\Helpers;

use ZN\ViewObjects\JqueryTrait;

class Action
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use JqueryTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	/* 
	 * Özellik belirteci.
	 *
	 * .show(), .slideUp(), .fadeIn() ...
	 *
	 * @var string show
	 */
	protected $type		= 'show';
	
	/* 
	 * Hız bilgisi 
	 *
	 * 1000, slow, fast
	 *
	 * @var string 
	 */
	protected $speed 	= '';
	
	/* 
	 * Hareket bilgisi 
	 * 
	 * easeIn, ease ...
	 * 
	 * @var string
	 */
	protected $easing   = '';
	
	/******************************************************************************************
	* SPEED                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Animasyon hızı bilgisini oluşturulması için kullanılır.			      |
		
	  @param string $speed
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function speed($speed = '')
	{
		$this->speed = $speed;
		
		return $this;
	}
	
	/******************************************************************************************
	* DURATION                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Speed işlevinin bir diğer ismidir.								      |
		
	  @param string $speed
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function duration($speed = '')
	{
		$this->speed($speed);
		
		return $this;
	}
	
	/******************************************************************************************
	* EASING                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Hareketin animasyon türünü belirlemek için kullanılır.			      |
		
	  @param string $data easeInOut...
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function easing($data = '')
	{
		$this->easing = $data;
		
		return $this;
	}
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Hareketin türünü belirlemek için kullanılır.						      |
		
	  @param string $type show, hide, slideUp, slideDown ...
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
 	public function type($type = 'show')
	{
		if( ! is_string($type))
		{
			\Errors::set('Error', 'stringParameter', 'type');
			return $this;	
		}
		
		$this->type = $type;
		
		return $this;
	}
	
	/******************************************************************************************
	* PROTECTED EFFECT                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Efekt türlerini ayarlamak için oluşturulmuş temel işlevdir.   	      |
		
	  @param string $type
	  @param string $selector
	  @param string $callback
	  
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _effect($type = '', $selector = '', $speed = '', $callback = '')
	{
		$this->type = $type;
		
		if( ! empty($selector))
		{
			$this->selector($selector);	
		}
		
		if( ! empty($speed))
		{
			$this->speed($speed);	
		}
		
		if( ! empty($callback))
		{
			$this->callback('e', $callback);	
		}
	}
	
	/******************************************************************************************
	* SHOW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Show animasyonun kullanımını sağlar.								      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function show($selector = '', $speed = '', $callback = '')
	{
		$this->_effect('show', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* HIDE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Hide animasyonun kullanımını sağlar.								      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function hide($selector = '', $speed = '', $callback = '')
	{
		$this->_effect('hide', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* FADE IN                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Fade in animasyonun kullanımını sağlar.   						      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function fadeIn($selector = '', $speed = '', $callback = '')
	{
		$this->_effect('fadeIn', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* FADE OUT                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Fade out animasyonun kullanımını sağlar.	    					      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function fadeOut($selector = '', $speed = '', $callback = '')

	{
		$this->_effect('fadeOut', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* FADE TO                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Fade to animasyonun kullanımını sağlar.							      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function fadeTo($selector = '', $speed = '', $callback = '')
	{
		$this->_effect('fadeTo', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* SLIDE UP                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Slide up animasyonun kullanımını sağlar.	    					      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function slideUp($selector = '', $speed = '', $callback = '')
	{
		$this->_effect('slideUp', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* SLIDE DOWN                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Slide down animasyonun kullanımını sağlar.	    				      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function slideDown($selector = '', $speed = '', $callback = '')
	{
		$this->_effect('slideDown', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* SLIDE TOGGLE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Slide toggle animasyonun kullanımını sağlar.				    	      |
		
	  @param string $selector
	  @param string $callback 
	  
	  @return $this
	|          																				  |
	******************************************************************************************/
	public function slideToggle($selector = '', $speed = '', $callback = '')
	{
		$this->_effect('slideToggle', $selector, $speed, $callback);
		
		return $this->create();
	}
	
	/******************************************************************************************
	* COMPLETE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Bağlantılı dizge oluşturmak istenirse dizge bu yöntem ile sonlandırılır.|
		
	  @param string $void
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function complete()
	{
		$event = \JQ::property($this->type, [$this->speed, $this->easing, $this->callback]);
		
		$this->_defaultVariable();
		
		return $event;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizgeyi tamamlayıp oluşturmak için kullanılan nihai yöntemdir.	      |
		
	  @param string arguments $complete1, $complete2 ... $completeN
	  
	  @return $string
	|          																				  |
	******************************************************************************************/
	public function create(...$args)
	{
		$combineEffect = $args;
		
		$event  = EOL.\JQ::selector($this->selector);
		$event .= $this->complete();
		
		if( ! empty($combineEffect) ) foreach($combineEffect as $effect)
		{			
			$event .= $effect;
		}
		
		$event .= ";";

		return $this->_tag($event);
	}
	
	/******************************************************************************************
	* PROTECTED DEFAULT VARIABLE                                                              *
	*******************************************************************************************
	| Genel Kullanım: Değişkenlerin var sayılan ayarlarına dönmeleri sağlanır.     		      |
		
	  @param void
	  
	  @return void
	|          																				  |
	******************************************************************************************/
	protected function _defaultVariable()
	{
		$this->selector = 'this';
		$this->type		= 'show';
		$this->callback = '';
		$this->speed 	= '';
		$this->easing   = '';	
	}
}