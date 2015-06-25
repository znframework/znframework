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
		$iniset = Config::get('Ini', 'settings');
		
		if( ! empty($iniset) ) 
		{
			Config::iniSet($iniset);
		}
		// ----------------------------------------------------------------------
					
		// HTACCESS DOSYASI OLUŞTURULUYOR... 	
		if( Config::get('Htaccess','createFile') === true ) 
		{
			createHtaccessFile();
		}	
		// ----------------------------------------------------------------------
		
		// ----------------------------------------------------------------------
		
		// COMPOSER AUTOLOAD	
		$composer = Config::get('Composer', 'autoload');
		
		if( $composer === true )
		{
			( file_exists('vendor/autoload.php') )
			? require_once('vendor/autoload.php')
			: report('Error','vendor/autoload.php was not found.','AutoloadComposer');
		}
		elseif( file_exists($composer) )
		{
			require_once($composer);
		}
		elseif( ! empty($composer) )
		{
			report('Error', $composer.' was not found.','AutoloadComposer');
		}
		// ----------------------------------------------------------------------	
	}
}