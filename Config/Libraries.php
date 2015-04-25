<?php
/************************************************************/
/*                 LIBRARIES(KÜTÜPHANELER)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-short_name
2-different_directory

*/

/*
*-------------------------------------------------------------
*/


//-------------------------------------------------------------------------------------
// İşlev: Kütüphanelerin sınıf isimlerinde dosya isminden farklı bir
// isim kullanılması düşünülüyorsa bu bölüme ilave edilmelidir.
// Veri: array().
// Kullanımı: array('Database' => 'Db' , ...);
//-------------------------------------------------------------------------------------
$config['Libraries']['short_name'] 	= array
(
	'Benchmark' 	=> 'Bench',
	'Cookie'		=> 'Cook',
	'Pagination'	=> 'Pag',
	'Permission'	=> 'Perm',
	'Regex'			=> 'Reg',
	'Security'		=> 'Sec',
	'Session'		=> 'Sess',
	'Validation'	=> 'Val'
);	

//-------------------------------------------------------------------------------------
// İşlev: Kütüphane olarak çağrılmak istenen dosyaların yer aldığı dizin
// aşağıdaki diziye belirtilerek kütüphane gibi dahil edilibilir hale gelir.
// Veri: array().
// Kullanımı: array(DB_DIR, 'System/xx/' , a/c/);
//-------------------------------------------------------------------------------------
$config['Libraries']['different_directory'] = array(DB_DIR);