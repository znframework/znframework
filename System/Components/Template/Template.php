<?php
class __USE_STATIC_ACCESS__CTemplate
{
	/***********************************************************************************/
	/* TEMPLATE COMPONENT	  	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CTemplate
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->ctemplate, zn::$use->ctemplate, uselib('ctemplate')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
			Error::set('CTemplate', 'header', lang('Error', 'valueParameter', 'header'));
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
			Error::set('CTemplate', 'footer', lang('Error', 'valueParameter', 'footer'));
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
			Error::set('CTemplate', 'leftSide', lang('Error', 'valueParameter', 'leftSide'));
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
			Error::set('CTemplate', 'rightSide', lang('Error', 'valueParameter', 'rightSide'));
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
			Error::set('CTemplate', 'content', lang('Error', 'valueParameter', 'content'));
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
			Error::set('CTemplate', 'bottom', lang('Error', 'valueParameter', 'bottom'));
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
			Error::set('CTemplate', 'top', lang('Error', 'valueParameter', 'content'));
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
		
		if( ! isValue($name) )
		{
			Error::set('CTemplate', 'body', lang('Error', 'valueParameter', 'name'));
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
			Error::set('CTemplate', 'align', lang('Error', 'stringParameter', 'align'));
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
			Error::set('CTemplate', 'width', lang('Error', 'valueParameter', 'width'));
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