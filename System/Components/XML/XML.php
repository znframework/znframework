<?php
class __USE_STATIC_ACCESS__CXML
{
	/***********************************************************************************/
	/* XML COMPONENT	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CXML
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->cxml, zn::$use->cxml, uselib('cxml')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
		else
		{
			Error::set(lang('Error', 'stringParameter', 'element'));	
		}
		
		if( $node === true )
		{
			$this->objects['node'] = $node;
		}
		else
		{
			Error::set(lang('Error', 'booleanParameter', 'node'));		
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
		if( isValue($content) )
		{
			$this->objects['content'] = $content;
		}	
		else
		{
			Error::set(lang('Error', 'valueParameter', 'content'));		
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
		else
		{
			Error::set(lang('Error', 'arrayParameter', 'attribute'));		
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
		if( is_string($version) )
		{
			$this->objects['version'] = $version;
		}
		else
		{
			Error::set(lang('Error', 'stringParameter', 'version'));		
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
		if( isCharset($charset) )
		{
			$this->objects['charset'] = $charset;
		}	
		else
		{
			Error::set(lang('Error', 'charsetParameter', 'charset'));		
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
		
		$str .= eol().
				'<'.$this->objects['element'].$this->_attributes($this->objects['attribute']).'>'.
				$this->objects['content'].
				'</'.$this->objects['element'].'>'.
				eol();
		
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