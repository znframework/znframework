<?php
/******************************************************************\
|                                                                  | 
|                          ZN FRAMEWORK                            |
|                                                                  |
*******************************************************************/

/*
	YAZAR: OZAN UYKUN
	
	1-COPYRIGHT(C) OZAN UYKUN
	2-TÜM HAKLARI SAKLIDIR.
	3-EMEGE SAYGI
*/

/* 
	SİSTEM ÇALIŞTIRMA MODLARI
	
	1-development
	2-publication 
	
	Varsayılan: development
*/

/* SYSTEM RUN *
 *
 * 
 * Sistem çalıştırılıyor...
 */
System::run('development');

/* SYSTEM SINIFI *
 *
 * 
 * 
 */
class System
{
	public static function run($apptype)
	{	
		//------------------------------------------------------------------
		//  Uygulama Dizini
		//------------------------------------------------------------------
		define('APP_DIR', 'Application/');
		
		// Kullanılabilir Uygulama Seçenekleri
		switch($apptype)
		{ 
			// Publication Yayın Modu
			case 'publication' :
				error_reporting(0); 
			break;
		
			// Developmen Geliştirme Modu
			case 'development' : 
				error_reporting(-1);
			break; 
			
			// Farklı bir kullanım hatası
			default: echo 'Invalid Application Environment! Available Options: development or publication'; exit;
		}	
		
		
		/******************************************************************\
		|                                                                  | 
		|                SİSTEM BENCHMARK PERFORMANS TESTİ                 |
		|                                                                  |
		*******************************************************************/
		
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//  Sistem Performans Testini Başlat: true or false
		//------------------------------------------------------------------	
		$BENCHMARK_PERFOMANCE_TEST_START = false;	
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		
		if($BENCHMARK_PERFOMANCE_TEST_START === true) 
		{
			//------------------------------------------------------------------
			//  Sisteminin Açılış Zamanını Hesaplamayı Başlat
			//------------------------------------------------------------------
			$start = microtime();
		}
		
		//******************************************************************
		//  Sistem yükleniyor ... >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//
		require_once 'System/Core/Hierarchy.php'; // <<<<<<<<<<<<<<<<<<<<<<<
		//
		//  Sistem çalıştırılıyor ... >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//******************************************************************
		
		if($BENCHMARK_PERFOMANCE_TEST_START === true)
		{	
			//------------------------------------------------------------------
			//  Sistemin Açılış Zamanını Hesaplamayı Bitir
			//------------------------------------------------------------------
			$finish 		  = microtime();
			
			//------------------------------------------------------------------
			//  System Elapsed Time Calculating
			//------------------------------------------------------------------
			$elapsed_time     = round($finish - $start, 4);
			
			//------------------------------------------------------------------
			//  Sistemin Bellek Kullanımını Hesapla
			//------------------------------------------------------------------
			$memory_usage 	  = memory_get_usage();
			
			//------------------------------------------------------------------
			//  Sistemin Maksimum Bellek Kullanımını Hesapla
			//------------------------------------------------------------------
			$max_memory_usage = memory_get_peak_usage();
			
			//------------------------------------------------------------------
			//  Benchmark Performans Sonuç Tablosu
			//------------------------------------------------------------------
			$bench_result     = "
			<pre>
			/******************************************************************\
			|                                                                  | 
			|                <b>BENCHMARK PERFORMANCE TEST RESULT</b>                 |
			|                                                                  |
			|------------------------------------------------------------------|
			|                                                                  |
			|  System Elapsed Time     : <b>$elapsed_time</b> Second                  	   |                               
			|  System Memory Usage     : <b>$memory_usage</b> Bytes                   	   |                                
			|  System Max Memory Usage : <b>$max_memory_usage</b> Bytes              	           |	 	                 
			|                                                                  |
			\******************************************************************/
			</pre>
			";
			
			echo $bench_result;
					
			//------------------------------------------------------------------
			//  Sistem benchmark performans test sonuçlarını raporla.
			//------------------------------------------------------------------
			report('BenchmarkTestResults', $bench_result, 'BenchmarkTestResults');
		}
	}
}
