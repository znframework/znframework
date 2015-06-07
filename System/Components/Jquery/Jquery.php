<?php
/************************************************************/
/*                    COMPONENT  JQUERY                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
require_once(COMPONENTS_DIR.'Jquery/Common.php');
/******************************************************************************************
* JQUERY                                                                                  *
*******************************************************************************************
| Dahil(Import) Edilirken : Jquery     							     			     	  |
| Sınıfı Kullanırken      :	$this->jquery->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Jquery extends ComponentJqueryCommon
{
	/* Selector Variables
	 * Selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	protected $selector = 'this';
	
	/* Property Variables
	 * Property 
	 * css, attr, val
	 *
	 * $.css(), .attr(), .val()
	 */
	 
	protected $property = '';
	
	/* Callback Variables
	 * Data Function
	 * alert("example");
	 *
	 * function(data){alert("example");}
	 */
	protected $func = '';
	
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
	
	/* Property Function
	 * Params: string @property , array @attr
	 * this, #custom, .example
	 *
	 * .css(a,b,c), .attr(a,b,c), .val('deger')
	 */
	public function property($property = '', $attr = array())
	{
		if( ! is_string($property))
		{
			return $this;	
		}
		
		$this->property = $property;
		
		if( ! empty($attr)) 
		{
			$this->attr = $this->_params($attr);
		}
		return $this;
	}
	
	public function attr()
	{
		$arguments = func_get_args();
			
		$this->attr = $this->_params($arguments);
		
		return $this;
	}
	
	// Callback or func
	public function func($params = '', $func = '')
	{
		$this->func = "function($params){".$func."}";
		
		return $this;
	}
	
	// Callback or func
	public function callback($params = '', $func = '')
	{
		$this->func = "function($params){".$func."}";
		
		return $this;
	}
	
	public function complete()
	{
		$complete = '';
		if( ! empty($this->property)) $complete .= ".".$this->property;
		$complete .= "(";
		if( ! empty($this->attr)) { $complete .= $this->attr; $comma = ', ';} else { $comma = ''; }
		if( ! empty($this->func)) $complete .= $comma.$this->func;
		$complete .= ")";
		
		$this->_default_variable();
		
		return $complete;
	}
	
	public function create()
	{
		$combine_function = func_get_args();
		
		$complete  = ln()."\t$($this->selector)";
		
		$complete .= $this->complete();
		
		if( ! empty($combine_function))foreach($combine_function as $function)
		{			
			$complete .= $function;
		}
		
		$complete .= ";";
		
		return $complete;	
	}
	
	protected function _default_variable()
	{
		if($this->selector !== 'this') 	$this->selector = 'this';
		if($this->property !== '')  	$this->property = '';
		if($this->func !== '')  		$this->func = '';
		if($this->attr !== '')  		$this->attr = '';
	}
}