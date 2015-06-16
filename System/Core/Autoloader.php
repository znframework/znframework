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
		$file  = str_replace('\\', '/', ucfirst($class)).'.php'; 
		
		if( file_exists( $library = LIBRARIES_DIR.$file) )
		{			
			require_once($library);	
		}
		elseif( file_exists( $system_library = SYSTEM_LIBRARIES_DIR.$file) )
		{	
			require_once($system_library);
		}
		elseif( file_exists($components = COMPONENTS_DIR.$file) )
		{		
			require_once($components);
		}
		elseif( file_exists( $model = MODELS_DIR.$file) )
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