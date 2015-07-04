<?php
/************************************************************/
/*                       AUTOLOADS                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/* STARTING RUN *
 *
 * 
 * Sistem Başlatılıyor
 */
Starting::run();

/******************************************************************************************
* STARTING CLASS                                                                          *
*******************************************************************************************
| Sistem başlangıç sınıfıdır.    														  |
******************************************************************************************/
class Starting
{
	public static function run()
	{	
		// INI AYARLAR YAPILANDIRILIYOR...
		$iniSet = Config::get('Ini', 'settings');
		
		if( ! empty($iniSet) ) 
		{
			Config::iniSet($iniSet);
		}
		// ----------------------------------------------------------------------
					
		// HTACCESS DOSYASI OLUŞTURULUYOR... 	
		if( Config::get('Htaccess','createFile') === true ) 
		{
			createHtaccessFile();
		}	
		// ----------------------------------------------------------------------
		
		// SINIF HARİTASI OLUŞTURULUYOR... 	
		if( Config::get('Autoloader','create') === true ) 
		{
			Autoloader::createClassMap();
		}	
		// ----------------------------------------------------------------------
		
		// COMPOSER DOSYASI OLUŞTURULUYOR...	
		$composer = Config::get('Composer', 'autoload');
		
		if( $composer === true )
		{
			$path = 'vendor/autoload.php';
			if( file_exists($path) )
			{
				require_once($path);
			}
			else
			{
				report('Error', getMessage('Error', 'fileNotFound', $path) ,'AutoloadComposer');
				
				die(getErrorMessage('Error', 'fileNotFound', $path));
			}
		}
		elseif( file_exists($composer) )
		{
			require_once($composer);
		}
		elseif( ! empty($composer) )
		{
			report('Error', getMessage('Error', 'fileNotFound', $composer) ,'AutoloadComposer');
			
			die(getErrorMessage('Error', 'fileNotFound', $composer));
		}
		// ----------------------------------------------------------------------	
	}
}