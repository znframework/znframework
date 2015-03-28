<?php

/************************************************************/
/*                       SYSTEM HIERARCHY                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/*------------------------------------------------------------------------------------------------------*/
Hierarchy::run();

class Hierarchy
{
	public static function run()
	{ 
		require_once 'System/Core/Constants.php'; 	// sabit tanımlamalar yükleniyor...
		
		require_once 'System/Core/Config.php'; 		// ayarlar yükleniyor...
		
		require_once 'System/Core/Functions.php'; 	// sistem fonksiyonları yükleniyor...
		
		require_once 'System/Core/Import.php'; 		// dahil etme sınıfı yükleniyor...
		
		require_once 'System/Core/Starting.php'; 	// oto yükleme dosyaları varsa onlar yükleniyor...
		
		require_once 'System/Core/Repair.php'; 	    // cache dosyası yükleniyor...
		
		require_once 'System/Core/Structure.php'; 	// zn url sistemi yükleniyor... 
	}
}

/*-----------------------------------SİSTEM YÜKLENİYOR---------------------------------------------------*/