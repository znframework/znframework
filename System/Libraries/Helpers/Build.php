<?php
class __USE_STATIC_ACCESS__Build
{
	/***********************************************************************************/
	/* BUILD LIBRARY		    		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
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
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Build::$method()"));	
	}
	
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
	| 1. array var @element => Eleman ismi.						     	  				  |
	| 4. [ string var @version ] => Oluşturulacak belgenin sürümü. Varsayılan:1.0    		  |
	| 5. [ string var @encoding ] => Oluşturulacak belgenin karakter seti. Varsayılan:utf-8   |
	|																						  |
	******************************************************************************************/	
	public function xml($elements = '', $version = '1.0', $encoding = 'utf-8')
	{		
		return XML::build($elements, $version, $encoding);
	}	

	/******************************************************************************************
	* SCHEDULE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Liste oluşturmak için kullanılır. 							     	  |
	  
	  @param array $elements
	  
	  @return string
	|																						  |
	******************************************************************************************/	
	public function schedule($elements = array())
	{
		return Schedule::create($elements);
	}

	/******************************************************************************************
	* TABLE BUILDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Tablo oluşturmak için kullanılır. 							     	  |
	
	  @param array $elements
	  @param array $attributes
	  
	  @return string 
	|																						  |
	******************************************************************************************/	
	public function table($elements = array(), $attributes = array())
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