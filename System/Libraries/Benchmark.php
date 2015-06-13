<?php 
/************************************************************/
/*                     CLASS  BENCHMARK                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* BENCHMARK                                                                           	  *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Etmeye Gerek Yoktur.   							      |
| Sınıfı Kullanırken      :	benchmark::, $this->benchmark, zn::$use->benchmark	 		  |
| this()->benchmark	  																	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Benchmark
{
	/* Tests Dizi Değişkeni
	 *  
	 * Oluşturulan farklı testlerin isim ve süre bilgilerini
	 * barındırmak için oluşturulmuştur.
	 *
	 */
	private static $tests = array();
	
	/* Memtests Dizi Değişkeni
	 *  
	 * Oluşturulan farklı testlerin bellek miktarı bilgilerini
	 * barındırmak için oluşturulmuştur.
	 *
	 */
	private static $memtests = array();
	
	/* Test Count Dizi Değişkeni
	 *  
	 * Oluşturulan test sayısını hesaplamak
	 * için oluşturulmuştur.
	 *
	 */
	private static $test_count = 0;
	
	/******************************************************************************************
	* TEST START                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Testi başlatmak için kullanılır. Hesaplanacak kodların başında		  |
	| başında kullanılır.										  							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @test => Başlatılacak testin isim bilgisini tutar.					      |
	|          																				  |
	******************************************************************************************/
	public static function testStart($test = '')
	{
		if( ! is_string($test)) 
		{
			return false;
		}
		
		// Kaç test kullanıldığını hesaplamak için
		// test count değişkeni birer birer artırılıyor.
		self::$test_count++;
		
		// Yöntem içinden tanımlanan kodlardan kaynaklı
		// fazlalık hesaplanıyor.
		$legancy = ( self::$test_count === 1 ) 
				   ? $legancy = 136 
				   : 56;
	
		$test = $test."_start";
		
		// Mikrotime yöntemi başlatılıyor.
		self::$tests[$test]    = microtime();
		// Bu satıra kadar olan bellek miktarı hesaplanıyor.
		self::$memtests[$test] = memory_get_usage() + $legancy;
	}
	
	/******************************************************************************************
	* TEST END                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Testi sonlandırmak için kullanılır. Hesaplanacak kodların sonunda		  |
	| başında kullanılır.										  							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @test => Sonlandırılacak testin isim bilgisini tutar.					  |
	|          																				  |
	******************************************************************************************/
	public static function testEnd($test = '')
	{
		if( ! is_string($test) ) 
		{
			return false;
		}
		
		$test = $test."_end";
		
		self::$memtests[$test] = memory_get_usage();	
		
		self::$tests[$test]    = microtime();		
	}
	
	/******************************************************************************************
	* ELAPSED TIME                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Test esnasında toplam geçen süreyi hesaplamak için kullanılır.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @result => Hesaplanacak testin isim bilgisini tutar.					  |
	| 2. numeric var @decimal => Dönen zaman bilgisinin ondalıklı bölümünün                   |
	| kaç karakter olacağı bilgisidir. Varsayılan: 4					  					  |
	|          																				  |
	******************************************************************************************/
	public static function elapsedTime($result = '', $decimal = 4)
	{   
		if( ! is_string($result) ) 
		{
			return false;
		}
		if( ! is_numeric($decimal) ) 
		{
			$decimal = 4;
		}
		
		$resend  = $result."_end";
		$restart = $result."_start";
		
		if( isset(self::$tests[$resend]) && isset(self::$tests[$restart]) )
		{
			return round((self::$tests[$resend] - self::$tests[$restart]), $decimal);
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* MEMORY USAGE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sistemin kullandığı toplam bellek boyutunu hesaplamak için kullanılır.  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @real_memory => true: Gerçek bellek kullanım bilgisini verir.		      |
	|															                              |
	******************************************************************************************/
	public static function memoryUsage($real_memory = false)
	{
		if( ! is_bool($real_memory) ) 
		{
			$real_memory = false;
		}
		
		return  memory_get_usage($real_memory);
	}
	
	/******************************************************************************************
	* MAX MEMORY USAGE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Sistemin PHP betiği için ayırdığı toplam bellek miktarıdır.             |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @real_memory => true: Gerçek bellek kullanım bilgisini verir.		      |
	|															                              |
	******************************************************************************************/
	public static function maxMemoryUsage($real_memory = false)
	{
		if( ! is_bool($real_memory) ) 
		{
			$real_memory = false;
		}
		
		return  memory_get_peak_usage($real_memory);
	}
	
	/******************************************************************************************
	* CALCULATED MEMORY                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Test edilen kodların bellekte ne kadar yer kapladığı bilgisini verir.   |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @result => Sonucu öğrenilmek istenen testin isim bilgisi.		          |
	|															                              |
	******************************************************************************************/
	public static function calculatedMemory($result = '')
	{
		if( ! is_string($result) ) 
		{
			return false;
		}
		
		$resend  = $result."_end";
		$restart = $result."_start";

		if( isset(self::$memtests[$resend]) && isset(self::$memtests[$restart]) )
		{
			$calc = self::$memtests[$resend] - self::$memtests[$restart];
		
			return $calc;
		}
		else
		{
			return false;
		}
	}

}