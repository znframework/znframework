<?php
/************************************************************/
/*                     CAPTCHA BUILDER                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: create_captcha()
// İşlev: Güvenlik kodu oluşturmak için kullanılır.
// Parametreler
// @img = true olması durumunda güvenlik kodunu img etiketi içerisinde verir.
// false olması durumunda ise captcha dosyasının img içinde kullanılmak üzere yolunu verir.
// Dönen Değer: Güvenlik kodu yolu.

if( ! function_exists('create_captcha') )
{
	function create_captcha($img = false)
	{
		if( ! is_bool($img)) $img = false;
		
		if( ! isset($_SESSION)) session_start();
		
		$set = config::get("Captcha", "settings");	
		$_SESSION[md5('captcha_code')] = substr(md5(rand(0,999999999999999)),-($set["char_count"]));	
		
		if($img)	
			return '<img src="'.base_url(CORE_DIR."Captcha.php").'">';
		else
			return base_url(CORE_DIR."Captcha.php");
	}	
}

// Function: get_captcha_code()
// İşlev: Daha önce oluşturulan güvenlik uygulamasının kod bilsini verir.
// Parametreler: Yok.
// Dönen Değer: Güvenlik kodu bilgisi.

if( ! function_exists('get_captcha_code') )
{
	function get_captcha_code()
	{
		if(!isset($_SESSION)) session_start();
		
		return $_SESSION[md5('captcha_code')];
	}	
}