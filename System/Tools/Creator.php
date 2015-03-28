<?php
/************************************************************/
/*                    TOOL CREATOR                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: password_creator()
// İşlev: Rasgele şifre üretmek için kullanılır.
// Parametreler
// @count = Üretilecek şifrenin kaç karakter olacağı.
// @chars = Şifrede sayısal mı yoksa alfa sayısısal mı karaketerlerin kullanıcağını belirler.
// 1-all = Sayısal ve alfasayısal tüm karakterler kullanılır. Örnek: A3c21d
// 2-numeric = Şife sadece sayısal karaketerlerden oluşur. Örnek: 123623
// 3-string = Şifre sasdece metinsel karakterlerden oluşur. Örnek: agAcHd
// Dönen Değer: Üretilen şifre.
if( ! function_exists('password_creator'))
{
	function password_creator($count = 6, $chars = "all")
	{
		if( ! is_numeric($count)) $count = 6;
		if( ! is_string($chars)) $chars = "all";
		
		$password   	= '';
		
		if($chars === "all") 
			$characters 	= "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		if($chars === "numeric") 
			$characters 	= "1234567890";
		if($chars === "string") 
			$characters 	= "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		
		for($i=0; $i < $count; $i++)
		{
			$password .= substr( $characters, rand( 0, strlen($characters)), 1 );	
		}
		return $password;
	}	
}