<?php
/******************************************************************\
|                          ZN Framework                            |
\******************************************************************/

/*
 * Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
 * Site: www.zntr.net
 * Lisans: The MIT License
 * Telif Hakki: Copyright (c) 2012-2015, zntr.net
 *
 * @package	ZN Framework
 * @author	Ozan UYKUN <ozanbote@windowslive.com>
 * @copyright	Copyright (c) 2015, (http://zntr.net/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://zntr.net
 * @since	Version 1.0.0
 * @filesource
 */

/*
 * 
 * Temel sistem ayarlari
 * 
 * 1 - Application Directory: Uygulamanin yer alacagi dizini ayarlamak içindir.
 * SONUNDA BÖLÜ (/) ISARETI KULLANMAYINIZ
 *
 * 2 - Application Type: Uygulama türünü ayarlamak içindir.
		local		: Yerel sunucuda çalisirken tercih edilebilir.
		development	: Proje'nin gelistirilmesi asamasinda tercih edilebilir.
		publication	: Proje'nin yayinlanmasi ile bu seçenek tercih edilebilir.
 * 
 * 3 - Benchmark Performance Test: Sistemin açilis hizini test etmek içindir.
		true		: Sayfanin yüklenmek hizi ve kullandigi bellek miktarini gösteren bir tablo çiktilar.
		false		: Herhangi bir tablo çiktilamaz.
 * 
 */
 
 
	$settings = array(
		'applicationDirectory' => 'Application',
		'applicationType'      => 'local',
		'benchmarkingTest'     => false
		);

/*------------------------------------------------------------------
 *  Sistem çalistiriliyor...
 *------------------------------------------------------------------
 */
System::run($settings);
 
class System
{
	public static function run($settings)
	{	
		//  Uygulama dizini
		define('APP_DIR', $settings['applicationDirectory'].'/');
		
		//  Uygulama türü
		define('APP_TYPE', $settings['applicationType']);
		
		// Kullanilabilir uygulama seçenekleri
		switch( APP_TYPE )
		{ 
			case 'publication' :
				error_reporting(0); 
			break;
			
			case 'local' :

			case 'development' : 
				error_reporting(-1);
			break; 

			default: echo 'Invalid Application Environment! Available Options: local, development or publication'; 
			exit;
		}	
 		
		/******************************************************************\
		|                                                                  | 
		|                SISTEM BENCHMARK PERFORMANS TESTI                 |
		|                                                                  |
		*******************************************************************/
		
		/**
		 * Sistem performans testi
		 *
		 * @var	bool
		 */
		$benchmarkingTest = $settings['benchmarkingTest'];	
		
		if( $benchmarkingTest === true ) 
		{
			// Sisteminin açilis zamanini hesaplamayi baslat
			$start = microtime();
		}
		
		// Sistem yükleniyor
		require_once 'System/Core/Hierarchy.php'; 
		
		if( $benchmarkingTest === true )
		{	
			// Sistemin açilis zamanini hesaplamayi bitir
			$finish         = microtime();
		
			// Sistem açilisi için geçen süre hesaplama
			$elapsedTime    = $finish - $start;
			
			// Sistemin bellek kullanimini hesapla
			$memoryUsage    = memory_get_usage();
			
			// Sistemin maksimum bellek kullanimini hesapla
			$maxMemoryUsage = memory_get_peak_usage();
			
			// Benchmark performans sonuç tablosu
			$benchmarkData  = array
			(
				'elapsedTime'	 => $elapsedTime,
				'memoryUsage'	 => $memoryUsage,
				'maxMemoryUsage' => $maxMemoryUsage
			);	
			
			$benchResult    = Import::template('BenchmarkTable', $benchmarkData, true);
			
			//  Benchmark performans sonuç tablosu yazdiriliyor
			echo $benchResult;
					
			//  Sistem benchmark performans test sonuçlarini raporla.
			report('BenchmarkTestResults', $benchResult, 'BenchmarkTestResults');
		}
	}
}