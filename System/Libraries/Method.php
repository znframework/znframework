<?php
/************************************************************/
/*                       CLASS METHOD                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* METHOD                                                                            	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	method:: , $this->method , uselib('method') , zn::$use->method|
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Method
{
	/******************************************************************************************
	* POST                                                                                    *
	*******************************************************************************************
	| Genel Kullanım:$_POST Global değişkeninin kullanımıdır.                                 |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Post değişkeninin anahtar ismidir. $_POST['isim']       	  	  |
	| 2. string var @value => Anahtarın tutacağı veri. $_POST['isim'] = 'Değer'               |
	|          																				  |
	| Örnek Kullanım: post('isim', 'Değer');        	  					                  |
	| // $_POST['isim'] = 'Değer'      													      |
	|          																				  |
	******************************************************************************************/	
	public static function post($name = '', $value = '')
	{
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($name) ) 
		{
			return false;
		}
		
		if( empty($name) ) 
		{
			return $_POST;
		}
		// ---------------------------------------------------------------------------
		
		// @value parametresi boş değilse
		if( ! empty($value) )
		{
			$_POST[$name] = $value;
		}
		
		// Global veri içersinde
		// böyle bir veri yoksa
		if( empty($_POST[$name]) ) 
		{
			return false;
		}
		
		return $_POST[$name];
	}	
	
	/******************************************************************************************
	* GET                                                                                     *
	*******************************************************************************************
	| Genel Kullanım:$_GET Global değişkeninin kullanımıdır.                                  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Get değişkeninin anahtar ismidir. $_GET['isim']       	  	      |
	| 2. string var @value => Anahtarın tutacağı veri. $_GET['isim'] = 'Değer'                |
	|          																				  |
	| Örnek Kullanım: get('isim', 'Değer');        	  					                      |
	| // $_GET['isim'] = 'Değer'      													      |
	|          																				  |
	******************************************************************************************/	
	public static function get($name = '', $value = '')
	{
		if( ! is_string($name) ) 
		{
			return false;
		}
		
		if( empty($name) ) 
		{
			return $_GET;
		}
		
		if( ! empty($value) )
		{
			$_GET[$name] = $value;
		}
		
		if( empty($_GET[$name]) ) 
		{
			return false;
		}
		
		return $_GET[$name];	
	}
	
	/******************************************************************************************
	* REQUEST                                                                                 *
	*******************************************************************************************
	| Genel Kullanım:$_REQUEST Global değişkeninin kullanımıdır.                              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Request değişkeninin anahtar ismidir. $_REQUEST['isim']       	  |
	| 2. string var @value => Anahtarın tutacağı veri. $_REQUEST['isim'] = 'Değer'            |
	|          																				  |
	| Örnek Kullanım: request('isim', 'Değer');        	  					                  |
	| // $_REQUEST['isim'] = 'Değer'      													  |
	|          																				  |
	******************************************************************************************/	
	public static function request($name = '', $value = '')
	{
		if( ! is_string($name) ) 
		{
			return false;
		}
		
		if( empty($name) ) 
		{
			return $_REQUEST;
		}
		
		if( ! empty($value) )
		{
			$_REQUEST[$name] = $value;
		}
		
		if( empty($_REQUEST[$name]) ) 
		{
			return false;
		}
		
		return $_REQUEST[$name];
	}
	
	/******************************************************************************************
	* FILES                                                                                   *
	*******************************************************************************************
	| Genel Kullanım:$_FILES Global değişkeninin kullanımıdır.                                |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @file_name => Request değişkeninin anahtar ismidir.$_FILES['upload']	  |
	| 2. [ string var @type ] => Veri türü. Varsayılan:name. $_FILES['upload']['name']        |
	|          																				  |
	| Örnek Kullanım: request('upload', 'name');        	  					              |
	| // $_FILES['upload']['name']      											          |
	|          																				  |
	******************************************************************************************/	
	public static function files($file_name = '', $type = 'name')
	{
		if( ! is_string($file_name) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'name';
		}
		
		if( empty($file_name) ) 
		{
			return false;
		}
		
		return $_FILES[$file_name][$type];
	}
	
	
}