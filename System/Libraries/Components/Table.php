<?php
class __USE_STATIC_ACCESS__Table
{
	/***********************************************************************************/
	/* TABLE COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Table
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->Table, zn::$use->Table, uselib('Table')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	protected $attr = array();
	protected $table;
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Table::$method()"));	
	}
	
	public function attr($attributes = array())
	{
		if( ! is_array($attributes))
		{
			Error::set(lang('Error', 'arrayParameter', 'attributes'));
			return $this;	
		}
		
		foreach($attributes as $att => $val)
		{
			$this->attr[$att] = $val; 
		}
		return $this;
	}
	
	public function cell($spacing = 0, $padding = 0)
	{
		if( ! is_numeric($spacing) || ! is_numeric($padding) )
		{
			Error::set(lang('Error', 'numericParameter', 'spacing & padding'));
			return $this;	
		}
		if( ! empty($spacing) ) $this->attr['cellspacing'] = $spacing;
		if( ! empty($padding) ) $this->attr['cellpadding'] = $padding;
		
		return $this;
	}
	
	public function cellSpacing($spacing = 0)
	{
		if( ! is_numeric($spacing) )
		{
			Error::set(lang('Error', 'numericParameter', 'spacing'));
			return $this;	
		}
		
		if( ! empty($spacing) ) $this->attr['cellspacing'] = $spacing;
		
		return $this;
	}
	
	public function cellPadding($padding = 0)
	{
		if( ! is_numeric($padding) )
		{
			Error::set(lang('Error', 'numericParameter', 'padding'));
			return $this;	
		}
		
		if( ! empty($padding)) $this->attr['cellpadding'] = $padding;
		
		return $this;
	}
	
	public function border($border = 0, $color = '')
	{
		if( ! is_numeric($border) )
		{
			Error::set(lang('Error', 'numericParameter', 'border'));
			return $this;	
		}
		
		if( ! is_string($color) )
		{
			Error::set(lang('Error', 'stringParameter', 'color'));
			return $this;	
		}
		
		if( ! empty($border) ) $this->attr['border']      = $border;
		if( ! empty($color) )  $this->attr['bordercolor'] = $color;
	
		return $this;
	}
	
	public function borderSize($border = 0)
	{
		if( ! is_numeric($border) )
		{
			Error::set(lang('Error', 'numericParameter', 'border'));
			return $this;	
		}
		
		if( ! empty($border) ) $this->attr['border'] = $border;
	
		return $this;
	}
	
	public function borderColor($color = '')
	{
		if( ! is_string($color) )
		{
			Error::set(lang('Error', 'stringParameter', 'color'));
			return $this;	
		}

		if( ! empty($color)) $this->attr['bordercolor'] = $color;
	
		return $this;
	}
	
	public function align($align = '')
	{
		if( ! is_string($align) )
		{
			Error::set(lang('Error', 'stringParameter', 'align'));
			return $this;	
		}
		
		if( ! empty($align)) $this->attr['align'] = $align;
		
		return $this;
	}
	
	public function width($width = '')
	{
		if( ! isValue($width) )
		{
			Error::set(lang('Error', 'valueParameter', 'width'));
			return $this;	
		}
		
		if( ! empty($width)) $this->attr['width'] = $width;
		
		return $this;
	}
	
	public function height($height = '')
	{
		if( ! isValue($height) )
		{
			Error::set(lang('Error', 'valueParameter', 'height'));
			return $this;	
		}
		
		if( ! empty($height)) $this->attr['height'] = $height;
		
		return $this;
	}
	
	public function size($width = '', $height = '')
	{
		if( ! isValue($height) || ! isValue($width) )
		{
			Error::set(lang('Error', 'valueParameter', 'width & height'));
			return $this;	
		}
		
		if( ! empty($width) )  $this->attr['width']  = $width;
		if( ! empty($height) ) $this->attr['height'] = $height;
		
		return $this;
	}
	
	public function css($css = '')
	{
		if( ! is_string($css) )
		{
			Error::set(lang('Error', 'stringParameter', 'css'));
			return $this;	
		}
		
		if( ! empty($css) ) $this->attr['class'] = $css;
		
		return $this;
	}
	
	
	public function style($_attributes = array())
	{
		$attribute = "";
		
		if( is_array($_attributes) )
		{
			foreach($_attributes as $key => $values)
			{
				if( is_numeric($key) )
				{
					$key = $values;
				}
				
				$attribute .= ' '.$key.':'.$values.';';
			}	
		}
		
		$this->attr['style'] = $attribute;
		
		return $this;	
	}
	
	public function background($background = '')
	{
		if( ! is_string($background) )
		{
			Error::set(lang('Error', 'stringParameter', 'background'));
			return $this;	
		}
		
		if( ! empty($background)) $this->attr['background'] = $background;
		
		return $this;
	}
	
	public function bgColor($bgColor = '')
	{
		if( ! is_string($bgColor) )
		{
			Error::set(lang('Error', 'stringParameter', 'bgColor'));
			return $this;	
		}
		
		if( ! empty($bgColor)) $this->attr['bgcolor'] = $bgColor;
		
		return $this;
	}

	protected function _attributes($attributes = '')
	{
		$attribute = '';
		
		if( is_array($attributes) )
		{
			foreach( $attributes as $key => $values )
			{
				if( is_numeric($key) )
				{
					$key = $values;
				}
				
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}

		return $attribute;	
	}
	
	public function content()
	{	
		$colNo = 1;
		$rowNo = 1;
		$table = '';
		
		$elements = func_get_args();
		
		foreach($elements as $key => $element)
		{
			$table .= eol()."\t".'<tr>'.eol();
			
			if(is_array($element))foreach($element as $k => $v)
			{
				$val = $v;
				$attr = "";
				
				if(is_array($v))
				{
					$attr = $this->_attributes($v);
					$val = $k;
				}
			
				$table .= "\t\t".'<td'.$attr.'>'.$val.'</td>'.eol();	
				$colNo++;
			}
		
			$table .= "\t".'</tr>'.eol();
			$rowNo++;
		}
		
		$this->table = $table;
		
		return $this;
	}
	
	public function create()
	{
		$table  = '<table'.$this->_attributes($this->attr).'>';
		$table .= $this->table;
		$table .= '</table>';
		
		if( ! empty($this->table)) $this->table = NULL;
		if( ! empty($this->attr))  $this->attr = array();
		
		return $table;
	}	
}