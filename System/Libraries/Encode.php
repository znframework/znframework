<?php
/************************************************************/
/*                       CLASS  ENCODE                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* ENCODE                                                                            	  *
*******************************************************************************************
| Dahil(Import) Edilirken : Encode   							                          |
| Sınıfı Kullanırken      :	encode::    											      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Encode
{
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Rastgele şifre oluşturmak için kullanılır.						      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @count => Şifrenin karakter uzunluğu. Varsayılan:6						  |
	| 1. string var @chars => Şifrelemede hangi karakterlerin kullanılacağı. Varsayılan:all	  |
	|          																				  |
	| Örnek Kullanım: create(5);        									                  |
	|          																				  |
	******************************************************************************************/
	public static function create($count = 6, $chars = 'all')
	{
		// Parametre numeric yani sayısal veri içermelidir.
		if( ! is_numeric($count) ) 
		{
			$count = 6;
		}
		
		if( ! is_string($chars) ) 
		{
			$chars = "all";
		}
		
		$password   	= '';
		
		// Şifreleme için kullanılacak karakter listesi.
		if( $chars === "all" ) 
		{
			$characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		}
		if( $chars === "numeric" ) 
		{
			$characters = "1234567890";
		}
		if( $chars === "string" || $chars === "alpha" )
		{ 
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		}
		
		// Parametre olarak belirtilen sayı kadar karakter
		// listesinden karakterler seçilerek
		// rastgele şifre oluşturulur.
		for($i=0; $i < $count; $i++)
		{
			$password .= substr( $characters, rand( 0, strlen($characters)), 1 );	
		}
		
		return $password;
	}	
	
	/******************************************************************************************
	* GOLDEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Şifreleme yapmak için kullanılır. md5 şifreleme yöntemini kullanır.	  |
	| ama bu şifrelemenin adının altın olmasın sebebi şifreye ek belirtmenizdir. Böylece	  |
	| aynı veri için farklı şifrlemeler yapabilirsiniz.									      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string/numeric var @data => Şifrelenecek veri.						  			      |
	| 2. string/numeric var @additional => Şifrelenecek veriye eklenecek veri.        	      |
	|          																				  |
	| Örnek Kullanım: golden('data', 'extra1');        									      |
	| Örnek Kullanım: golden('data', 'extra2');  											  |
	|																						  |
	| Yukarıdaki kullanımların çıktıları birbirinden farklı olacaktır.      				  |
	|          																				  |
	******************************************************************************************/
	public static function golden($data = '', $additional = 'default')
	{
		if( ! is_value($data) ) 
		{
			return false;
		}
		
		if( ! is_value($additional) )
		{
			$additional = 'default';
		}
		
		if( empty($data) ) 
		{
			return false;
		}
		
		$algo = config::get('Encode', 'type');
		
		if( ! is_hash($algo) )
		{
			$algo = 'md5';	
		}
		// Ek veri şifreleniyor.
		
		$additional = hash($algo, $additional);
		
		// Veri şifreleniyor.
		$data = hash($algo, $data);
		
		// Veri ve ek yeniden şifreleniyor.
		return hash($algo, $data.$additional);

		
	}	
	
	/******************************************************************************************
	* SUPER                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Şifreleme yapmak için kullanılır. md5 şifreleme yöntemini kullanır.	  |
	| ama bu şifrelemenin adının süper olmasın sebebi şifreye eki harici bir dosyadan         |
	| belirtmenizdir. Böylece aynı veri için farklı şifrlemeler yapabilirsiniz.				  |
	|															                              |
	| Parametreler: 1 parametresi vardır.                                                     |
	| 1. string/numeric var @data => Şifrelenecek veri.						  			      |
	|          																				  |
	| Örnek Kullanım: super('data', 'extra1');        									      |
	|																						  |
	| Not:Şifre eki Config/Encode.php dosyasında yer alan proje anahtarı bölümündedir.   	  |
	|          																				  |
	******************************************************************************************/
	public static function super($data = '')
	{
		if( ! is_value($data) ) 
		{
			return false;
		}
		
		if( empty($data) ) 
		{	
			return false;
		}
		
		$project_key = config::get('Encode','project_key');
		
		$algo = config::get('Encode', 'type');
		
		if( ! is_hash($algo) )
		{
			$algo = 'md5';	
		}
		
		// Proje Anahatarı belirtizme bu veri yerine
		// Proje anahtarı olarak sitenin host adresi
		// eklenecek ek veri kabul edilir.
		if( empty($project_key) ) 
		{
			$additional = hash($algo, host()); 
		}
		else 
		{
			$additional = hash($algo, $project_key);
		}
		
		// Veri şifreleniyor.
		$data = hash($algo, $data);
		
		// Veri ve ek yeniden şifreleniyor.
		return hash($algo, $data.$additional);

	}
	
	/******************************************************************************************
	* TYPE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veriyi istenilen şifreleme algoritmasına göre şifrelemek içindir.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string/numeric var @data => Şifrelenecek veri.						  			      |
	| 3. string var @type => Şifreleme Türü. Varsayılan:md5						  			  |
	|          																				  |
	| Örnek Kullanım: type('data', 'sha1');        									          |
	|																						  |
	| Not:Şifreleme türünüz geçerli şifreleme algoritması olmak zorundadır. 			  	  |
	|          																				  |
	******************************************************************************************/
	public static function type($data = '', $type = 'md5')
	{
		if( ! is_value($data) ) 
		{
			return false;
		}
		
		// String veri dışında veri girilerse
		// Akışı devam ettirmek için 
		// 2. parametre varsayılan ayarına getiriliyor.
		if( ! is_string($type) ) 
		{
			$type = 'md5';
		}
		
		// md5 için
		if( $type === 'md5' )
		{
			return md5($data);
		}
		else if( $type === 'sha1' )
		{
			// sha1 için
			return sha1($data);	
		}
		else
		{
			// md5 ve sha1 dışında şifre algoritmaları için
			if( in_array($type, hash_algos()) )
			{
				return hash($type, $data);
			}
			else
			{
				// bunlar dışındaki her durum için md5.
				return md5($data);
			}
		}
	}
}