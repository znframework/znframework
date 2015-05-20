<?php
/************************************************************/
/*                     SHADOW COMPONENT                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SHADOW                                                                                  *
*******************************************************************************************
| Dahil(Import) Edilirken : Css/Shadow   		     							          |
| Sınıfı Kullanırken      :	$this->shadow->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentCssShadow
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
	protected $params = array();
	

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
	
	public function x($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = $val."px";
		}
		
		$this->params['horizontal'] = $val;
		
		return $this;
	}
	
	public function horizontal($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = $val."px";
		}
		
		$this->params['horizontal'] = $val;
		
		return $this;
	}
	
	public function y($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = $val."px";
		}
		
		$this->params['vertical'] = $val;
		
		return $this;
	}
	
	public function vertical($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = $val."px";
		}
		
		$this->params['vertical'] = $val;
		
		return $this;
	}
	
	public function blur($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = $val."px";
		}
		
		$this->params['blur'] = $val;
		
		return $this;
	}
	
	public function diffusion($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = $val."px";
		}
		
		$this->params['spread'] = $val;
		
		return $this;
	}
	
	public function spread($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = $val."px";
		}
		
		$this->params['spread'] = $val;
		
		return $this;
	}
	
	public function color($val = '')
	{
		if( ! is_value($val))
		{
			return $this;	
		}
		
		if(is_numeric($val))
		{
			$val = "#".$val;
		}
		
		$this->params['color'] = $val;
		
		return $this;
	}
		
	public function create()
	{
		$combine_transitions = func_get_args();
		
		$str  = $this->selector."{\n";	
		$str .= $this->attr."\n";
		
		$shadow = 	"box-shadow:".
					$this->params['horizontal']." ".
					$this->params['vertical']." ".
					$this->params['blur']." ".
					$this->params['spread']." ".
					$this->params['color'].";".
		$browser = '';			
		foreach($this->browsers as $val)
		{
			$str .= $val.$shadow."\n";
		}
		$str .= "}\n";
		
		return $str;
	}
	
	protected function _default_variable()
	{
		if( ! empty($this->attr)) 		$this->attr = NULL;
		if( ! empty($this->params))		$this->params = array();
		if($this->selector !== 'this')  $this->selector = 'this';
	}
}