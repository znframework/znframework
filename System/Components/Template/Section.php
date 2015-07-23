<?php
class __USE_STATIC_ACCESS__CSection
{
	/***********************************************************************************/
	/* SECTION COMPONENT     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CSection
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->csection, zn::$use->csection, uselib('csection')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Attr Değişkeni
	 *  
	 * Özellik değer bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $attr = array();
	
	/* Style Değişkeni
	 *  
	 * Stil bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $style = '';
	
	/* Clear Değişkeni
	 *  
	 * Div temizleme bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $clear;
	
	/* Content Değişkeni
	 *  
	 * İçerik bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $content = '';
	
	/******************************************************************************************
	* PROTECTED ATTRIBUTES                                                                    *
	******************************************************************************************/
	protected function _attributes($attributes = '')
	{
		$attribute = '';
		
		if( is_array($attributes) )
		{
			foreach($attributes as $key => $values)
			{
				if(is_numeric($key) )
				{
					$key = $values;
				}
				
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}

		return $attribute;	
	}
	
	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Div nesnelerine özellik değer çifti eklemek için kullanılıyor.	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. array var @attributes => Özellik değer çiftleri.					  				  |
	|          																				  |
	| Örnek Kullanım: ->attr(array('name' => 'deneme'))         					  		  |
	|          																				  |
	******************************************************************************************/
	public function attr($attributes = array())
	{
		if( ! is_array($attributes) )
		{
			Error::set('CSection', 'data', lang('Error', 'arrayParameter', 'attributes'));
			return $this;	
		}
		
		foreach($attributes as $att => $val)
		{
			$this->attr[$att] = $val; 
		}
		return $this;
	}
	
	/******************************************************************************************
	* ID                                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine id değeri eklemek için kullanılır.	      				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @id => Özellik değeri.									  				  |
	|          																				  |
	| Örnek Kullanım: ->id('id')         					  		  						  |
	|          																				  |
	******************************************************************************************/
	public function id($id = '')
	{
		if( ! isValue($id))
		{
			Error::set('CSection', 'id', lang('Error', 'valueParameter', 'id'));
			return $this;	
		}
		
		if( ! empty($id)) $this->attr['id'] = $id;
		
		return $this;	
	}
	
	/******************************************************************************************
	* NAME                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine name değeri eklemek için kullanılır.	   				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Özellik değeri.									  			  |
	|          																				  |
	| Örnek Kullanım: ->name('isim')      					  		  						  |
	|          																				  |
	******************************************************************************************/
	public function name($name = '')
	{
		if( ! isValue($name))
		{
			Error::set('CSection', 'name', lang('Error', 'valueParameter', 'name'));
			return $this;	
		}
		
		if( ! empty($name)) $this->attr['name'] = $name;
		
		return $this;
	}
	
	/******************************************************************************************
	* CSS                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine class değeri eklemek için kullanılır.	   				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @css => Özellik değeri.									  			      |
	|          																				  |
	| Örnek Kullanım: ->css('red-color bold')      					  		  				  |
	|          																				  |
	******************************************************************************************/
	public function css($css = '')
	{
		if( ! is_string($css) )
		{
			Error::set('CSection', 'css', lang('Error', 'stringParameter', 'css'));
			return $this;	
		}
		
		if( ! empty($css)) $this->attr['class'] = $css;
		
		return $this;
	}
	
	/******************************************************************************************
	* WIDTH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style width değeri eklemek için kullanılır.	   			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @width => Özellik değeri.									  	  |
	|          																				  |
	| Örnek Kullanım: ->width(20) // 20px  					  		  			  			  |
	|          																				  |
	******************************************************************************************/
	public function width($width = '')
	{
		if( ! isValue($width) )
		{
			Error::set('CSection', 'width', lang('Error', 'valueParameter', 'width'));
			return $this;	
		}
		
		if( is_numeric($width) )
		{
			$width = $width.'px';	
		}
		
		if( ! empty($width)) $this->style .= ' width:'.$width.';';
		
		return $this;
	}
	
	/******************************************************************************************
	* HEIGHT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style height değeri eklemek için kullanılır.	   		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @height => Özellik değeri.									  	  |
	|          																				  |
	| Örnek Kullanım: ->height(20) // 20px  					  		  			  		  |
	|          																				  |
	******************************************************************************************/
	public function height($height = '')
	{
		if( ! isValue($height) )
		{
			Error::set('CSection', 'height', lang('Error', 'valueParameter', 'height'));
			return $this;	
		}
		
		if( is_numeric($height) )
		{
			$height = $height.'px';	
		}
		
		if( ! empty($height)) $this->style .= ' height:'.$height.';';
		
		return $this;
	}
	
	/******************************************************************************************
	* BORDER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style border değeri eklemek için kullanılır.	   		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @border => Özellik değeri.									  	  		  |
	|          																				  |
	| Örnek Kullanım: ->border('solid 1px #000')					  		  			  	  |
	|          																				  |
	******************************************************************************************/
	public function border($border = 'solid 1px #000')
	{
		if( ! isValue($border) )
		{
			Error::set('CSection', 'border', lang('Error', 'valueParameter', 'border'));
			return $this;	
		}
		
		if( ! empty($border)) $this->style .= ' border:'.$border.';';
		
		return $this;
	}
	
	/******************************************************************************************
	* BORDER TYPE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style border-style değeri eklemek için kullanılır.	   	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @border => Özellik değeri.									  	  		  |
	|          																				  |
	| Örnek Kullanım: ->borderType('dashed')					  		  			  	      |
	|          																				  |
	******************************************************************************************/
	public function borderType($border = 'solid')
	{
		if( ! isValue($border) )
		{
			Error::set('CSection', 'borderType', lang('Error', 'valueParameter', 'border'));
			return $this;	
		}

		if( ! empty($border) ) 
		{
			$this->style .= ' border-style:'.$border.';';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BORDER COLOR                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style border-color değeri eklemek için kullanılır.	   	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @border_color => Özellik değeri.									  	  |
	|          																				  |
	| Örnek Kullanım: ->border_color('000') // #000					  		  			  	  |
	|          																				  |
	******************************************************************************************/
	public function borderColor($borderColor = '')
	{
		if( ! isValue($borderColor) )
		{
			Error::set('CSection', 'borderColor', lang('Error', 'valueParameter', 'borderColor'));
			return $this;	
		}
		
		if( is_numeric($borderColor) )
		{
			$borderColor = '#'.$borderColor;	
		}
		
		if( ! empty($borderColor) ) 
		{
			$this->style .= ' border-color:'.$borderColor.';';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BORDER SIZE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style border-width değeri eklemek için kullanılır.	   	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @border_size => Özellik değeri.									  	  |
	|          																				  |
	| Örnek Kullanım: ->borderSize(5) // 5px						  		  			  	  |
	|          																				  |
	******************************************************************************************/
	public function borderSize($borderSize = '')
	{
		if( ! isValue($borderSize) )
		{
			Error::set('CSection', 'borderSize', lang('Error', 'valueParameter', 'borderSize'));
			return $this;	
		}
		
		if( is_numeric($borderSize) )
		{
			$borderSize = $borderSize.'px';	
		}
		
		if( ! empty($borderSize)) $this->style .= ' border-width:'.$borderSize.';';
			
		return $this;
	}
	
	/******************************************************************************************
	* COLOR                                                                        			  *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style color değeri eklemek için kullanılır.	  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @color => Özellik değeri.									  	 		  |
	|          																				  |
	| Örnek Kullanım: ->bgcolor('000') // #000					  		  			  	  	  |
	|          																				  |
	******************************************************************************************/
	public function color($color = '')
	{
		if( ! isValue($color) )
		{
			Error::set('CSection', 'color', lang('Error', 'valueParameter', 'color'));
			return $this;	
		}
		
		if( is_numeric($color) )
		{
			$color = '#'.$color;	
		}
		
		if( ! empty($color) ) 
		{
			$this->style .= ' color:'.$color.';';
		}

		return $this;
	}
	
	/******************************************************************************************
	* FONT COLOR                                                                        	  *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style color değeri eklemek için kullanılır.	  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @color => Özellik değeri.									  	 		  |
	|          																				  |
	| Örnek Kullanım: ->font_color('000') // #000					  		  			  	  |
	|          																				  |
	******************************************************************************************/
	public function fontColor($color = '')
	{
		$this->color($color);
		
		return $this;
	}
	
	/******************************************************************************************
	* FONT SIZE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style font-size değeri eklemek için kullanılır.	   	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @font_size => Özellik değeri.									  	      |
	|          																				  |
	| Örnek Kullanım: ->fontSize(5) // 5px						  		  			  	      |
	|          																				  |
	******************************************************************************************/
	public function fontSize($fontSize = '')
	{
		if( ! isValue($fontSize) )
		{
			Error::set('CSection', 'fontSize', lang('Error', 'valueParameter', 'fontSize'));
			return $this;	
		}
		
		if( is_numeric($fontSize) )
		{
			$fontSize = $fontSize.'px';	
		}
		
		if( ! empty($fontSize)) $this->style .= ' font-size:'.$fontSize.';';
		
		return $this;
	}
	
	/******************************************************************************************
	* FONT TYPE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style font-family değeri eklemek için kullanılır.	   	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @family => Özellik değeri.									  	  		  |
	|          																				  |
	| Örnek Kullanım: ->fontType('Arial')					  		  			  	     	  |
	|          																				  |
	******************************************************************************************/
	public function fontType($family = 'Tahoma')
	{
		if( ! isValue($family) )
		{
			Error::set('CSection', 'fontType', lang('Error', 'valueParameter', 'fontType'));
			return $this;	
		}

		if( ! empty($family) ) 
		{
			$this->style .= ' font-family:'.$family.';';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* FONT FAMILY                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style font-family değeri eklemek için kullanılır.	   	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @family => Özellik değeri.									  	  		  |
	|          																				  |
	| Örnek Kullanım: ->font_family('Arial')					  		  			  	      |
	|          																				  |
	******************************************************************************************/
	public function fontFamily($family = 'Tahoma')
	{
		if( ! isValue($family) )
		{
			Error::set('CSection', 'fontFamily', lang('Error', 'valueParameter', 'fontFamily'));
			return $this;	
		}

		if( ! empty($family) ) 
		{
			$this->style .= ' font-family:'.$family.';';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* BACKGROUND COLOR                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Div nesnesine style background-color değeri eklemek için kullanılır.	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @bgcolor => Özellik değeri.									  	 		  |
	|          																				  |
	| Örnek Kullanım: ->bgcolor('000') // #000					  		  			  	  	  |
	|          																				  |
	******************************************************************************************/
	public function bgColor($bgColor = '')
	{
		if( ! isValue($bgColor) )
		{
			Error::set('CSection', 'bgColor', lang('Error', 'valueParameter', 'bgColor'));
			return $this;	
		}
		
		if( is_numeric($bgColor) )
		{
			$bgColor = '#'.$bgColor;	
		}
		
		if( ! empty($bgColor)) $this->style .= ' background-color:'.$bgColor.';';
		
		return $this;
	}
	
	public function bgUrl($bgUrl = '')
	{
		if( ! isValue($bgUrl) )
		{
			Error::set('CSection', 'bgUrl', lang('Error', 'valueParameter', 'bgUrl'));
			return $this;	
		}
		
		if( ! empty($bgUrl)) $this->style .= ' background:url('.$bgUrl.');';
		
		return $this;
	}
	
	public function bgImage($bgImage = '')
	{
		if( ! isValue($bgImage) )
		{
			Error::set('CSection', 'bgImage', lang('Error', 'valueParameter', 'bgImage'));
			return $this;	
		}
		
		if( ! empty($bgImage)) $this->style .= ' background-image:'.$bgImage.';';
		
		return $this;
	}
	
	public function background($background = '')
	{
		if( ! isValue($background) )
		{
			Error::set('CSection', 'background', lang('Error', 'valueParameter', 'background'));
			return $this;	
		}
		
		if( is_numeric($background) )
		{
			$background = '#'.$background;	
		}
		
		if( ! empty($background)) 
		{
			$this->style .= ' background:'.$background.';';
		}
		return $this;
	}
	
	public function zindex($zindex = '')
	{
		if( ! isValue($zindex) )
		{
			Error::set('CSection', 'zindex', lang('Error', 'valueParameter', 'zindex'));
			return $this;	
		}
		
		if( ! empty($zindex)) $this->style .= ' z-index:'.$zindex.';';
		
		return $this;
	}
	
	
	public function size($width = '', $height = '')
	{
		if( ! isValue($height) || ! isValue($width) )
		{
			Error::set('CSection', 'size', lang('Error', 'valueParameter', 'width & height'));
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
		if( ! isValue($position) )
		{
			Error::set('CSection', 'position', lang('Error', 'valueParameter', 'position'));
			return $this;	
		}
		
		if( ! empty($position)) $this->style .= ' position:'.$position.';';
		
		return $this;
	}
	
	public function align($align = '')
	{
		if( ! isValue($align) )
		{
			Error::set('CSection', 'align', lang('Error', 'valueParameter', 'align'));
			return $this;	
		}
		
		if( ! empty($align)) $this->style .= ' float:'.$align.';';
	
		return $this;
	}
	
	public function textAlign($align = 'center')
	{
		if( ! isValue($align) )
		{
			Error::set('CSection', 'textAlign', lang('Error', 'valueParameter', 'center'));
			return $this;	
		}
		
		if( ! empty($align)) $this->style .= ' text-align:'.$align.';';
		
		return $this;
	}
	
	public function valign($align = 'middle')
	{
		if( ! isValue($align) )
		{
			Error::set('CSection', 'valign', lang('Error', 'valueParameter', 'align'));
			return $this;	
		}
		
		if( ! empty($align)) $this->style .= ' vertical-align:'.$align.';';
		
		return $this;
	}
	
	protected function _clear($clear)
	{	
		$style = ' style="clear:'.$clear.';" ';
		
		$section  = eol().'<div '.$style.'></div>'.eol();
		
		return $section;
	}

	public function clear($clear = 'both')
	{
		if( ! isValue($clear) )
		{
			Error::set('CSection', 'clear', lang('Error', 'valueParameter', 'clear'));
			return $this;	
		}
		
		$this->clear = $this->_clear($clear);	
		
		return $this;
	}
	
	public function float($align = '')
	{
		if( ! isValue($align) )
		{
			Error::set('CSection', 'float', lang('Error', 'valueParameter', 'align'));
			return $this;	
		}
		
		if( ! empty($align) ) 
		{
			$this->style .= ' float:'.$align.';';
		}
		
		return $this;
	}
	
	public function margin($margin = '')
	{
		if( ! isValue($margin) )
		{
			Error::set('CSection', 'margin', lang('Error', 'valueParameter', 'margin'));
			return $this;	
		}
		
		if( ! empty($margin) ) 
		{
			$this->style .= ' margin:'.$margin.';';
		}
		
		return $this;
	}
	
	public function coordinate($x = '', $y = '')
	{
		if( ! isValue($x) || ! isValue($y) )
		{
			Error::set('CSection', 'coordinate', lang('Error', 'valueParameter', 'x & y'));
			return $this;	
		}
		
		$x2 = 0;
		$y2 = 0;
		
		if( $x > 0 )
		{
			$x2 = 0;	
		}
		else
		{
			$x2 = $x;
			$x  = 0;	
		}
		
		if( $y > 0 )
		{
			$y2 = 0;	
		}
		else
		{
			$y2 = $y;
			$y  = 0;	
		}

		$margin = "$y $x2 $y2 $x";
		
		$this->margin($margin);
		
		return $this;
	}

	public function padding($padding = '')
	{
		if( ! isValue($padding) )
		{
			Error::set('CSection', 'padding', lang('Error', 'valueParameter', 'padding'));
			return $this;	
		}
		
		if( ! empty($padding) ) 
		{
			$this->style .= ' padding:'.$padding.';';
		}
		
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
		
		$this->style .= $attribute;
		
		return $this;	
	}

	public function content($content = '')
	{
		if( ! isValue($content) )
		{
			Error::set('CSection', 'content', lang('Error', 'valueParameter', 'content'));
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
		
		if( ! empty($content) )
		{
			$this->content = $content;	
		}	
		
		$section  = eol().'<div'.$this->_attributes($attr).'>';
		
		if( ! empty($this->content) ) 
		{
			$section .= eol()."$this->content";
		}
		
		$section .= eol()."</div>".eol()."$clear";	
		
		if( ! empty($this->clear) )   $this->clear = NULL;
		if( ! empty($this->style) ) 	$this->style = '';
		if( ! empty($this->content) ) $this->content = '';
		if( ! empty($this->attr) )    $this->attr = array();
		
		return $section;
	}
}