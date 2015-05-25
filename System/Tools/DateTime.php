<?PHP
/************************************************************/
/*                     TOOL  DATETIME                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/******************************************************************************************
* Tarih-Saat bölgesi ayarlanıyor. Bu ayarı değiştirmek için Config/DateTime.php bakınız.  *
******************************************************************************************/
date_default_timezone_set(config::get('DateTime', 'timezone'));

/******************************************************************************************
* STANDART TIME                                                                           *
*******************************************************************************************
| Genel Kullanım: Standart tarih ve saat bilgisi üretir.			  	                  |
|																						  |
| Parametreler: Herhangi bir parametresi yoktur.                                          |
|																						  |
| Örnek Kullanım: standart_time() // 12.01.2015 09:02:41								  |
|       																				  |
******************************************************************************************/
if( ! file_exists('standart_time') )
{
	function standart_time()
	{	
		// Config/DateTime.php dosyasından
		// Tarih saat ayarları alınıyor.
		$config = config::get('DateTime');
		
		$setlocale = $config['setlocale'];
		
		// Dil biçimi ayarlanıyor.
		setlocale(LC_ALL, $setlocale['charset'], $setlocale['language']);
		
		// Çıktıda iconv() yöntemi ile TR karakter sorunları düzeltiliyor.
		// Config/DateTime.php dosyasından bu ayarları değiştirmeniz mümkün.
		return strftime("%d %B %Y, %A %H:%M:%S");
	}
}

/******************************************************************************************
* CURRENT TIME                                                                            *
*******************************************************************************************
| Genel Kullanım: Aktif saat bilgisini verir.			  	                              |
|																						  |
| Parametreler: Herhangi bir parametresi yoktur.                                          |
|																						  |
| Örnek Kullanım: current_time() // 09:02:41							                  |
|       																				  |
******************************************************************************************/
if( ! file_exists('current_time') )
{
	function current_time( $clock = '%H:%M:%S' )
	{
		if( ! is_string($clock) ) 
		{
			return false;
		}
		
		$setlocale = config::get('DateTime', 'setlocale');
		
		// Dil biçimi ayarlanıyor.
		setlocale(LC_ALL, $setlocale['charset'], $setlocale['language']);
		
		return strftime($clock);	
	}
}

/******************************************************************************************
* CURRENT DATE                                                                            *
*******************************************************************************************
| Genel Kullanım: Aktif tarih bilgisini verir.			  	                              |
|																						  |
| Parametreler: Herhangi bir parametresi yoktur.                                          |
|																						  |
| Örnek Kullanım: current_date() // 01.01.2006							                  |
|       																				  |
******************************************************************************************/
if( ! file_exists('current_date') )
{
	function current_date()
	{		
		return set_date("<daynum0>.<monnum0>.<year>");
	}
}

/******************************************************************************************
* CURRENT DATE TIME                                                                       *
*******************************************************************************************
| Genel Kullanım: Aktif tarih ve saat bilgisini verir.			  	                      |
|																						  |
| Parametreler: Herhangi bir parametresi yoktur.                                          |
|																						  |
| Örnek Kullanım: current_date_time() // 12.01.2015 09:02:41							  |
|       																				  |
******************************************************************************************/
if( ! file_exists('current_date_time') )
{
	function current_date_time()
	{		
		return set_date("<daynum0>.<monnum0>.<year> <hour024>:<minute>:<second>");
	}
}

/******************************************************************************************
* SET TIME                                                                                *
*******************************************************************************************
| Genel Kullanım: Tarih ve saat ayarlamaları yapmak için kullanılır.			  	      |
|																						  |
| Parametreler: Tek parametresi vardır.                                              	  |
| 1. string var @exp => Tarih ve saat ayarlaması yapmak için kullanılacak biçim 		  |
| karaketerleri.				                                                          |   
|																						  |
| Biçim Karakterler Listesi																  |
| Config/DateTime.php dosyasınki set_time_format_chars parametreli listeye bakınız.		  |
|																						  |
| Örnek Kullanım:  																	      |
| echo set_time('<daynum0>.<monnum0>.<year>'); // Çıktı: 12.01.2015					      |
|       																				  |
******************************************************************************************/
if( ! file_exists('set_time') )
{
	function set_time($exp = '')
	{	
		if( ! is_string($exp) ) 
		{
			return false;
		}
		
		import::tool('Array');
		
		$config = config::get('DateTime'); 
		
		$chars = $config['set_time_format_chars'];
		
		$chars = multi_key_array($chars);
		
		$setExp = str_replace(array_keys($chars), array_values($chars), $exp);
		
		$setlocale = $config['setlocale'];
		
		setlocale(LC_ALL, $setlocale['charset'], $setlocale['language']);
		
		return strftime($setExp);
	}
}

/******************************************************************************************
* SET DATE                                                                                *
*******************************************************************************************
| Genel Kullanım: Tarih ve saat ayarlamaları yapmak için kullanılır.			  	      |
|																						  |
| Parametreler: Tek parametresi vardır.                                              	  |
| 1. string var @exp => Tarih ve saat ayarlaması yapmak için kullanılacak biçim 		  |
| karaketerleri.				                                                          |   
|																						  |
| Biçim Karakterler Listesi																  |
| Config/DateTime.php dosyasınki set_date_format_chars parametreli listeye bakınız.		  |
|																						  |
| Örnek Kullanım:  																	      |
| echo set_date('<daynum0>.<monnum0>.<year>'); // Çıktı: 12.01.2015					      |
|       																				  |
******************************************************************************************/
if( ! file_exists('set_date') )
{
	function set_date($exp = 'h:i:s')
	{
		if( ! is_string($exp) ) 
		{
			return false;
		}
		
		import::tool('Array');
		
		$chars = config::get('DateTime', 'set_date_format_chars');
		
		$chars = multi_key_array($chars);
		
		$newClock = str_replace(array_keys($chars), array_values($chars), $exp);
		
		return date($newClock);
	}
}