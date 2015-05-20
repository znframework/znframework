<?php
/************************************************************/
/*                      TABLE COMPONENT                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* TABLE                                                                                   *
*******************************************************************************************
| Dahil(Import) Edilirken : Table            							     			  |
| Sınıfı Kullanırken      :	$this->table->     									      	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentTable
{
	protected $attr = array();
	protected $table;
	
	public function attr($attributes = array())
	{
		if( ! is_array($attributes))
		{
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
		if( ! ( is_numeric($spacing) || is_numeric($padding) ) )
		{
			return $this;	
		}
		if( ! empty($spacing)) $this->attr['cellspacing'] = $spacing;
		if( ! empty($padding)) $this->attr['cellpadding'] = $padding;
		
		return $this;
	}
	
	public function cell_spacing($spacing = 0)
	{
		if( ! is_numeric($spacing) )
		{
			return $this;	
		}
		
		if( ! empty($spacing)) $this->attr['cellspacing'] = $spacing;
		
		return $this;
	}
	
	public function cell_padding($padding = 0)
	{
		if( ! is_numeric($padding) )
		{
			return $this;	
		}
		
		if( ! empty($padding)) $this->attr['cellpadding'] = $padding;
		
		return $this;
	}
	
	public function border($border = 0, $color = '')
	{
		if( ! is_numeric($border) )
		{
			return $this;	
		}
		
		if( ! is_string($color) )
		{
			return $this;	
		}
		
		if( ! empty($border)) $this->attr['border'] = $border;
		if( ! empty($color)) $this->attr['bordercolor'] = $color;
	
		return $this;
	}
	
	public function border_size($border = 0)
	{
		if( ! is_numeric($border) )
		{
			return $this;	
		}
		
		if( ! is_string($color) )
		{
			return $this;	
		}
		
		if( ! empty($border)) $this->attr['border'] = $border;
	
		return $this;
	}
	
	public function border_color($color = '')
	{
		if( ! is_string($color) )
		{
			return $this;	
		}

		if( ! empty($color)) $this->attr['bordercolor'] = $color;
	
		return $this;
	}
	
	public function align($align = '')
	{
		if( ! is_string($align) )
		{
			return $this;	
		}
		
		if( ! empty($align)) $this->attr['align'] = $align;
		
		return $this;
	}
	
	public function width($width = '')
	{
		if( ! is_value($width) )
		{
			return $this;	
		}
		
		if( ! empty($width)) $this->attr['width'] = $width;
		
		return $this;
	}
	
	public function height($height = '')
	{
		if( ! is_value($height) )
		{
			return $this;	
		}
		
		if( ! empty($height)) $this->attr['height'] = $height;
		
		return $this;
	}
	
	public function size($width = '', $height = '')
	{
		if( ! ( is_value($height) || is_value($width) ) )
		{
			return $this;	
		}
		
		if( ! empty($width))  $this->attr['width'] = $width;
		if( ! empty($height)) $this->attr['height'] = $height;
		
		return $this;
	}
	
	public function css($css = '')
	{
		if( ! is_string($css) )
		{
			return $this;	
		}
		
		if( ! empty($css)) $this->attr['class'] = $css;
		
		return $this;
	}
	
	
	public function style($_attributes = array())
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
		
		$this->attr['style'] = $attribute;
		
		return $this;	
	}
	
	public function background($background = '')
	{
		if( ! is_string($background) )
		{
			return $this;	
		}
		
		if( ! empty($background)) $this->attr['background'] = $background;
		
		return $this;
	}
	
	public function bgcolor($bgcolor = '')
	{
		if( ! is_string($bgcolor) )
		{
			return $this;	
		}
		
		if( ! empty($bgcolor)) $this->attr['bgcolor'] = $bgcolor;
		
		return $this;
	}

	protected function _attributes($attributes = '')
	{
		$attribute = '';
		if(is_array($attributes))
		{
			foreach($attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}

		return $attribute;	
	}
	
	public function content()
	{	
		$colno = 1;
		$rowno = 1;
		$table = '';
		
		$elements = func_get_args();
		
		foreach($elements as $key => $element)
		{
			$table .= "\n\t".'<tr>'."\n";
			
			if(is_array($element))foreach($element as $k => $v)
			{
				$val = $v;
				$attr = "";
				
				if(is_array($v))
				{
					$attr = $this->_attributes($v);
					$val = $k;
				}
			
				$table .= "\t\t".'<td'.$attr.'>'.$val.'</td>'."\n";	
				$colno++;
			}
		
			$table .= "\t".'</tr>'."\n";
			$rowno++;
		}
		
		$this->table = $table;
		
		return $this;
	}
	
	public function create()
	{
		$table  = '<table '.$this->_attributes($this->attr).'>';
		$table .= $this->table;
		$table .= '</table>';
		
		if( ! empty($this->table)) $this->table = NULL;
		if( ! empty($this->attr))  $this->attr = array();
		
		return $table;
	}	
}