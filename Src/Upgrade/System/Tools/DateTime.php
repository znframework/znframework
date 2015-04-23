<?PHP
/************************************************************/
/*                     TOOL  DATETIME                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
date_default_timezone_set(config::get('DateTime', 'timezone'));

// Function: standart_time()
// İşlev: Starndart tarih ve saat bilgisi üretir.
// Dönen Değer: 12.01.2015 09:02:41
if(!file_exists('standart_time'))
{
	function standart_time()
	{	
		$setlocale = config::get('DateTime', 'setlocale');
		setlocale(LC_ALL, $setlocale['charset'], $setlocale['language']);
		return iconv(config::get('DateTime', 'iconv_in_charset'),config::get('DateTime', 'iconv_out_charset'), strftime("%d %B %Y, %A %H:%M:%S"));
	}
}

// Function: current_time()
// İşlev: Aktif saat bilgisini verir.
// Dönen Değer: 09:02:41
if(!file_exists('current_time'))
{
	function current_time($clock='%H:%M:%S')
	{
		if( ! is_string($clock)) return false;
		$setlocale = config::get('DateTime', 'setlocale');
		setlocale(LC_ALL, $setlocale['charset'], $setlocale['language']);
		return strftime($clock);	
	}
}

// Function: current_date()
// İşlev: Aktif tarih bilgisini verir.
// Dönen Değer: 09:02:41
if(!file_exists('current_date'))
{
	function current_date()
	{		
		return set_date("<daynum0>.<monnum0>.<year>");
	}
}

// Function: current_date_time()
// İşlev: Aktif tarih ve saat bilgisini verir.
// Dönen Değer: 12.01.2015 09:02:41
if(!file_exists('current_date_time'))
{
	function current_date_time()
	{		
		return set_date("<daynum0>.<monnum0>.<year> <hour024>:<minute>:<second>");
	}
}

// Function: set_time()
// İşlev: Tarih ve saat ayarlamaları yapmak için kullanılır.
// Parametreler
// @exp = Tarih ve saat ayarlaması yapmak için kullanılacak biçim karaketerleri. Örnek: <day>.<month>.<year>
// Dönen Değer: Ayarlanan tarih saat bilgisi
if(!file_exists('set_time'))
{
	function set_time($exp = '')
	{	
		if( ! is_string($exp)) return false;
		
		import::tool('Array');
		
		$chars = config::get('DateTime', 'set_time_format_chars');
		
		$chars = multi_key_array($chars);
		
		$setExp = str_replace(array_keys($chars), array_values($chars), $exp);
		
		$setlocale = config::get('DateTime', 'setlocale');
		
		setlocale(LC_ALL, $setlocale['charset'], $setlocale['language']);
		
		return iconv(config::get('DateTime', 'iconv_in_charset'),config::get('DateTime', 'iconv_out_charset'), strftime($setExp));
	}
}

// Function: set_date()
// İşlev: Tarih ve saat ayarlamaları yapmak için kullanılır.
// Parametreler
// @exp = Tarih ve saat ayarlaması yapmak için kullanılacak biçim karaketerleri. Örnek: <day>.<month>.<year>
// Dönen Değer: Ayarlanan tarih saat bilgisi
if(!file_exists('set_date'))
{
	function set_date($exp = 'h:i:s')
	{
		if( ! is_string($exp)) return false;
		
		import::tool('Array');
		
		$chars = config::get('DateTime', 'set_date_format_chars');
		
		$chars = multi_key_array($chars);
		
		$newClock = str_replace(array_keys($chars), array_values($chars), $exp);
		
		return iconv(config::get('DateTime', 'iconv_in_charset'),config::get('DateTime', 'iconv_out_charset'), date($newClock));
	}
}

