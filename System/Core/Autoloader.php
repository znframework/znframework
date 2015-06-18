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
	protected static function inSensitiveFileName($file) 
	{
		if( file_exists($file) )
		{
			return $file;
		}
		
		$lowerFile = strtolower($file);
		
		$files = glob(dirname($file).'/*.php');
		
		if( ! empty($files) ) foreach( $files  as $file )
		{
			if( strtolower($file) === $lowerFile )
			{
				return $file;
			}
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
		$file  = str_replace('\\', '/', $class).'.php'; 
		
		if( file_exists( $library = self::inSensitiveFileName(LIBRARIES_DIR.$file)) )
		{	
			require_once($library);	
		}
		elseif( file_exists( $system_library = self::inSensitiveFileName(SYSTEM_LIBRARIES_DIR.$file)) )
		{	
			require_once($system_library);
		}
		elseif( file_exists($components = self::inSensitiveFileName(COMPONENTS_DIR.$file)) )
		{		
			require_once($components);
		}
		elseif( file_exists( $model = self::inSensitiveFileName(MODELS_DIR.$file)) )
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