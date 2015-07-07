<?php
/************************************************************/
/*                   TEMPLATE COMPONENT                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* TEMPLATE                                                                                *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->ctemplate->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CTemplate
{
	protected $header;
	protected $footer;
	protected $top;
	protected $bottom;
	protected $leftSide;
	protected $rightSide;
	protected $content;
	protected $body = array();
	protected $middle;
	protected $name = 'body';
	
	protected function _style($_attributes = array())
	{
		$attribute = '';
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
		
		return $attribute;
	}
	
	public function header($header = '', $styles = array())
	{
		if( ! isValue($header) )
		{
			return $this;	
		}
		
		! empty($styles)
		? $style = ' style="'.$this->_style($styles).'"'
	    : $style = "";
		
		$this->header = "<div section=\"header\"$style>$header</div>";
		
		return $this;
	}
	
	public function footer($footer = '', $styles = array())
	{
		if( ! isValue($footer) )
		{
			return $this;	
		}
		
		! empty($styles)
		? $style = ' style="'.$this->_style($styles).'"'
		: $style = "";
			
		$this->footer = "<div section=\"footer\"$style>$footer</div>";
		
		return $this;
	}
	
	public function leftSide($leftSide = '', $styles = array())
	{
		if( ! isValue($leftSide) )
		{
			return $this;	
		}
		
		! empty($styles)
		? $style = $this->_style($styles)
		: $style = "";
			
		$this->leftSide = "<div section=\"leftside\" style=\"float:left;$style\">$leftSide</div>";
		
		return $this;
	}
	
	public function rightSide($rightSide = '', $styles = array())
	{
		if( ! isValue($rightSide) )
		{
			return $this;	
		}
		
		! empty($styles)
		? $style = $this->_style($styles)
		: $style = "";
			
		$this->rightSide = "<div section=\"rightside\" style=\"float:left;$style\">$rightSide</div>";
		
		return $this;
	}
	
	public function content($content = '', $styles = array())
	{
		if( ! isValue($content) )
		{
			return $this;	
		}
		
		! empty($styles)
		? $style = $this->_style($styles)
		: $style = "";
			
		$this->content = "<div section=\"content\" style=\"float:left;$style\">$content</div>";
		
		return $this;
	}
	
	public function bottom($content = '', $styles = array())
	{
		if( ! isValue($content) )
		{
			return $this;	
		}
		
		! empty($styles)
		? $style = $this->_style($styles)
		: $style = "";
			
		$this->bottom = "<div section=\"bottom\" style=\"$style\">$content</div>".eol();
		
		return $this;
	}
	
	public function top($content = '', $styles = array())
	{
		if( ! isValue($content) )
		{
			return $this;	
		}
		
		! empty($styles)
		? $style = $this->_style($styles)
		: $style = "";
			
		$this->top = "<div section=\"top\" style=\"$style\">$content</div>".eol();
		
		return $this;
	}
	
	public function body($name = 'body', $styles = array())
	{
		
		if( ! isValue($name))
		{
			return $this;	
		}
		
		if( ! is_array($styles))
		{
			return $this;	
		}
		
		$this->name = $name;
		
		foreach($styles as $k => $v)
		{
			$this->body[$k] = $v;
		}
		return $this;
	}	
	
	public function middle($styles = array())
	{
		! empty($styles)
		? $style = ' style="'.$this->_style($styles).'"'
		: $style = "";
		
		$this->middle = $style;
		
		return $this;
	}
	
	public function align($align = 'center')
	{
		if( ! is_string($align) )
		{
			return $this;	
		}
		
		if( $align === 'center' )
		{
			$this->body['margin'] = 'auto';	
		}
		elseif( $align === 'left' )
		{
			$this->body['float'] = 	'left';	
		}
		elseif( $align === 'right' )
		{
			$this->body['float'] =  'right';	
		}
		else
		{
			$this->body['margin'] = 'auto';	
		}
				
		return $this;
	}
	
	public function width($width = '1000')
	{
		if( ! isValue($width) )
		{
			return $this;	
		}
		
		if( is_numeric($width) )
		{
			$width = $width.'px';	
		}
		$this->body['width'] = $width;
		
		return $this; 
	}
	
	public function create()
	{
		! empty($styles)
		? $style = ' style="'.$this->_style($styles).'"'
		: $style = "";
		
		if( ! isset($this->body['width']) )
		{
			$this->body['width'] = '1000px';	
		}
		
		$template  = '';
			
		if( ! empty($this->top) ) 
		{
			$template .= $this->top;
		}
		
		$template .= "<div section=\"$this->name\" style=\"".$this->_style($this->body)."\">".eol();
		$template .= "\t$this->header".eol();	
		$template .= "\t<div section=\"middle\"$this->middle>".eol();
		$template .= "\t\t$this->leftSide".eol();
		$template .= "\t\t$this->content".eol();
		$template .= "\t\t$this->rightSide".eol();
		$template .= "\t\t<div style=\"clear:both\"></div>".eol();
		$template .= "\t</div>".eol();	
		$template .= "\t$this->footer".eol();
		$template .= "</div>".eol();
		
		if( ! empty($this->bottom) ) 
		{
			if( ! empty($this->body['float']) )
			{
				$template .= "<div style=\"clear:both\"></div>".eol();
			}
			
			$template .= $this->bottom;
		}
		
		$this->_defaultVariable();
		
		return $template;
	}
	
	protected function _defaultVariable()
	{
		if( ! empty($this->header)) 	$this->header 		= NULL;
		if( ! empty($this->footer))  	$this->footer 		= NULL;
		if( ! empty($this->top))  		$this->top 			= NULL;
		if( ! empty($this->bottom))  	$this->bottom 		= NULL;
		if( ! empty($this->leftSide))  	$this->leftSide 	= NULL;
		if( ! empty($this->rightSide))  $this->rightSide 	= NULL;
		if( ! empty($this->content))  	$this->content 		= NULL;
		if( ! empty($this->body))  		$this->body 		= array();
		if( ! empty($this->middle))  	$this->middle 		= NULL;
		if( $this->name !== 'body')  	$this->name 		= 'body';	
	}
}	