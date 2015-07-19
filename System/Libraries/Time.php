<?PHP
class __USE_STATIC_ACCESS__Time
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
	
	/* Config Değişkeni
	 *  
	 * Date ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	 
	public function __construct()
	{
		$this->config = Config::get('DateTime');
		
		date_default_timezone_set($this->config['timeZone']);	
		
		setlocale(LC_ALL, $this->config['setLocale']['charset'], $this->config['setLocale']['language']);
	}
	
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
	public function standart()
	{	
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
	public function current( $clock = '%H:%M:%S' )
	{
		if( ! is_string($clock) ) 
		{
			return false;
		}
		
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
	public function set($exp = '')
	{	
		if( ! is_string($exp) ) 
		{
			return false;
		}
		
		$chars = $this->config['setTimeFormatChars'];
		
		$chars = Arrays::multikey($chars);
		
		$setExp = str_ireplace(array_keys($chars), array_values($chars), $exp);

		return strftime($setExp);
	}
}