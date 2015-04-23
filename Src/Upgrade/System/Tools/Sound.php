<?php 
/************************************************************/
/*                      TOOL SOUND                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: add_sound()
// İşlev: Dışarıdan ses dosyası çağırmak için kullanılır.
// Parametreler
// @url = Ses dosyasının yolu veya url adresi.
// @autostart = Ses dosyasının otomatik olarak başlama durumu. true veya false.
// @loop = Ses dosyasının tekrar çalma durumu. true veya false.
if(!function_exists("add_sound"))
{
	//wma mp3 mid destekler
	function add_sound($url = '', $autostart = true, $loop = true)
	{
		if( ! is_string($url)) return false;
		if( ! is_bool($autostart)) $autostart = true;
		if( ! is_bool($loop)) $loop = true;
		
		if($autostart === true) 
			$autostart = "true"; 
		else
			$autostart = "false";
			
		if($loop === true) 
			$loop = "true"; 
		else
			$loop = "false";
			
			
		$str = '<embed hidden="true" autostart="'.$autostart.'"  loop="'.$loop.'" src="'.$url.'"></embed>';
		return $str;
	}
}