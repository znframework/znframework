<?php
/************************************************************/
/*                    ANIMATION COMPONENT                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class ComponentCssAnimation
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
	
	public function name($name = '')
	{
		if( ! is_value($name))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-name:$name;\n");
		
		return $this;
	}
	
	public function direction($name = 'reverse')
	{
		if( ! is_value($name))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-direction:$name;\n");
		
		return $this;
	}
	
	public function status($status = '')
	{
		if( ! is_value($status))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-play-state:$status;\n");
		
		return $this;
	}
	
	public function fill($name = '')
	{
		if( ! is_value($name))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-fill-mode:$name;\n");
		
		return $this;
	}
	
	
	public function repeat($repeat = '')
	{
		if( ! is_value($repeat))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-iteration-count:$repeat;\n");
		
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
		
		$this->transitions .= $this->_transitions("animation-duration:$duration;\n");
		
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
		
		$this->transitions .= $this->_transitions("animation-delay:$delay;\n");
		
		return $this;
	}
	
	public function easing($easing = '')
	{
		if( ! is_value($easing))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-timing-function:$easing;\n");
		
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