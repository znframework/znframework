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
		$class = ns_short_name($class);
		
		$file  = str_replace('\\', '/', $class).'.php'; 
		
		$library 		= LIBRARIES_DIR.$file;	
		$system_library = SYSTEM_LIBRARIES_DIR.$file;
		$components 	= COMPONENTS_DIR.$file;
		$model 			= MODELS_DIR.$file;
		
		if( is_file_exists($library) )
		{		
			require_once($library);	
		}
		elseif( is_file_exists($system_library) )
		{		
			require_once($system_library);
		}
		elseif( is_file_exists($components) )
		{		
			require_once($components);
		}
		elseif( is_file_exists($model) )
		{		
			require_once($model);
		}
		else
		{
			report('ClassNotFound', "file:$file, class:$class is not found", 'ClassNotFound');
		}
	} 
}

/* AUTOLOADER RUN *
*
* 
* Otomatik Yükleme Çalıştırılıyor...
*/
spl_autoload_register('Autoloader::run');