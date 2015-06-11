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
		$iniset = config::get('Ini', 'settings');
		
		if( ! empty($iniset) ) 
		{
			config::iniset($iniset);
		}
		// ----------------------------------------------------------------------
					
		// HTACCESS DOSYASI OLUŞTURULUYOR... 	
		if( config::get('Htaccess','create_file') === true ) 
		{
			create_htaccess_file();
		}	
		// ----------------------------------------------------------------------
		
		// ----------------------------------------------------------------------
		
		// COMPOSER AUTOLOAD	
		$composer = config::get('Composer', 'autoload');
		
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