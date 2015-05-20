<?php
/************************************************************/
/*                   TRANSITION COMPONENT                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* TRANSITION                                                                              *
*******************************************************************************************
| Dahil(Import) Edilirken : Css/Transition   		     							      |
| Sınıfı Kullanırken      :	$this->transition->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentCssTransition
{
	protected $easing;
	
	/* Selector Variables
	 * Selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	protected $selector = 'this';
	protected $attr;
	protected $transitions = '';
	

	public function __construct()
	{
		$this->browsers = config::get('Css3', 'browsers');	
	}
	
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

		$this->selector = $selector;	
	
		return $this;
	}
	
	public function attr($_attributes = array())
	{
		$attribute = "";
		if(is_array($_attributes))
		{
			foreach($_attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.':'.$values.';';
			}	
		}
		
		$this->attr = $attribute;
		
		return $this;	
	}
	
	public function property($property = '')
	{
		if( ! is_value($property))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-property:$property;\n");
		
		return $this;
	}
	
	public function duration($duration = '')
	{
		if( ! is_value($duration))
		{
			return $this;	
		}
		
		if(is_numeric($duration))
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-duration:$duration;\n");
		
		return $this;
	}
	
	public function delay($delay = '')
	{
		if( ! is_value($delay))
		{
			return $this;	
		}
		
		if(is_numeric($delay))
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-delay:$delay;\n");
		
		return $this;
	}
	
	public function easing($easing = '')
	{
		if( ! is_value($easing))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-timing-function:$easing;\n");
		
		return $this;
	}
	
	public function _transitions($data)
	{
		$transitions = "";
		foreach($this->browsers as $val)
		{
			$transitions .= "$val$data";
		}
		
		return "\n".$transitions;
	}
	
	public function complete()
	{
		$trans = $this->transitions;	
		$this->_default_variable();
		return $trans;
	}
	
	public function create()
	{
		$combine_transitions = func_get_args();
		
		$str  = $this->selector."{\n";	
		$str .= $this->attr."\n";
		$str .= $this->complete();
		if( ! empty($combine_transitions))foreach($combine_transitions as $transition)
		{			
			$str .= $transition;
		}
	
		$str .= "}\n";
		
		return $str;
	}
	
	protected function _default_variable()
	{
		if( ! empty($this->attr)) 		$this->attr = NULL;
		if( ! empty($this->transitions))$this->transitions = '';
		if($this->selector !== 'this')  $this->selector = 'this';
	}
}