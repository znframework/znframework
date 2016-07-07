<?php
namespace ZN\ViewObjects\Common;

use ZN\ViewObjects\Form\ElementsTrait as FormElementsTrait;
use ZN\ViewObjects\HTML\ElementsTrait as HTMLElementsTrait;

trait HyperTextTrait
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
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
	public function attributes($attributes = [])
	{
		$attribute = '';
		
		if( is_array($attributes) )
		{
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
		}
	
		return $attribute;	
	}
	
	/******************************************************************************************
	* INPUT OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="xxxx"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 4 parametresi vardır.		                                              |
	| 1. string var @type => Form nesnesinin türü belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 3. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 4. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: inputObject('text', 'nesne', 'Değer', array('style' => 'color:red'));  |
	| // <input type="text" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function input($type = "", $name = "", $value = "", $_attributes = '')
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