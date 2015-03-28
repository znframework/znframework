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
				error_reporting(E_ALL);
			break; 
		}		
		
		if($benchmark_testing) $start = microtime();
		
		require_once 'System/Core/Hierarchy.php'; // sistem yükleniyor...
		
		if($benchmark_testing) $finish = microtime(); 
		
		if($benchmark_testing)
		{
			echo "//// BENCHMARK TIME TEST : <strong>".round($finish - $start, 4)." SECOND</strong> ////<br>";
			echo "//// BENCHMARK MEMORY USAGE TEST : <strong>".memory_get_usage()." BYTES</strong> ////";
		}
	}
}

/*-----------------------------------------------END HOMEPAGE---------------------------------------------------*/