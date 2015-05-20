<?php
/************************************************************/
/*                    COMPONENT  ANIMATE                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
require_once(SYSTEM_COMPONENTS_DIR.'Jquery/Objects.php');
/******************************************************************************************
* ANIMATE                                                                                 *
*******************************************************************************************
| Dahil(Import) Edilirken : Jquery/Animate     							     			  |
| Sınıfı Kullanırken      :	$this->animate->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentJqueryAnimate extends ComponentJqueryObjects
{
	/* Easing Variables
	 * Easing 
	 * easeIn, ease ...
	 *
	 * 
	 */
	protected $easing = array();
	
	/* Callback Variables
	 * Data Function
	 * alert("example");
	 *
	 * function(data){alert("example");}
	 */
	protected $callback = '';
	
	/* Selector Variables
	 * Selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	protected $selector = 'this';
	
	/* Attributes Variables
	 * Attributes 
	 * 
	 *
	 * {key:val} 
	 */
	protected $attr = '';
	
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
	public function speed($duration = '')
	{
		if(is_value($duration))
		{
			$this->easing['duration'] = $duration;
		}
		else
		{
			return $this;
		}
		
		return $this;
	}
	
	/* Speed Or Duration Function
	 * Duration 
	 * 1000, slow, fast
	 *
	 * 
	 */
	public function duration($duration = '')
	{
		if(is_value($duration))
		{
			$this->easing['duration'] = $duration;
		}
		else
		{
			return $this;
		}
		
		return $this;
	}
	
	public function queue($queue = true)
	{
		if(is_bool($queue))
		{
			$queue = $this->_booltostr($queue);	
		}
		elseif(is_string($queue))
		{
			$queue = $queue;
		}
		else
		{
			return $this;
		}
		
		$this->easing['queue'] = $queue;
		
		return $this;	
	}
	
	public function callback($params = '', $callback = '')
	{
		if( ! is_string($callback))
		{
			return $this;	
		}
		
		$this->callback = ",\n\t\tfunction($params){".$callback."}";
		
		return $this;
	}
	
	public function func($params = '', $callback = '')
	{
		if( ! is_string($callback))
		{
			return $this;	
		}
		
		$this->callback = ",\n\t\tfunction($params){".$callback."}";
		
		return $this;
	}
	
	public function attr($attr = '')
	{
		if( ! is_array($attr))
		{
			return $this;	
		}
		
		$this->attr = $this->_object($attr);	
		
		return $this;
	}
	
	public function easing($easing = '')
	{	
		$this->easing['easing'] = $easing;	
		
		return $this;
	}
	
	public function special_easing($special_easing = '')
	{	
		$this->easing['specialEasing'] = $this->_object($special_easing);	
		
		return $this;
	}
	
	public function step($params = 'now, fx', $step = '')
	{	
		$this->easing['step'] = "function($params){".$step."}";	
		
		return $this;
	}
	
	public function complete()
	{
		$animatemid = '';
		$animate  = ".animate\n\t(";
		if( ! empty($this->attr))     $animatemid .= "\n\t".$this->attr;
		if( ! empty($this->speed))    $animatemid .= $this->speed;
		if( ! empty($this->easing))	  $animatemid .= ",\n\t".$this->_object($this->easing);
		if( ! empty($this->callback)) $animatemid .= $this->callback;
		$animate .= trim($animatemid, ',');
		$animate .= "\n\t)";
		
		$this->_default_variable();
		
		return $animate;
	}
	
	public function create()
	{
		$combine_animation = func_get_args();
		
		$animate  = "\n\t$($this->selector)";
		
		$animate .= $this->complete();
		
		if( ! empty($combine_animation))foreach($combine_animation as $animation)
		{			
			$animate .= $animation;
		}
	
		$animate .= ";\n";
			
		return $animate;
	}
	
	protected function _default_variable()
	{
		if( ! empty($this->easing)) 	$this->easing = array();
		if( ! empty($this->callback))  	$this->callback = '';
		if($this->selector !== 'this')  $this->selector = 'this';
		if( ! empty($this->attr))  		$this->attr = '';
	}
}