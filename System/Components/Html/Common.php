<?php
/************************************************************/
/*                    COMPONENT  COMMON                   	*/
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Html;
/******************************************************************************************
* PROTECTED COMMON                                                                        *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.     							     		  |
| Sınıfı Kullanırken      :	Kullanılamaz.       									      |
| 																						  |
| NOT: Yardımcı sınıftır.     															  |
******************************************************************************************/
class ComponentHtmlCommon
{
	protected $link;
	
	// Protected attributes() yöntemi
	// Html formunda özellik değer çifti
	// oluşturmak için oluşturulmuştur.
	protected function _attributes($attributes = '')
	{
		$attribute = '';
		
		if( is_array($attributes) )
		{
			foreach($attributes as $key => $values)
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
	
	/******************************************************************************************
	* CONTENT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak elemanın içeriğidir.					 			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @content => Elemanın içeriği.					      	  				  |
	|          																				  |
	| Örnek Kullanım: ->content('Merhaba')         											  |
	|          																				  |
	******************************************************************************************/
	public function content($content = '')
	{
		if( ! is_value($content) )
		{
			return $this;	
		}
		
		$this->link['content'] = $content;
		
		return $this;
	}
	
	/******************************************************************************************
	* CSS                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Nesneye css sınıfları eklemek için kullanılır.						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @css => Eklenecek css sınıfları.					      	  			  |
	|          																				  |
	| Örnek Kullanım: ->css('red-color bold')         										  |
	|          																				  |
	******************************************************************************************/
	public function css($css = '')
	{
		if( ! is_string($css) )
		{
			return $this;	
		}
		
		$this->link['attr']['class'] = $css;
		
		return $this;
	}
	
	/******************************************************************************************
	* STYLE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Nesneye stil eklemek için kullanılır.						  		      |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. numeric var @_attributes => Eklenecek stiller.					      	  			  |
	|          																				  |
	| Örnek Kullanım: ->style(array('color' => 'red'))         								  |
	|          																				  |
	******************************************************************************************/
	public function style($_attributes = array())
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
		
		$this->link['attr']['style'] = $attribute;
		
		return $this;	
	}
	

	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak html elemanına özellik değer çift eklemek içindir.		  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              | 
	| 1. array var @attributes => Eklenecek özellik değer çiftleri.					      	  |
	|          																				  |
	| Örnek Kullanım: ->attr(array('name' => 'ornek'))         								  |
	|          																				  |
	******************************************************************************************/
	public function attr($attributes = array())
	{
		if( ! is_array($attributes))
		{
			return $this;	
		}
		
		$this->link['attr'] = $attributes; 
		
		return $this;
	}
}