<?php
/************************************************************/
/*                   CODER CONTROLLERS                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class ZNDynamic
{
	
	/*
	 * Singleton referans değişkeni
	 *
	 * @var	object
	 */
	 
	private static $reference;
	
	/*
	 * ZNDynamic yapısı çalıştırılıyor... 
	 *
	 */
	
	public function __construct()
	{
		self::$reference =& $this;
		// Dahil edilen kütüphaneler tanımlanıyor...
		zndynamic_autoloaded();
	}
	
	/*
	 * Singleton referans yöntemi
	 *
	 * @function object
	 */
	
	public static function &reference()
	{	
		return self::$reference;		
	}
}
