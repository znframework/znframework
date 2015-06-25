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
date_default_timezone_set(Config::get('DateTime', 'timeZone'));
/******************************************************************************************
* DATE TIME                                                                           	  *
*******************************************************************************************
| Sınıfı Kullanırken : convert::, $this->convert, zn::$use->convert, uselib('convert')	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Date
{
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
	public static function current()
	{		
		return date("d.m.o");
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
	public static function standart()
	{		
		return date("d.F.o l, H:i:s");
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
	public static function set($exp = 'H:i:s')
	{
		if( ! is_string($exp) ) 
		{
			return false;
		}

		$chars = Config::get('DateTime', 'setDateFormatChars');
		
		$chars = Arrays::multikey($chars);
		
		$newClock = str_ireplace(array_keys($chars), array_values($chars), $exp);
		
		return date($newClock);
	}
}