<?php
/************************************************************/
/*                             URI                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-index.php
2-index_suffix
3-lang
4-ssl

*/

/*
*-------------------------------------------------------------
*/

/*
*-------------------------------------------------------------------------------
*	İşlev: Url de yer alan index.php uzantısını kaldırmak için kullanılır.
	Değer false olursa url'lerde index.php uzantısı görünmez.
*	Parametreler: true, false.
*	Varsayılan: true.
*-------------------------------------------------------------------------------
*/
$config['Uri']['index.php'] 	= true;

/*
*-------------------------------------------------------------------------------
*	İşlev: .htaccess dosyasında index.php bölümü sonuna ? ekler
*	Parametreler: "", ?
*	Varsayılan: "".
*-------------------------------------------------------------------------------
*/
$config['Uri']['index_suffix']  = '';


/*
/*
*-------------------------------------------------------------------------------
*	İşlev: Url de aktif dilin görüntülenmesi için kullanılır
	Değer false olursa url'lerde dil uzantısı görünmez.
*	Parametreler: true, false.
*	Varsayılan: false.
*-------------------------------------------------------------------------------
*/
$config['Uri']['lang'] 			= false; //false;

/*
*-------------------------------------------------------------------------------
*	İşlev: http, ssl aktif olduğunda https olarak değiştirilir.
*	Parametreler: true, false.
*	Varsayılan: false.
*-------------------------------------------------------------------------------
*/
$config['Uri']['ssl'] 			= false; // false;
