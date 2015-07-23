<?php
class __USE_STATIC_ACCESS__CJquery extends CJqueryCommon
{
	/***********************************************************************************/
	/* JQUERY COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CJquery
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->cjquery, zn::$use->cjquery, uselib('cjquery')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
		if( ! isChar($selector) )
		{
			Error::set('CJquery', 'selector', lang('Error', 'valueParameter', 'selector'));
			return $this;	
		}
		
		if( $this->_isKeySelector($selector) )
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
		if( ! is_string($property) )
		{
			Error::set('CJquery', 'property', lang('Error', 'stringParameter', 'property'));
			return $this;	
		}
		
		$this->property = $property;
		
		if( ! empty($attr) ) 
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
		if( ! empty($this->property) ) $complete .= ".".$this->property;
		$complete .= "(";
		if( ! empty($this->attr) ) { $complete .= $this->attr; $comma = ', ';} else { $comma = ''; }
		if( ! empty($this->func) ) $complete .= $comma.$this->func;
		$complete .= ")";
		
		$this->_defaultVariable();
		
		return $complete;
	}
	
	public function create()
	{
		$combineFunction = func_get_args();
		
		$complete  = eol()."\t$($this->selector)";
		
		$complete .= $this->complete();
		
		if( ! empty($combineFunction)) foreach( $combineFunction as $function )
		{			
			$complete .= $function;
		}
		
		$complete .= ";";
		
		return $complete;	
	}
	
	protected function _defaultVariable()
	{
		if($this->selector !== 'this') 	$this->selector = 'this';
		if($this->property !== '')  	$this->property = '';
		if($this->func !== '')  		$this->func = '';
		if($this->attr !== '')  		$this->attr = '';
	}
}