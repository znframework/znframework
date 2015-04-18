<?php
/************************************************************/
/*                         HOME PAGE                        */
/************************************************************/

/*
	YAZAR: OZAN UYKUN
	
	1-COPYRIGHT(C) OZAN UYKUN
	2-TÜM HAKLARI SAKLIDIR.
	3-EMEGE SAYGI
*/

/* 
	SYSTEM RUN MODE PARMETERS
	
	1-development
	2-publication 
	
	default development
*/
System::run('development');

class System
{
	public static function run($apptype)
	{		
		$benchmark_testing = false;
		
		switch($apptype)
		{ 
			case 'publication' :
				error_reporting(0); 
			break;
			
			case 'development' : 
				error_reporting(-1);
			break; 
			
			default: echo 'Invalid Application Environment! Available Options: development or publication'; exit;
		}		
		
		if($benchmark_testing === true) $start = microtime();
		
		require_once 'System/Core/Hierarchy.php'; // sistem yükleniyor...
	
		if($benchmark_testing === true)
		{
			$finish = microtime();
			
			echo "//// BENCHMARK TIME TEST : <strong>".round($finish - $start, 4)." SECOND</strong> ////<br>".
			     "//// BENCHMARK MEMORY USAGE TEST : <strong>".memory_get_usage()." BYTES</strong> ////<br>".
			     "//// BENCHMARK MEMORY PEAK USAGE TEST : <strong>".memory_get_peak_usage()." BYTES</strong> ////";
		}
	}
}

/*-----------------------------------------------END HOMEPAGE---------------------------------------------------*/