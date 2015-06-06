<?php
/************************************************************/
/*                   CLASS  AUTOLOADER                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* AUTOLOADER                                                                           	  *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Etmeye Gerek Yoktur.   							      |
| Sınıfı Kullanırken      :	Sistem Tarafından Kullanılılır.		 			     		  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class Autoloader
{
	/* AUTOLOADER RUN *
	*
	* 
	* Otomatik Yükleme Çalıştırılıyor...
	*/
	public static function run($class)
	{
		$file  = divide($class, '\\', -1);
		
		$file  = $file.'.php';    
		
		$class_path = $file; 
		
		$libraries_dir = config::get('Libraries', 'autoloader_directory');
		
		foreach( $libraries_dir as $lib )
		{
			$library = $lib.$file;
			
			if( is_file_exists($library) )
			{		
				require_once($library);	
			}
		}
		
		if( method_exists($class, '_init') )
		{
			call_user_func_array($class.'::_init');
		}
		
		return false;
	} 
}

/* AUTOLOADER RUN *
*
* 
* Otomatik Yükleme Çalıştırılıyor...
*/
spl_autoload_register('Autoloader::run');