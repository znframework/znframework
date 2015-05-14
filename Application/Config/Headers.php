<?php
/************************************************************/
/*                    HEADERS(BAŞLIKLAR)                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-settings
//--------------------------------------------------------------------------------------------------------------------------

/* HEADERS SETTINGS */
/*


/* 	SET HTTACESS FILE  */
// 	ini_set() yöntemiyle yapamadığınız ayarlamaları buradan yapabilirsiniz.
// 	.htaccess dosyasında ini ayarları yapılabilsin mi? 
// 	Parametreler: true veya false.
// 	Varsayılan: false
$config['Headers']['set_htaccess_file'] = false;

/*
*-------------------------------------------------------------------------------
*	Bu bölümün aktif olabilmesi için yukarıdaki ayar true ayarlanmalıdır.
*	İşlev: .htaccess dosyasına header ayarları eklemek için kullanılır.
*	Parametreler: array() dizi değerler alır.
*	Varsayılan: array()
*-------------------------------------------------------------------------------
*/
$config['Headers']['iniset'] = array
(
	'Header set Connection keep-alive'
);

/*
//--------------------------------------------------------------------------------------------------------------------------
*	İşlev: header() fonksiyonuna parametreler göndermek için kullanılır.
*	parametreler param1, param2, param3 .... paramN şeklinde kullanılır.
*	
*	Varsayılan: "content-type: text/html; charset=utf-8"
//--------------------------------------------------------------------------------------------------------------------------
*/
$config['Headers']['settings'] = array
(
	'content-type: text/html; charset=utf-8'
);
//--------------------------------------------------------------------------------------------------------------------------