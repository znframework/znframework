<?PHP
/************************************************************/
/*                    LIBRARY  DATETIME                     */
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
* DATE TIME                                                                           	  *
*******************************************************************************************
| Sınıfı Kullanırken : convert::, $this->convert, zn::$use->convert, uselib('convert')	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class DateTime
{
	/******************************************************************************************
	* STANDART TIME                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Standart tarih ve saat bilgisi üretir.			  	                  |
	|																						  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|																						  |
	| Örnek Kullanım: standartTime() // 12.01.2015 09:02:41								  |
	|       																				  |
	******************************************************************************************/
	public static function standartTime()
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

	/******************************************************************************************
	* CURRENT TIME                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Aktif saat bilgisini verir.			  	                              |
	|																						  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|																						  |
	| Örnek Kullanım: currentTime() // 09:02:41							                  |
	|       																				  |
	******************************************************************************************/
	public static function currentTime( $clock = '%H:%M:%S' )
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

	/******************************************************************************************
	* CURRENT DATE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Aktif tarih bilgisini verir.			  	                              |
	|																						  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|																						  |
	| Örnek Kullanım: currentDate() // 01.01.2006							                  |
	|       																				  |
	******************************************************************************************/
	public static function currentDate()
	{		
		return self::setDate("<daynum0>.<monnum0>.<year>");
	}


	/******************************************************************************************
	* CURRENT                                                                       		  *
	*******************************************************************************************
	| Genel Kullanım: Aktif tarih ve saat bilgisini verir.			  	                      |
	|																						  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|																						  |
	| Örnek Kullanım: current_date_time() // 12.01.2015 09:02:41							  |
	|       																				  |
	******************************************************************************************/
	public static function current()
	{		
		return self::setDate("<daynum0>.<monnum0>.<year> <hour024>:<minute>:<second>");
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
	| echo setTime('<daynum0>.<monnum0>.<year>'); // Çıktı: 12.01.2015					      |
	|       																				  |
	******************************************************************************************/
	public static function setTime($exp = '')
	{	
		if( ! is_string($exp) ) 
		{
			return false;
		}

		$config = config::get('DateTime'); 
		
		$chars = $config['set_time_format_chars'];
		
		$chars = arrays::multikey($chars);
		
		$setExp = str_replace(array_keys($chars), array_values($chars), $exp);
		
		$setlocale = $config['setlocale'];
		
		setlocale(LC_ALL, $setlocale['charset'], $setlocale['language']);
		
		return strftime($setExp);
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
	| echo setDate('<daynum0>.<monnum0>.<year>'); // Çıktı: 12.01.2015					      |
	|       																				  |
	******************************************************************************************/
	public static function setDate($exp = 'h:i:s')
	{
		if( ! is_string($exp) ) 
		{
			return false;
		}

		$chars = config::get('DateTime', 'set_date_format_chars');
		
		$chars = arrays::multikey($chars);
		
		$newClock = str_replace(array_keys($chars), array_values($chars), $exp);
		
		return date($newClock);
	}
}