<?php
/******************************************************************\
|                                                                  | 
|                  ZN FRAMEWORK SYSTEM RUNNING                     |
|                                                                  |
*******************************************************************/

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

/* SYSTEM RUN *
 *
 * 
 * System running
 */
System::run('development');

/* CLASS SYSTEMS *
 *
 * 
 * 
 */
class System
{
	public static function run($apptype)
	{	
		//------------------------------------------------------------------
		//  Application Directory
		//------------------------------------------------------------------
		define('APP_DIR', 'Application/');
		
		// Available Environment Options
		switch($apptype)
		{ 
			// Publication Mode
			case 'publication' :
				error_reporting(0); 
			break;
			
			// Development Mode
			case 'development' : 
				error_reporting(-1);
			break; 
			
			// Different Mode Warning Message
			default: echo 'Invalid Application Environment! Available Options: development or publication'; exit;
		}	
		
		
		/******************************************************************\
		|                                                                  | 
		|                SYSTEM BENCHMARK PERFORMANCE TEST                 |
		|                                                                  |
		*******************************************************************/
		
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//  System Performance Test Start: true or false
		//------------------------------------------------------------------	
		$BENCHMARK_PERFOMANCE_TEST_START = false;	
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		//------------------------------------------------------------------
		
		if($BENCHMARK_PERFOMANCE_TEST_START === true) 
		{
			//------------------------------------------------------------------
			//  System Elapsed Time Calculation Starting
			//------------------------------------------------------------------
			$start = microtime();
		}
		
		//******************************************************************
		//  System loading ... >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//
		require_once 'System/Core/Hierarchy.php'; // <<<<<<<<<<<<<<<<<<<<<<<
		//
		//  System running ... >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
		//******************************************************************
		
		if($BENCHMARK_PERFOMANCE_TEST_START === true)
		{	
			//------------------------------------------------------------------
			//  System Elapsed Time Calculation Ending
			//------------------------------------------------------------------
			$finish 		  = microtime();
			
			//------------------------------------------------------------------
			//  System Elapsed Time Calculating
			//------------------------------------------------------------------
			$elapsed_time     = round($finish - $start, 4);
			
			//------------------------------------------------------------------
			//  System Memory Usage Calculating
			//------------------------------------------------------------------
			$memory_usage 	  = memory_get_usage();
			
			//------------------------------------------------------------------
			//  System Max Memory Usage Calculating
			//------------------------------------------------------------------
			$max_memory_usage = memory_get_peak_usage();
			
			//------------------------------------------------------------------
			//  Benchmark Perfomance Test Result
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
			//  System benchmark test is reported
			//------------------------------------------------------------------
			report('BenchmarkTestResults', $bench_result, 'BenchmarkTestResults');
		}
	}
}

/*-----------------------------------------------END HOMEPAGE---------------------------------------------------*/