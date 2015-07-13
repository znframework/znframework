<?php
class CAction extends CJqueryCommon
{
	/***********************************************************************************/
	/* ACTION COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CAction
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->caction, zn::$use->caction, uselib('caction')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Selector Variables
	 * Selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	protected $selector = 'this';
	
	/* Type Variables
	 * Effect Types
	 * show, slideUp, fadeIn, ...
	 *
	 * .show(), .slideUp(), .fadeIn() ...
	 */
	protected $type		= 'show';
	
	/* Callback Variables
	 * Data Function
	 * alert("example");
	 *
	 * function(data){alert("example");}
	 */
	protected $callback = '';
	
	/* Speed Variables
	 * Speed 
	 * 1000, slow, fast
	 *
	 * 
	 */
	protected $speed 	= '';
	
	/* Easing Variables
	 * Easing 
	 * easeIn, ease ...
	 *
	 * 
	 */
	protected $easing   = '';
	
	/* Selector Function
	 * Params: string @selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	public function selector($selector = '')
	{
		if( ! isChar($selector))
		{
			return $this;	
		}
		
		if($this->_isKeySelector($selector))
		{
			$this->selector = $selector;	
		}
		else
		{
			$this->selector = "\"$selector\"";	
		}
		return $this;
	}
	
	/* Speed Function
	 * Speed 
	 * 1000, slow, fast
	 *
	 * 
	 */
	public function speed($data = '')
	{
		if( ! isValue($data))
		{
			return $this;	
		}
		
		if( ! is_numeric($data))
		{
			$this->speed = "\"$data\"";
		}
		else
		{
			$this->speed = $data;
		}
		
		return $this;
	}
	
	/* Speed Or Duration Function
	 * Duration 
	 * 1000, slow, fast
	 *
	 * 
	 */
	public function duration($data = '')
	{
		if( ! isValue($data))
		{
			return $this;	
		}
		
		if( ! is_numeric($data))
		{
			$this->speed = "\"$data\"";
		}
		else
		{
			$this->speed = $data;
		}
		
		return $this;
	}
	
	/* Easing Function
	 * Easing 
	 * easeIn, ease ...
	 *
	 * 
	 */
	public function easing($data = '')
	{
		if( ! isValue($data))
		{
			return $this;	
		}
			
		$this->easing = ", \"$data\"";
		
		return $this;
	}
	
	/* Type Function
	 * Effect Types
	 * show, slideUp, fadeIn, ...
	 *
	 * .show(), .slideUp(), .fadeIn() ...
	 */
 	public function type($type = 'show')
	{
		if( ! is_string($type))
		{
			return $this;	
		}
		
		$this->type = $type;
		
		return $this;
	}
	
	/* Protected Effect
	 * Params: string @type, string @selector, string @callback 
	 * 
	 *
	 * 
	 */
	protected function _effect($type = '', $selector = '', $callback = '')
	{
		$this->type = $type;
		
		if( ! empty($selector))
		{
			$this->selector($selector);	
		}
		
		if( ! empty($callback))
		{
			$this->callback('e', $callback);	
		}
	}
	
	public function show($selector = '', $callback = '')
	{
		$this->_effect('show', $selector, $callback);
		
		return $this;
	}
	
	public function hide($selector = '', $callback = '')
	{
		$this->_effect('hide', $selector, $callback);
		
		return $this;
	}
	
	public function fadeIn($selector = '', $callback = '')
	{
		$this->_effect('fadeIn', $selector, $callback);
		
		return $this;
	}
	
	public function fadeOut($selector = '', $callback = '')

	{
		$this->_effect('fadeOut', $selector, $callback);
		
		return $this;
	}
	
	public function fadeTo($selector = '', $callback = '')
	{
		$this->_effect('fadeTo', $selector, $callback);
		
		return $this;
	}
	
	public function slideUp($selector = '', $callback = '')
	{
		$this->_effect('slideUp', $selector, $callback);
		
		return $this;
	}
	
	public function slideDown($selector = '', $callback = '')
	{
		$this->_effect('slideDown', $selector, $callback);
		
		return $this;
	}
	
	public function slideToggle($selector = '', $callback = '')
	{
		$this->_effect('slideToggle', $selector, $callback);
		
		return $this;
	}
	
	public function callback($params = '', $callback = '')
	{
		if( ! is_string($callback))
		{
			return $this;	
		}
		
		$this->callback = ", function($params)".eol()."{".eol()."\t$callback".eol()."}";
		
		return $this;
	}
	
	public function func($params = '', $callback = '')
	{
		if( ! is_string($callback))
		{
			return $this;	
		}
		
		$this->callback = ", function($params)".eol()."{".eol()."\t$callback".eol()."}";
		
		return $this;
	}
	
	public function complete()
	{
		$eventMid = '';
		$event  = ".$this->type(";
		
		if( ! empty($this->speed))  	$eventMid .= $this->speed;
		if( ! empty($this->easing)) 	$eventMid .= $this->easing;
		if( ! empty($this->callback)) 	$eventMid .= $this->callback;
		$event .= trim($eventMid, ',');
		$event .= ")";
		$this->_defaultVariable();
		return $event;
	}
	
	public function create()
	{
		$combineEffect = func_get_args();
		
		$event  = eol()."$($this->selector)";
		$event .= $this->complete();
		
		if( ! empty($combineEffect) ) foreach($combineEffect as $effect)
		{			
			$event .= $effect;
		}
		
		$event .= ";";

		return $event;
	}
	
	protected function _defaultVariable()
	{
		if($this->selector !== 'this') 	$this->selector = 'this';
		if($this->type !== 'show')  	$this->type		= 'show';
		if($this->callback !== '')  	$this->callback = '';
		if($this->speed !== '')  		$this->speed 	= '';
		if($this->easing !== '')  		$this->easing   = '';	
	}
}