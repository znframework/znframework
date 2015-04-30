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
	public function __construct()
	{
		zn::$zndynamic =& $this;
		// Dahil edilen kütüphaneler tanımlanıyor...
		zndynamic_autoloaded();
	}
}
