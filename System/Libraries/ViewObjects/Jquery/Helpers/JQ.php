<?php
class __USE_STATIC_ACCESS__JQ
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use JqueryTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Selector
	//----------------------------------------------------------------------------------------------------
	//
	// Seçici belirtmek için kullanılır.
	//
	// @param  string $selector
	// @return string 
	//
	//----------------------------------------------------------------------------------------------------
	public function selector($selector = '')
	{
		if( ! isChar($selector) )
		{
			Error::set('Error', 'valueParameter', 'selector');
			return $this;	
		}
		
		if( empty($selector) )
		{
			$selector = 'this';	
		}
		
		if( $this->_isKeySelector($selector) )
		{
			$code = $selector;	
		}
		else
		{
			$code = "\"".$this->_nailConvert($selector)."\"";	
		}
		
		return "$($code)";
	}
	
	//----------------------------------------------------------------------------------------------------
	// Property
	//----------------------------------------------------------------------------------------------------
	//
	// Jquery propertisi oluşturmak için kullanılır.
	//
	// @param string $property
	// @param array  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function property($property = '', $params = array(), $comma = false)
	{
		if( ! is_string($property) || empty($property) )
		{
			return Error::set('Error', 'stringParameter', 'property');	
		}

		return ".$property(". $this->_params($params).")".($comma === true ? ";" : "");
	}
	
	//----------------------------------------------------------------------------------------------------
	// Func
	//----------------------------------------------------------------------------------------------------
	//
	// Jquery fonksiyonu oluşturmak için kullanılır.
	//
	// @param string $params
	// @param string $code
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function func($params = '', $code = '', $comma = false)
	{
		if( empty($code) )
		{
			return false;	
		}
		
		return "function($params){".$code."}".($comma === true ? ";" : "");
	}
	
	//----------------------------------------------------------------------------------------------------
	// Callback / Func
	//----------------------------------------------------------------------------------------------------
	//
	// Jquery fonksiyonu oluşturmak için kullanılır.
	//
	// @param string $params
	// @param string $code
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function callback($params = '', $code = '', $comma = false)
	{
		return $this->func($params, $code, $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Combine
	//----------------------------------------------------------------------------------------------------
	//
	// Genel jquery komutu oluşturmak için kullanılır.
	//
	// @param string $selector
	// @param string $property
	// @param array  $params
	// @param string $callback
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function combine($selector = '', $property = '', $params = '', $callback = '', $comma = false)
	{
		if( ! empty($callback) )
		{
			$params[] = array($this->func('e', $callback));
		}
		
		$select = '';
		
		if( ! empty($selector) )
		{
			$select = $this->selector($selector);	
		}
		
		return $select.$this->property($property, $params, $comma);		   
	}
	
	//----------------------------------------------------------------------------------------------------
	// Serialize
	//----------------------------------------------------------------------------------------------------
	//
	// Genel jquery serialize komutu oluşturmak için kullanılır.
	//
	// @param string $selector
	// @param array  $func
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function serialize($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'serialize', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Serialize Array
	//----------------------------------------------------------------------------------------------------
	//
	// Genel jquery serialize komutu oluşturmak için kullanılır.
	//
	// @param string $selector
	// @param array  $func
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function serializeArray($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'serializeArray', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// To Json
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $params
	// @param  boole  $comma
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function toJson($params = array(), $comma = true)
	{
		return '$'.$this->property('toJSON', $params, $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Json
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $params
	// @param  boole  $comma
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function getJson($params = array(), $comma = true)
	{
		return '$'.$this->property('getJSON', $params, $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Get Script
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $params
	// @param  boole  $comma
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function getScript($params = array(), $comma = true)
	{
		return '$'.$this->property('getScript', $params, $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Param
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $params
	// @param  boole  $comma
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function param($params = array(), $comma = true)
	{
		return '$'.$this->property('param', $params, $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// noConflict
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $params
	// @param  boole  $comma
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function noConflict($params = array(), $comma = true)
	{
		return '$'.$this->property('noConflict', $params, $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// get
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $params
	// @param  boole  $comma
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function get($url = '', $callback = '', $comma = true)
	{
		$params[] = $url;
		$params[] = $callback;
		return '$'.$this->property('get', $params, $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// post
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $params
	// @param  boole  $comma
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function post($url = '', $data = '', $callback = '', $comma = true)
	{
		$params[] = $url;
		$params[] = $data;
		$params[] = $callback;
		return '$'.$this->property('post', $params, $comma);
	}
			
	//----------------------------------------------------------------------------------------------------
	// Text
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function text($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'text', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Val
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function val($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'val', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Html
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function html($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'html', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Attr
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function attr($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'attr', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Append
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function append($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'append', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Prepend
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function prepend($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'prepend', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// After
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function after($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'after', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Before
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function before($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'before', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Remove
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function remove($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'remove', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Free
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function free($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'empty', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Add Class
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function addClass($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'addClass', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Remove Class
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function removeClass($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'removeClass', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Toggle Class
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function toggleClass($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'toggleClass', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Css
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function css($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'css', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Width
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function width($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'width', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Height
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function height($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'height', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Inner Width
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function innerWidth($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'innerWidth', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Inner Height
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function innerHeight($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'innerHeight', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Outher Width
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function outerWidth($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'outerWidth', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Outher Height
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function outerHeight($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'outerHeight', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Parent
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function parent($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'parent', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Parents
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function parents($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'parents', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Parents Until
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function parentsUntil($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'parentsUntil', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Children
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function children($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'children', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Find
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function find($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'find', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Siblings
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function siblings($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'siblings', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Next
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function next($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'next', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// nextAll
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function nextAll($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'nextAll', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// nextUntil
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function nextUntil($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'nextUntil', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// prev
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function prev($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'prev', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// prevAll
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function prevAll($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'prevAll', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// prevUntil
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function prevUntil($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'prevUntil', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// first
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function first($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'first', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// last
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function last($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'last', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// eq
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function eq($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'eq', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// filter
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function filter($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'filter', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// not
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function not($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'not', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// load
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function load($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'load', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// data
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function data($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'data', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// each
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function each($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'each', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// index
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function index($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'index', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// removeData
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function removeData($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'removeData', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// size
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function size($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'size', $params, '', $comma);
	}
	
	//----------------------------------------------------------------------------------------------------
	// toArray
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $selector
	// @param mixed  $params
	// @param bool   $comma false
	//  
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function toArray($selector = '', $params = array(), $comma = true)
	{
		return $this->combine($selector, 'toArray', $params, '', $comma);
	}
}