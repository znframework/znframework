<?php
/************************************************************/
/*                     CAPTCHA BUILDER                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/******************************************************************************************
* CREATE CAPTCHA                                                                          *
*******************************************************************************************
| Genel Kullanım: Güvenlik kodu oluşturmak için kullanılır. 							  |
|																						  |
| Parametreler: Tek parametresi vardır.                                              	  |
| 1. boolean var @img => <img> nesnesi oluşturulsun mu?.						     	  |
|          																				  |
| Örnek Kullanım:         																  |
| echo create_captcha(true);															  |
|																						  |
| $kod = create_captcha(); 																  |
| echo '<img src="'.$kod.'" />'; 														  |
|																						  |
******************************************************************************************/	
if( ! function_exists('create_captcha') )
{
	function create_captcha($img = false)
	{
		if( ! is_bool($img) ) 
		{
			$img = false;
		}
		
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
		$set = config::get("Captcha", "settings");	
		
		$_SESSION[md5('captcha_code')] = substr(md5(rand(0,999999999999999)),-($set["char_count"]));	
		
		if( $img === true )
		{	
			return '<img src="'.base_url(CORE_DIR."Captcha.php").'">';
		}
		else
		{
			return base_url(CORE_DIR."Captcha.php");
		}
	}	
}

/******************************************************************************************
* GET CAPTCHA CODE                                                                        *
*******************************************************************************************
| Genel Kullanım: Daha önce oluşturulan güvenlik uygulamasının kod bilgini verir. 		  |
|																						  |
| Parametreler: Herhangi bir parametresi yoktur.                                          |
|          																				  |
| Örnek Kullanım:         																  |
| echo get_captcha_code(); // Çıktı: 1A4D31 											  |
|																						  |
******************************************************************************************/	
if( ! function_exists('get_captcha_code') )
{
	function get_captcha_code()
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
		return $_SESSION[md5('captcha_code')];
	}	
}
