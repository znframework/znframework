<?php
/************************************************************/
/*                       CLASS XML                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Xml
{

	private static $xpath;
	private static $xml_url;
	private static $dom;
	private static $simple_xml;
	
	// herhangi bir xml dosyasını yüklemek için kullanıyorum, parametre olarak dosyanın yolunu yazıyorum.
	

	static function load($path = '', $type = 'file')
	{
		if( ! is_string($path) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'file';
		}
		
		if( $type === 'file' )
		{
			self::$xpath = simplexml_load_file(suffix($path, '.xml'));
			self::$xml_url = $path;
		}
		else
		{
			self::$xpath = simplexml_load_string($path);
		}
		
		return self::$xpath;
	}
	
	// load ile yüklenmiş xml dosyasının istenilen elementine ulaşmak için kullanılmaktadır.
	
	public static function path($path = '')
	{
		if( ! is_string($path) ) 
		{
			return false;
		}
		
		$path = str_replace("/","//",$path);
		
		return self::$xpath->xpath("//".$path);	
	}
	
	// xml dosyası oluşturmak için kullanılıyor.
	
	public static function create($version = "1.0", $charset = "iso-8859-8", $output = true)
	{
		if( ! is_string($version) || empty($version) ) 
		{
			$version = "1.0";
		}
		
		if( ! is_string($charset) || empty($charset)) 
		{
			$charset = "iso-8859-8";
		}
		
		if( ! is_bool($output) ) 
		{
			$output = true;
		}
		
		self::$dom = new DOMDocument($version,$charset);
		
		self::$dom->formatOutput = $output;
		
		return self::$dom;
	}
	
	// oluşturulan xml dosyasına element yani child ekliyor.
	// birinci paremetre eklenecek element, 
	// ikinci paremetre oluşturulan elementin hangi element altında olacağını belirtir.
	// ikinci parametre boş bırakılır ise node yani kök element oluşturur.
	
	public static function add_element($add = '', $to = '')
	{
		if( ! is_string($add) || empty($add) ) 
		{
			return false;
		}
		
		if( ! is_object($to) ) 
		{
			$to = '';
		}
		
		$add = self::$dom->createElement($add);
		
		if( empty($to) ) 
		{
			self::$dom->appendChild($add); 
		}
		else 
		{
			$to->appendChild($add); 
			
			return $add;
		}
		
		return $add;
	}
	
	public static function remove_element($add = '', $to = '')
	{
		if( ! is_object($add) || empty($add) )
		{
			return false;
		}
		
		if( ! is_array($to) )
		{
			if( ! is_object($to) ) 
			{
				return false;
			}
			
			if( $add->hasChildNodes() <= $to->hasChildNodes() ) 
			{
				return false;
			}
			
			$add->removeChild($to); 
		}
		else
		{
			foreach($to as $e)
			{
				if( is_object($e) )
				{
					if( $add->hasChildNodes() > $e->hasChildNodes() ) 
					{
						$add->removeChild($e); 
					}
				}
			}
		}
	}
	
	// oluşturulan elementlerin için yazı ekleme için kullanılır.
	// birinci parametre yazının hangi elemente ekleneceğidir.
	// ikinci parametre eklenecek text'i
	
	
	public static function add_content($to = "", $text = "")
	{
		if( ! is_object($to) )
		{
			return false;
		}
		
		if( ! is_char($text) ) 
		{
			$text = '';
		}
		
		$text = self::$dom->createTextNode($text);
		
		if( empty($to) ) 
		{
			$to = self::$dom;
		}
		
		$to->appendChild($text);
	}
	
	public static function add_attr($element = '', $name = '', $value = '')
	{
		if( ! is_object($element) || empty($element) ) 
		{
			return false;
		}
		
		if( ! is_array($name) )
		{
			if( ! is_string($value) ) 
			{
				$value = '';
			}
			
			$element->setAttribute($name , $value);
		}
		else
		{
			foreach($name as $n => $v)
			{
				$element->setAttribute($n , $v);
			}
		}
	}
	
	public static function remove_attr($element = '', $name = '')
	{
		if( ! is_object($element) || empty($element) ) 
		{
			return false;
		}
		
		if( ! is_char($name) )
		{
			$name = '';
		}
			
		if( ! is_array($name) )
		{
			$element->removeAttribute($name);
		}
		else
		{
			foreach($name as $n)
			{
				$element->removeAttribute($n);
			}
		}
	}
	
	public static function get_attr($element = '', $name = '')
	{
		if( ! is_object($element) || empty($element) ) 
		{
			return false;
		}
			
		if( ! is_array($name) )
		{
			if( ! is_string($value) ) 
			{
				$value = '';
			}
			
			return $element->getAttribute($name);
		}
		else
		{
			$attr = array();
			
			foreach($name as $n)
			{
				$attr[$n] = $element->getAttribute($n);
			}
			
			return $attr;
		}
	}
	
	public static function get_contents_by_name($name = '')
	{
		if( ! is_string($name) || empty($name) ) 
		{
			return false;
		}
		
		$all = '';
		
		$elements = self::$dom->getElementsByTagName($name);
		
		foreach($elements as $element)
		{
			$all[] = $element->textContent;
		}
		
		return $all;
	}
	
	public static function get_content_by_id($id = '')
	{
		if( ! is_string($id) || empty($id) ) 
		{
			return false;
		}
			
		$element = self::$dom->getElementById($id);
		
		return $element->textContent;
	}
	
	public static function get_content($name = '')
	{
		if( ! is_object($name) || empty($name) ) 
		{
			return false;
		}
			
		return $name->textContent;
	}
	
	
	
	// save kodla oluşturulan xml dosyasının çalıştırılmasını sağlayan fonksiyondur.
	
	public static function save()
	{
		$dom = self::$dom;
		
		if( isset(self::$dom) ) 		self::$dom = NULL;
		if( isset(self::$xml_url) )	 	self::$xml_url = NULL;
		if( isset(self::$xpath) ) 		self::$xpath = NULL;
		if( isset(self::$simple_xml) ) 	self::$simple_xml = NULL;
		
		return $dom->saveXML();
	}
}
