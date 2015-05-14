<?php
/************************************************************/
/*                       AUTOLOADS                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/* USING VARIABLE DIRECT ACCESS
 *
 * Static @var zn::use
 *
 */
zn::$use = using();
/* USING FUNCTIONAL DIRECT ACCESS
 *
 * Global @func this()
 *
 */
function this()
{
	return zn::$use;
}

/* STARTING RUN *
 *
 * 
 * System starting
 */
Starting::run();

/* CLASS STARTING *
 *
 * 
 * 
 */
class Starting
{
	public static function run()
	{	
		// INI AYARLAR YAPILANDIRILIYOR...
		
		$iniset = config::get('Ini', 'settings');
		
		if( ! empty($iniset)) 
		{
			config::iniset($iniset);
		}
		
		// ----------------------------------------------------------------------
		
				
		// HTACCESS DOSYASI OLUŞTURULUYOR... 
		
		if(config::get('Htaccess','create_file') === true) 
		{
			create_htaccess_file();
		}
	
		// ----------------------------------------------------------------------
		
		// OTOMATİK YÜKLEMELER İŞLENİYOR...
		
		$autoload = config::get('Autoload');
		
		if( ! empty($autoload['library'] ))	
		{
			autoload($autoload['library'], 'Libraries');
		}
		
		if( ! empty($autoload['component'] ))	
		{
			autoload($autoload['component'], 'Components');
		}
		
		if( ! empty($autoload['tool'] ))	
		{
			autoload($autoload['tool'], 'Tools');
		}
		
		if( ! empty($autoload['language'] ))	
		{
			autoload($autoload['language'], 'Languages');
		}
		
		if( ! empty($autoload['model'] ))	
		{
			autoload($autoload['model'], 'Models');
		}
		
		// ----------------------------------------------------------------------
		
		// COMPOSER AUTOLOAD
		
		if($autoload['composer'] === true)
		{
			file_exists('vendor/autoload.php')
				? require_once('vendor/autoload.php')
				: report('Error','vendor/autoload.php was not found.','AutoloadComposer');
		}
		elseif (file_exists($autoload['composer']))
		{
			require_once($autoload['composer']);
		}
		else
		{
			report('Error', $autoload['composer'].' was not found.','AutoloadComposer');
		}
		
		// ----------------------------------------------------------------------
	
	}
}