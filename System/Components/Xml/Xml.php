<?php
/************************************************************/
/*                     XML COMPONENT                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* XML                                                                                     *
*******************************************************************************************
| Dahil(Import) Edilirken : Xml              							     			  |
| Sınıfı Kullanırken      :	$this->xml->     	     								      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Xml
{
	protected $objects = array
	(
		'charset' 	=> 'utf-8', 
		'version' 	=> '1.0', 
		'node' 	  	=> false,
		'attribute' => NULL,
		'element'   => NULL,
		'content' 	=> NULL
	);
	
	/******************************************************************************************
	* ATTRIBUTES                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Html nesnelerine ait özellik ve değer çifti belirtmek için kullanılır.  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @attributes => Özellik ve değer çiftlerini içerecek dizi parametresi.	  |
	|          																				  |
	| Örnek Kullanım: attributes(array('name' => 'ornek', 'id' => 'zntr'));        			  |
	| // name="ornek" id="zntr"       														  |
	|          																				  |
	******************************************************************************************/	
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
	* ELEMENT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Hangi XML elemanının kullanılacağı belirtilir.					 	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     | 
	| 1. string var @element => Eleman.					      	  				  			  |
	| 2. string var @node  => Elemanın kök eleman olup olmayacağı. Varsayılan:false 		  |
	|          																				  |
	| Örnek Kullanım: ->element('medya', true) // Kök medya elemanı oluşturuldu  		  	  |
	|          																				  |
	******************************************************************************************/
	public function element($element = '', $node = false)
	{
		if( is_string($element) )
		{
			$this->objects['element'] = $element;
		}	
		
		if( $node === true)
		{
			$this->objects['node'] = $node;
		}
		
		return $this;
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
		if( is_value($content) )
		{
			$this->objects['content'] = $content;
		}	
		
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
	public function attr($attribute = array())
	{
		if( is_array($attribute) )
		{
			$this->objects['attribute'] = $attribute;
		}	
		
		return $this;
	}
	
	/******************************************************************************************
	* VERSION                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Xml belgesinin versiyonunu ayarlamak için kullanılır. 			      |
	|																						  |
	******************************************************************************************/	
	public function version($version = '1.0')
	{
		if( is_array($version) )
		{
			$this->objects['version'] = $version;
		}	
		
		return $this;
	}
	
	/******************************************************************************************
	* VERSION                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Xml belgesinin karakter setini ayarlamak için kullanılır. 			  |
	|																						  |
	******************************************************************************************/	
	public function charset($charset = '1.0')
	{
		if( is_charset($charset) )
		{
			$this->objects['charset'] = $charset;
		}	
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Xml belgesini oluşturmak için kullanılan nihai yöntemdir. 			  |
	|																						  |
	******************************************************************************************/	
	function create()
	{		
		if( $this->objects['node'] === true )
		{
			$str = '<?xml version="'.$this->objects['version'].'" encoding="'.$this->objects['charset'].'"?>';
		}		
		else
		{
			$str = '';
		}
		
		$str .= ln().
				'<'.$this->objects['element'].$this->_attributes($this->objects['attribute']).'>'.
				$this->objects['content'].
				'</'.$this->objects['element'].'>'.
				ln();
		
		// Varsayılan dizi ayarları
		$this->objects = array
		(
			'charset' 	=> 'utf-8', 
			'version' 	=> '1.0', 
			'node' 	  	=> false,
			'attribute' => NULL,
			'element'   => NULL,
			'content' 	=> NULL
		);
		
		return $str;
	}	

}