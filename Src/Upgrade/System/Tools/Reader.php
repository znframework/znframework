<?php 
/************************************************************/
/*                     TOOL READER                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: rss_reader()
// İşlev: Rss dosyalarını okumak için kullanılır.
// Parametreler
// @path = Xml dosyasının yolu.
// Dönen Değer: Xml verileri.
if(!function_exists("rss_reader"))
{
	function rss_reader($path = '')
	{
		if( ! is_string($path)) return false;
		$xml = simplexml_load_file($path);
		return $xml;
	}
}