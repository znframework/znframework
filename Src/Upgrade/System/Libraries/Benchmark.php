<?php 
/************************************************************/
/*                     CLASS  BENCHMARK                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Bench
{
	private static $start_test;
	private static $end_test;
	private static $tests = array();
	
	public static function test_start($test = '')
	{
		if( ! is_string($test)) return false;
		
		$test = $test."_start";
		
		self::$tests[$test] = microtime();
	}
	
	public static function test_end($test = '')
	{
		if( ! is_string($test)) return false;
		
		$test = $test."_end";

		self::$tests[$test] = microtime();
	}
	
	public static function elapsed_time($result = '', $decimal = 4)
	{   
		if( ! is_string($result)) return false;
		if( ! is_numeric($decimal)) $decimal = 4;
		
		$resend = $result."_end";
		$restart = $result."_start";
		
		if(isset(self::$tests[$resend]) && isset(self::$tests[$restart]))
			return round((self::$tests[$resend] - self::$tests[$restart]), $decimal);
		else
			return false;
	}
	
	public static function memory_usage($real_memory = false)
	{
		if( ! is_bool($real_memory)) $real_memory = false;
		import::tool('Formatter');
		return  byte_formatter(memory_get_usage($real_memory));
	}
	
	public static function memory_peak_usage($real_memory = false)
	{
		if( ! is_bool($real_memory)) $real_memory = false;
		import::tool('Formatter');
		return  byte_formatter(memory_get_peak_usage($real_memory));
	}

}