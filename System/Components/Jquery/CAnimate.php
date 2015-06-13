<?php
/************************************************************/
/*                    COMPONENT  ANIMATE                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Jquery;

require_once(COMPONENTS_DIR.'Jquery/Common.php');

use Jquery\ComponentJqueryCommon;
/******************************************************************************************
* ANIMATE                                                                                 *
*******************************************************************************************
| Dahil(Import) Edilirken : CAnimate     							     			 	  |
| Sınıfı Kullanırken      :	$this->canimate->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class CAnimate extends ComponentJqueryCommon
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
		if( ! isChar($selector))
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
		if(isValue($duration))
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
		if(isValue($duration))
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
		
		$this->callback = ",".eof()."\t\tfunction($params){".$callback."}";
		
		return $this;
	}
	
	public function func($params = '', $callback = '')
	{
		if( ! is_string($callback))
		{
			return $this;	
		}
		
		$this->callback = ",".eof()."\t\tfunction($params){".$callback."}";
		
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
	
	public function specialEasing($special_easing = '')
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
		$animate  = ".animate".eof()."\t(";
		if( ! empty($this->attr))     $animatemid .= eof()."\t".$this->attr;
		if( ! empty($this->speed))    $animatemid .= $this->speed;
		if( ! empty($this->easing))	  $animatemid .= ",".eof()."\t".$this->_object($this->easing);
		if( ! empty($this->callback)) $animatemid .= $this->callback;
		$animate .= trim($animatemid, ',');
		$animate .= eof()."\t)";
		
		$this->_default_variable();
		
		return $animate;
	}
	
	public function create()
	{
		$combine_animation = func_get_args();
		
		$animate  = eof()."\t$($this->selector)";
		
		$animate .= $this->complete();
		
		if( ! empty($combine_animation))foreach($combine_animation as $animation)
		{			
			$animate .= $animation;
		}
	
		$animate .= ";".eof();
			
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