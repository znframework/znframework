<?php
class __USE_STATIC_ACCESS__Build
{
	/***********************************************************************************/
	/* BUILD LIBRARY		    		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Build
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: build::, $this->build, zn::$use->build, uselib('build')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* PROTECTED ATTRIBUTES                                                                    *
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
	protected function attributes($attributes = '')
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
	* XML BUILDER                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Xml belgesi oluşturmak için kullanılır. 								  |
	|																						  |
	| Parametreler: 5 parametresi vardır.                                              		  |
	| 1. string var @element => Eleman ismi.						     	  				  |
	| 2. string var @content => Elemanın içeriği.		      								  |
	| 3. array var @attribute => Özellik eklemek içindir.									  |
	| 4. [ string var @version ] => Oluşturulacak belgenin sürümü. Varsayılan:1.0    		  |
	| 5. [ string var @encoding ] => Oluşturulacak belgenin karakter seti. Varsayılan:utf-8   |
	|																						  |
	******************************************************************************************/	
	public function xml($elements = '', $content = '', $attribute = '', $version = '1.0', $encoding = 'utf-8')
	{		
		if( ! is_string($elements) || empty($elements) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'elements'));	
		}
		if( ! isValue($content) ) 
		{
			$content = '';	
		}
		if( ! is_string($version) ) 
		{
			$version = '1.0';
		}
		if( ! is_string($encoding) ) 
		{
			$encoding = 'utf-8';
		}

		if( strstr($elements, "node") )
		{
			$elementsEx = explode("=", $elements);
			$elements   = trim($elementsEx[1]);
			$str 		= '<?xml version="'.$version.'" encoding="'.$encoding.'"?>';
		}		
		else
		{
			$str = '';
		}
		
		$str .= eol().'<'.$elements.$this->attributes($attribute).'>'.$content.'</'.$elements.'>'.eol();
		
		return $str;
	}	

	/******************************************************************************************
	* LISTS BUILDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Liste oluşturmak için kullanılır. 							     	  |
	|																						  |
	| Parametreler: 5 parametresi vardır.                                              		  |
	| 1. array var @elements => Listeyi oluşturacak seçenekler.						     	  |
	| 2. array var @attributes => Listeye özellik eklemek için.		      					  |
	| 3. string var @type => Liste türü. Varsayılan:ul   									  |
	|																						  |
	******************************************************************************************/	
	public function lists($elements = '', $attributes = '', $type = 'ul')
	{
		if( ! is_array($elements) || empty($elements) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'elements'));
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'ul';
		}
		
		$list = '<'.$type.$this->attributes($attributes).'>'.eol();
		
		$i = 0;
		
		foreach( $elements as $k => $values )
		{
			$list .= "\t".'<li>'.$values.'</li>'.eol();
			$i++;
		}
		
		$list .= '</'.$type.'>'.eol();
		
		return $list;
	}

	/******************************************************************************************
	* TABLE BUILDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Tablo oluşturmak için kullanılır. 							     	  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @elements => Tabloya oluşturacak satır ve sütunlar.				     	  |
	| 2. array var @attributes => Tabloya özellik eklemek için.		      					  |
	|																						  |
	******************************************************************************************/	
	public function table($elements = '', $attributes = '')
	{
		if( ! is_array($elements) || empty($elements) ) 
		{
			return Error::set(lang('Error', 'arrayParameter', 'elements'));
		}
		
		$table = '<table '.$this->attributes($attributes).'>';
		$colno = 1;
		$rowno = 1;
		
		foreach( $elements as $key => $element )
		{
			$table .= eol()."\t".'<tr>'.eol();
			
			if( is_array($element) ) foreach( $element as $k => $v )
			{
				$val  = $v;
				$attr = '';
				
				if( is_array($v) )
				{
					$attr = $this->attributes($v);
					$val  = $k;
				}
			
				$table .= "\t\t".'<td'.$attr.'>'.$val.'</td>'.eol();	
				$colno++;
			}
		
			$table .= "\t".'</tr>'.eol();
			$rowno++;
		}
		
		$table .= '</table>';
		
		return $table;
	}
}