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
	
	protected static function fileNameInsensitive($fileName = '')
	{
		$dirName 		 = dirname($fileName);
		$fileNames 	     = glob($dirName . '/*', GLOB_NOSORT);
		$fileNameToLower = strtolower($fileName);
		
		foreach($fileNames as $file) 
		{
			if( strtolower($file) === $fileNameToLower ) 
			{
				return $file;
			}
		}
		return false;	
	}
	
	public static function run($class)
	{
		$file  = str_replace('\\', '/', $class).'.php'; 
		
		$library 		= self::fileNameInsensitive(LIBRARIES_DIR.$file);	
		$system_library = self::fileNameInsensitive(SYSTEM_LIBRARIES_DIR.$file);
		$components 	= self::fileNameInsensitive(COMPONENTS_DIR.$file);
		$model 			= self::fileNameInsensitive(MODELS_DIR.$file);
		
		if( isFileExists($library) )
		{		
			require_once($library);	
		}
		elseif( isFileExists($system_library) )
		{		
			require_once($system_library);
		}
		elseif( isFileExists($components) )
		{		
			require_once($components);
		}
		elseif( isFileExists($model) )
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