<?php
/************************************************************/
/*                     SECTION COMPONENT                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class ComponentTemplateSection
{
	protected $attr = array();
	protected $style = '';
	protected $clear;
	protected $content = '';
	
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
	
	public function id($id = '')
	{
		if( ! is_value($id))
		{
			return $this;	
		}
		
		if( ! empty($id)) $this->attr['id'] = $id;
		
		return $this;	
	}
	
	public function name($name = '')
	{
		if( ! is_value($name))
		{
			return $this;	
		}
		
		if( ! empty($name)) $this->attr['name'] = $name;
		
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
	
	public function width($width = '')
	{
		if( ! is_value($width) )
		{
			return $this;	
		}
		
		if( is_numeric($width) )
		{
			$width = $width.'px';	
		}
		
		if( ! empty($width)) $this->style .= ' width:'.$width.';';
		
		return $this;
	}
	
	public function height($height = '')
	{
		if( ! is_value($height) )
		{
			return $this;	
		}
		
		if( is_numeric($height) )
		{
			$height = $height.'px';	
		}
		
		if( ! empty($height)) $this->style .= ' height:'.$height.';';
		
		return $this;
	}
	
	public function border($border = 'solid 1px #000')
	{
		if( ! is_value($border) )
		{
			return $this;	
		}
		
		if( ! empty($border)) $this->style .= ' border:'.$border.';';
		
		return $this;
	}
	
	public function border_style($border = 'solid')
	{
		if( ! is_value($border) )
		{
			return $this;	
		}

		if( ! empty($border)) $this->style .= ' border-style:'.$border.';';
		
		return $this;
	}
	
	public function border_color($border_color = '')
	{
		if( ! is_value($border_color) )
		{
			return $this;	
		}
		
		if( ! empty($border_color)) $this->style .= ' border-color:'.$border_color.';';
		
		return $this;
	}
	
	public function bgcolor($bgcolor = '')
	{
		if( ! is_value($bgcolor) )
		{
			return $this;	
		}
		
		if( ! empty($bgcolor)) $this->style .= ' background-color:'.$bgcolor.';';
		
		return $this;
	}
	
	public function zindex($zindex = '')
	{
		if( ! is_value($zindex) )
		{
			return $this;	
		}
		
		if( ! empty($zindex)) $this->style .= ' z-index:'.$zindex.';';
		
		return $this;
	}
	
	public function bgurl($bgurl = '')
	{
		if( ! is_value($bgurl) )
		{
			return $this;	
		}
		
		if( ! empty($bgurl)) $this->style .= ' background:url('.$bgurl.');';
		
		return $this;
	}
	
	public function bgimage($bgimage = '')
	{
		if( ! is_value($bgimage) )
		{
			return $this;	
		}
		
		if( ! empty($bgimage)) $this->style .= ' background-image:'.$bgimage.';';
		
		return $this;
	}
	
	public function background($background = '')
	{
		if( ! is_value($background) )
		{
			return $this;	
		}
		
		if( ! empty($background)) 
		{
			$this->style .= ' background:'.$background.';';
		}
		return $this;
	}
	
	public function size($width = '', $height = '')
	{
		if( ! ( is_value($height) || is_value($width) ) )
		{
			return $this;	
		}
		
		if( is_numeric($width) )
		{
			$width = $width.'px';	
		}
		
		if( is_numeric($height) )
		{
			$height = $height.'px';	
		}
		
		if( ! empty($width))  $this->style .= ' width:'.$width.';';
		if( ! empty($height)) $this->style .= ' height:'.$height.';';
		
		return $this;
	}
	
	public function position($position = '')
	{
		if( ! is_value($position) )
		{
			return $this;	
		}
		
		if( ! empty($position)) $this->style .= ' position:'.$position.';';
		
		return $this;
	}
	
	public function align($align = '')
	{
		if( ! is_value($align) )
		{
			return $this;	
		}
		
		if( ! empty($align)) $this->style .= ' float:'.$align.';';
	
		return $this;
	}
	
	public function text_align($align = 'center')
	{
		if( ! is_value($align) )
		{
			return $this;	
		}
		
		if( ! empty($align)) $this->style .= ' text-align:'.$align.';';
		
		return $this;
	}
	
	public function valign($align = 'middle')
	{
		if( ! is_value($align) )
		{
			return $this;	
		}
		
		if( ! empty($align)) $this->style .= ' vertical-align:'.$align.';';
		
		return $this;
	}
	
	protected function _clear($clear)
	{		

		$style = ' style="clear:'.$clear.';" ';
		
		$section  = "\n".'<div '.$style.'></div>'."\n";
		
		return $section;
	}

	public function clear($clear = 'both')
	{
		if( ! is_value($clear) )
		{
			return $this;	
		}
		
		$this->clear = $this->_clear($clear);	
		
		return $this;
	}
	
	public function float($align = '')
	{
		if( ! is_value($align) )
		{
			return $this;	
		}
		
		if( ! empty($align)) $this->style .= ' float:'.$align.';';
		
		return $this;
	}
	
	public function margin($margin = '')
	{
		if( ! is_value($margin) )
		{
			return $this;	
		}
		
		if( ! empty($margin)) $this->style .= ' margin:'.$margin.';';
		
		return $this;
	}

	public function padding($padding = '')
	{
		if( ! is_value($padding) )
		{
			return $this;	
		}
		
		if( ! empty($padding)) $this->style .= ' padding:'.$padding.';';
		
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
		
		$this->style .= $attribute;
		
		return $this;	
	}

	public function content($content = '')
	{
		if( ! is_value($content))
		{
			return $this;
		}
		
		$this->content = $content;
		
		return $this;
	}
	
	public function create($content = '')
	{
		
		! empty($this->clear)
			? $clear = $this->clear
			: $clear = "";	
			
		! empty($this->attr)
			? $attr = $this->attr
			: $attr = array();
		
		! empty($this->style)
			? $attr['style'] = $this->style
			: NULL;	
		
		if( ! empty($content))
		{
			$this->content = $content;	
		}	
		
		$section  = "\n\t\t".'<div'.$this->_attributes($attr).'>';
		if( ! empty($this->content)) $section .= "\n\t\t\t$this->content";
		$section .= "\n\t\t</div>\n$clear";	
		
		if( ! empty($this->clear))   $this->clear = NULL;
		if( ! empty($this->style)) 	 $this->style = '';
		if( ! empty($this->content)) $this->content = '';
		if( ! empty($this->attr))    $this->attr = array();
		return $section;
	}
}