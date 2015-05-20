<?php
/************************************************************/
/*                    TOOL CREATOR                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/******************************************************************************************
* PASSWORD CREATOR                                                                        *
*******************************************************************************************
| Genel Kullanım: Rasgele şifre oluşturmak için kullanılır.			  	                  |
|																						  |
| Parametreler: 2 parametresi vardır.                                              	      |
| 1. numeric var @count => Kaç karakterli olacağı.				                          |
| 2. [ string var @chars ] => Şifre üretilecek karakter grubu. Varsayılan:all			  |
|																						  |
| Şifre Üretilecek Karakter Grupları													  |
| 1-all => Türm karakterler																  |
| 2-numeric => Sadece Sayılar															  |
| 3-string/alpha => Sadece Harfler														  |
|																						  |
| Örnek Kullanım:  																	      |
| echo password_creator(); // Çıktı: lF6jye 											  |
| echo password_creator('10', 'string'); // Çıktı: BOPTstMAXA 							  |
| echo password_creator('10', 'numeric'); // Çıktı: 738693701							  |
|       																				  |
******************************************************************************************/
if( ! function_exists('password_creator') )
{
	function password_creator($count = 6, $chars = "all")
	{
		if( ! is_numeric($count) ) 
		{
			$count = 6;
		}
		
		if( ! is_string($chars) ) 
		{
			$chars = "all";
		}
		
		$password   	= '';
		
		if( $chars === "all" ) 
		{
			$characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		}
		if( $chars === "numeric" ) 
		{
			$characters = "1234567890";
		}
		if( $chars === "string" || $chars === "alpha" )
		{ 
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		}
		
		for($i=0; $i < $count; $i++)
		{
			$password .= substr( $characters, rand( 0, strlen($characters)), 1 );	
		}
		
		return $password;
	}	
}