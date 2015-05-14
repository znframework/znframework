<?php
/************************************************************/
/*                    TRANSLATE COMPONENT                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class ComponentCss
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
	
	protected function _attr($_attributes = array())
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
	
	public function attr($attr = array())
	{		
		if( ! is_array($attr) )
		{
			return false;	
		}
		$this->_attr($attr);	
		
		$str  = $this->selector."{\n";	
		$str .= $this->attr."\n";
		$str .= "}\n";
		
		$this->_default_variable();
		
		return $str;
	}
	
	protected function _default_variable()
	{
		if( ! empty($this->attr)) 		$this->attr = NULL;
		if($this->selector !== 'this')  $this->selector = 'this';
	}
}