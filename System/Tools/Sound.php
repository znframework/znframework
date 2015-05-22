<?php 
/************************************************************/
/*                      TOOL SOUND                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
*  ADD SOUND                                                           			          *
*******************************************************************************************
| Genel Kullanım: Dışarıdan ses dosyası çağırmak için kullanılır.						  |
|																						  |
| Parametreler: 3 parametresi vardır.                                              	      |
| 1. string var @url => Ses dosyasının yolu veya url adresi.			  			      |
| 2. boolean var @autostart => Ses dosyasının otomatik olarak başlama durumu.			  |
| 3. boolean var @loop => Ses dosyasının tekrar çalma durumu.			  			      |
|          																				  |
| Örnek Kullanım: add_sound('sound/a.mp3');         						              |
|          																				  |
******************************************************************************************/
if(!function_exists("add_sound"))
{
	//wma mp3 mid destekler
	function add_sound($url = '', $autostart = true, $loop = true)
	{
		if( ! is_string($url) ) 
		{
			return false;
		}
		
		if( ! is_bool($autostart) ) 
		{
			$autostart = true;
		}
		
		if( ! is_bool($loop) ) 
		{
			$loop = true;
		}
		
		if( $autostart === true )
		{ 
			$autostart = "true"; 
		}
		else
		{
			$autostart = "false";
		}
		
		if( $loop === true )
		{ 
			$loop = "true"; 
		}
		else
		{
			$loop = "false";
		}
			
		$str = '<embed hidden="true" autostart="'.$autostart.'"  loop="'.$loop.'" src="'.$url.'"></embed>';
		
		return $str;
	}
}