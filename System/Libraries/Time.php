<?PHP
date_default_timezone_set(Config::get('DateTime', 'timeZone'));
class Time
{
	/***********************************************************************************/
	/* TIME LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Time
	/* Versiyon: 2.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: time::, $this->time, zn::$use->time, uselib('time')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* STANDART TIME                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Standart tarih ve saat bilgisi üretir.			  	                  |
	|																						  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|																						  |
	| Örnek Kullanım: standartTime() // 12.01.2015 09:02:41								  	  |
	|       																				  |
	******************************************************************************************/
	public static function standart()
	{	
		// Config/DateTime.php dosyasından
		// Tarih saat ayarları alınıyor.
		$config = Config::get('DateTime');
		
		$setLocale = $config['setLocale'];
		
		// Dil biçimi ayarlanıyor.
		setlocale(LC_ALL, $setLocale['charset'], $setLocale['language']);
		
		// Çıktıda iconv() yöntemi ile TR karakter sorunları düzeltiliyor.
		// Config/DateTime.php dosyasından bu ayarları değiştirmeniz mümkün.
		return strftime("%d %B %Y %A, %H:%M:%S");
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
	public static function current( $clock = '%H:%M:%S' )
	{
		if( ! is_string($clock) ) 
		{
			return false;
		}
		
		$setLocale = Config::get('DateTime', 'setLocale');
		
		// Dil biçimi ayarlanıyor.
		setlocale(LC_ALL, $setLocale['charset'], $setLocale['language']);
		
		return strftime($clock);	
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
	public static function set($exp = '')
	{	
		if( ! is_string($exp) ) 
		{
			return false;
		}

		$config = Config::get('DateTime'); 
		
		$chars = $config['setTimeFormatChars'];
		
		$chars = Arrays::multikey($chars);
		
		$setExp = str_ireplace(array_keys($chars), array_values($chars), $exp);
		
		$setLocale = $config['setLocale'];
		
		setlocale(LC_ALL, $setLocale['charset'], $setLocale['language']);
		
		return strftime($setExp);
	}
}