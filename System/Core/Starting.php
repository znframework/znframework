<?php
/************************************************************/
/*                       AUTOLOADS                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/


Starting::run();

class Starting
{
	public static function run()
	{			
		// HTACCESS DOSYASI OLUŞTURULUYOR... 
		
		create_htaccess_file();
		
		// ----------------------------------------------------------------------
		
		// OTOMATİK YÜKLEMELER İŞLENİYOR...
		
		autoload(config::get('Autoload', 'Library')  , 'Libraries');
		autoload(config::get('Autoload', 'Tool')   , 'Tools');
		autoload(config::get('Autoload', 'Language')   , 'Languages');
		autoload(config::get('Autoload', 'Coder')   , 'Coder');
		
		// ----------------------------------------------------------------------
	
	}
}