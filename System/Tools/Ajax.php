<?php 
/************************************************************/
/*                        TOOL AJAX                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: json_send_back()
// İşlev:Dizi olarak girilen verileri json veri tipine dönüştürür.
// Parametreler: $data = Json veri tipine dönüştürülecek dizi verisi.
// Dönen Değer: Json tipinde veri.
function json_send_back($data = array())
{
	if( ! is_array($data) || empty($data)) return false;
	json_encode($data);	exit;
}

// Function: send_back()
// İşlev:Ajax veri ekrana yazdırıldıktan sonra yöntemin sonlandırılmasını sağlar.
// Parametreler: $data = Ekrana bastırılacak değer.
// Dönen Değer: Parametre olarak girilen ifade.
function send_back($data = '')
{
	if( ! is_value($data)) return false;
	echo $data; exit;	
}	
