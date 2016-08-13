<?php namespace ZN\ViewObjects;

trait ViewCommonTrait
{
	//----------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// FormElementsTrait
	//----------------------------------------------------------------------------------------------------
	// 
	// elements ...
	//
	//----------------------------------------------------------------------------------------------------
	use FormElementsTrait;
	
	//----------------------------------------------------------------------------------------------------
	// HTMLElementsTrait
	//----------------------------------------------------------------------------------------------------
	// 
	// elements ...
	//
	//----------------------------------------------------------------------------------------------------
	use HTMLElementsTrait;
	
	//----------------------------------------------------------------------------------------------------
	// $settings
	//----------------------------------------------------------------------------------------------------
	//
	// Ayarları tutmak için
	//
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	protected $settings = [];
	
	//----------------------------------------------------------------------------------------------------
	// Attributes
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $attributes
	//
	//----------------------------------------------------------------------------------------------------
	public function attributes(Array $attributes) : String
	{
		$attribute = '';
		
		if( ! empty($this->settings['attr']) )
		{
			$attributes = array_merge($attributes, $this->settings['attr']);	
			
			$this->settings['attr'] = [];						
		}

		foreach( $attributes as $key => $values )
		{
			if( is_numeric($key) )
			{
				$attribute .= ' '.$values;
			}
			else
			{
				if( ! empty($key) )
				{
					$attribute .= ' '.$key.'="'.$values.'"';
				}
			}
		}	
	
		return $attribute;	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Type
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $type
	// @param string $name
	// @param string $value
	// @param array  $attributes
	//
	//----------------------------------------------------------------------------------------------------
	public function input(String $type = NULL, String $name = NULL, String $value = NULL, Array $_attributes = []) : String
	{
		if( isset($this->settings['attr']['type']) )
		{
			$type = $this->settings['attr']['type'];
			
			unset($this->settings['attr']['type']);
		}
		
		$this->settings['attr'] = [];	
		
		return $this->_input($name, $value, $_attributes, $type);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Attributes
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param string $value
	// @param array  $_attributes
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	protected function _input($name = "", $value = "", $_attributes = [], $type = '')
	{
		if( $name !== '' )
		{
			$_attributes['name'] = $name;
		}
		
		if( $value !== '' )
		{
			$_attributes['value'] = $value;
		}

		if( ! empty($_attributes['name']) )
		{
			if( isset($this->postback['bool']) && $this->postback['bool'] === true )
			{
				$method = ! empty($this->method) ? $this->method : $this->postback['type'];

				$_attributes['value'] = \Validation::postBack($_attributes['name'], $method);

				$this->postback = [];
			}
		}

		return '<input type="'.$type.'"'.$this->attributes($_attributes).'>'.EOL;
	}
	
	//----------------------------------------------------------------------------------------------------
	// protected _element()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $function
	// @param string $element
	//
	//----------------------------------------------------------------------------------------------------
	protected function _element($function, $element)
	{
		$this->settings['attr'][strtolower($function)] = $element;
	}
}