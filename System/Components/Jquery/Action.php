<?php
/************************************************************/
/*                    COMPONENT  ACTION                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
require_once(COMPONENTS_DIR.'Jquery/Common.php');
/******************************************************************************************
* ACTION                                                                                  *
*******************************************************************************************
| Dahil(Import) Edilirken : Jquery/Action     							     			  |
| Sınıfı Kullanırken      :	$this->action->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Action extends ComponentJqueryCommon
{
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
		if( ! is_char($selector))
		{
			return $this;	
		}
		
		if($this->_is_key_selector($selector))
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
		if( ! is_value($data))
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
		if( ! is_value($data))
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
		if( ! is_value($data))
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
	
	public function fadein($selector = '', $callback = '')
	{
		$this->_effect('fadeIn', $selector, $callback);
		
		return $this;
	}
	
	public function fadeout($selector = '', $callback = '')
	{
		$this->_effect('fadeOut', $selector, $callback);
		
		return $this;
	}
	
	public function fadeto($selector = '', $callback = '')
	{
		$this->_effect('fadeTo', $selector, $callback);
		
		return $this;
	}
	
	public function slideup($selector = '', $callback = '')
	{
		$this->_effect('slideUp', $selector, $callback);
		
		return $this;
	}
	
	public function slidedown($selector = '', $callback = '')
	{
		$this->_effect('slideDown', $selector, $callback);
		
		return $this;
	}
	
	public function slidetoggle($selector = '', $callback = '')
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
		
		$this->callback = ", function($params)".ln()."{".ln()."\t$callback".ln()."}";
		
		return $this;
	}
	
	public function func($params = '', $callback = '')
	{
		if( ! is_string($callback))
		{
			return $this;	
		}
		
		$this->callback = ", function($params)".ln()."{".ln()."\t$callback".ln()."}";
		
		return $this;
	}
	
	public function complete()
	{
		$eventmid = '';
		$event  = ".$this->type(";
		
		if( ! empty($this->speed))  	$eventmid .= $this->speed;
		if( ! empty($this->easing)) 	$eventmid .= $this->easing;
		if( ! empty($this->callback)) 	$eventmid .= $this->callback;
		$event .= trim($eventmid, ',');
		$event .= ")";
		$this->_default_variable();
		return $event;
	}
	
	public function create()
	{
		$combine_effect = func_get_args();
		
		$event  = ln()."$($this->selector)";
		$event .= $this->complete();
		
		if( ! empty($combine_effect))foreach($combine_effect as $effect)
		{			
			$event .= $effect;
		}
		
		$event .= ";";

		return $event;
	}
	
	protected function _default_variable()
	{
		if($this->selector !== 'this') 	$this->selector = 'this';
		if($this->type !== 'show')  	$this->type		= 'show';
		if($this->callback !== '')  	$this->callback = '';
		if($this->speed !== '')  		$this->speed 	= '';
		if($this->easing !== '')  		$this->easing   = '';	
	}
}