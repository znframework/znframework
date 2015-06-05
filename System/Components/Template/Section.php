<?php
/************************************************************/
/*                     SECTION COMPONENT                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SECTION                                                                                 *
*******************************************************************************************
| Dahil(Import) Edilirken : Template/Section      							     	      |
| Sınıfı Kullanırken      :	$this->section->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentTemplateSection
{
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
		if( ! is_value($id))
		{
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
		if( ! is_value($name))
		{
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
		if( ! is_value($border) )
		{
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
	| Örnek Kullanım: ->border_type('dashed')					  		  			  	      |
	|          																				  |
	******************************************************************************************/
	public function border_type($border = 'solid')
	{
		if( ! is_value($border) )
		{
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
	public function border_color($border_color = '')
	{
		if( ! is_value($border_color) )
		{
			return $this;	
		}
		
		if( is_numeric($border_color) )
		{
			$border_color = '#'.$border_color;	
		}
		
		if( ! empty($border_color) ) 
		{
			$this->style .= ' border-color:'.$border_color.';';
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
	| Örnek Kullanım: ->border_size(5) // 5px						  		  			  	  |
	|          																				  |
	******************************************************************************************/
	public function border_size($border_size = '')
	{
		if( ! is_value($border_size) )
		{
			return $this;	
		}
		
		if( is_numeric($border_size) )
		{
			$border_size = $border_size.'px';	
		}
		
		if( ! empty($border_size)) $this->style .= ' border-width:'.$border_size.';';
			
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
		if( ! is_value($color) )
		{
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
	public function font_color($color = '')
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
	| Örnek Kullanım: ->font_size(5) // 5px						  		  			  	      |
	|          																				  |
	******************************************************************************************/
	public function font_size($font_size = '')
	{
		if( ! is_value($font_size) )
		{
			return $this;	
		}
		
		if( is_numeric($font_size) )
		{
			$font_size = $font_size.'px';	
		}
		
		if( ! empty($font_size)) $this->style .= ' font-size:'.$font_size.';';
		
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
	| Örnek Kullanım: ->font_type('Arial')					  		  			  	     	  |
	|          																				  |
	******************************************************************************************/
	public function font_type($family = 'Tahoma')
	{
		if( ! is_value($family) )
		{
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
	public function font_family($family = 'Tahoma')
	{
		if( ! is_value($family) )
		{
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
	public function bgcolor($bgcolor = '')
	{
		if( ! is_value($bgcolor) )
		{
			return $this;	
		}
		
		if( is_numeric($bgcolor) )
		{
			$bgcolor = '#'.$bgcolor;	
		}
		
		if( ! empty($bgcolor)) $this->style .= ' background-color:'.$bgcolor.';';
		
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
		if( ! is_value($zindex) )
		{
			return $this;	
		}
		
		if( ! empty($zindex)) $this->style .= ' z-index:'.$zindex.';';
		
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
		
		$section  = ln().'<div '.$style.'></div>'.ln();
		
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
		
		if( ! empty($align) ) 
		{
			$this->style .= ' float:'.$align.';';
		}
		
		return $this;
	}
	
	public function margin($margin = '')
	{
		if( ! is_value($margin) )
		{
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
		if( ! ( is_value($x) || is_value() ) )
		{
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
		if( ! is_value($padding) )
		{
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
		if( ! is_value($content) )
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
		
		if( ! empty($content) )
		{
			$this->content = $content;	
		}	
		
		$section  = ln().'<div'.$this->_attributes($attr).'>';
		
		if( ! empty($this->content) ) 
		{
			$section .= ln()."$this->content";
		}
		
		$section .= ln()."</div>".ln()."$clear";	
		
		if( ! empty($this->clear) )   $this->clear = NULL;
		if( ! empty($this->style) ) 	$this->style = '';
		if( ! empty($this->content) ) $this->content = '';
		if( ! empty($this->attr) )    $this->attr = array();
		return $section;
	}
}