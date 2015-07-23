<?PHP
class __USE_STATIC_ACCESS__Date
{
	/***********************************************************************************/
	/* DATE LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Date
	/* Versiyon: 2.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: date::, $this->date, zn::$use->date, uselib('date')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Config Değişkeni
	 *  
	 * Date ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	public function __construct()
	{
		$this->config = Config::get('DateTime');
		date_default_timezone_set($this->config['timeZone']);	
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
	public function current()
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
	public function standart()
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
	public function set($exp = 'H:i:s')
	{
		if( ! is_string($exp) ) 
		{
			return Error::set('Date', 'set', lang('Error', 'stringParameter', 'exp'));
		}

		$chars = $this->config['setDateFormatChars'];
		
		$chars = Arrays::multikey($chars);
		
		$newClock = str_ireplace(array_keys($chars), array_values($chars), $exp);
		
		return date($newClock);
	}
}