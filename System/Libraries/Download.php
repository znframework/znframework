<?php
/************************************************************/
/*                     CLASS  DOWNLOAD                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Download
{
	
	private static $error;
	
	
	public static function start($file = '')
	{
		if( ! is_string($file))
		{
			self::$error = get_error('Download', 'download_string_parameter_error');
			report('Error', self::$error, 'DownloadLibrary');
			return false;	
		}
		
		if( ! file_exists($file))
		{
			self::$error = get_error('Download', 'download_empty_parameter_error');
			report('Error', self::$error, 'DownloadLibrary');
			return false;	
		}
		
		$file_ex = explode("/", $file);
		$file_name = $file_ex[count($file_ex)-1];
		$file_path = "";
		
		for($index = 0; $index < (count($file_ex) - 1); $index++)
		{
			$file_path .= $file_ex[$index]."/";
		}
			
		header("Content-type: application/x-download");
		header("Content-Disposition: attachment; filename=".$file_name);
		readfile($file_path.$file_name);
	}	
	
	
	public static function error()
	{
		if(isset(self::$error))
			return self::$error;
		else
			return false;
	}
}