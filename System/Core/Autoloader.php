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
	/* AUTOLOADER FILE NAME INSENSITIVE *
	*
	* 
	* Dosya isimleri kontrol ediliyor...
	*/
	protected static function fileNameInsensitive($fileName = '')
	{
		if( file_exists($fileName) )
		{
			return $fileName;	
		}
		
		$dirName 		  = dirname($fileName);
		$fileNames 	      = glob($dirName . '/*.php', GLOB_NOSORT);
		$fileNameToLower  = strtolower($fileName);		
		
		if( is_array($fileNames) )
		{
			$fileNamesToLower = array_map('strtolower', $fileNames);
		}
		else
		{
			$fileNamesToLower = array();	
		}
		
		$result = array_search($fileNameToLower, $fileNamesToLower);

		if( ! empty($fileNames[$result]) ) 
		{
			return $fileNames[$result];
		}
		
		return false;
	}
	
	/* AUTOLOADER RUN *
	*
	* 
	* Otomatik Yükleme Çalıştırılıyor...
	*/
	public static function run($class)
	{
		$file  = str_replace('\\', '/', ucfirst($class)).'.php'; 
		
		$library 		= self::fileNameInsensitive(LIBRARIES_DIR.$file);	
		$system_library = self::fileNameInsensitive(SYSTEM_LIBRARIES_DIR.$file);
		$components 	= self::fileNameInsensitive(COMPONENTS_DIR.$file);
		$model 			= self::fileNameInsensitive(MODELS_DIR.$file);
		
		if( ! empty($library) )
		{		
			require_once($library);	
		}
		elseif( ! empty($system_library) )
		{		
			require_once($system_library);
		}
		elseif( ! empty($components) )
		{		
			require_once($components);
		}
		elseif( ! empty($model) )
		{		
			require_once($model);
		}
		else
		{
			return false;
		}
	} 
}

/* AUTOLOADER RUN *
*
* 
* Otomatik Yükleme Çalıştırılıyor...
*/
spl_autoload_register('Autoloader::run');