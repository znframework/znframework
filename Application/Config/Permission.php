<?php
/************************************************************/
/*                      PERMISSION                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* PERMISSION                                                                   		  	  *
*******************************************************************************************
| Genel Kullanım: Erişim sistemidir. Sayfa ve nesnelere erişim yetkilerini düzenlemek	  |
| için kullanılır.											 	     					  |
******************************************************************************************/

/******************************************************************************************
* ÖRNEK USER ROLE ( KULLANICI ROLLERİ )                                                   *
*******************************************************************************************
| 1 User																				  |
| 2 Moderator																			  |
| 3 Supermoderator																		  |
| 4 admin																				  |
| 5 Superadmin																			  |
| 6 Administrator										 	     					  	  |
| .																						  |
| .																						  |
| .																						  |
******************************************************************************************/

/******************************************************************************************
* PAGE                                                                       		  	  *
*******************************************************************************************
| Genel Kullanım: İzin verilen sayfaları belirlemek için "perm->|s1|s2" şeklinde kullanın.|
| İzin vermek istemediğiniz sayfaları belirlemek için "noperm->|s1|s2" şeklinde kullanın. |
| Hiç bir sayfaya izin vermemek için any parametresini kullanın.						  |
| Her sayfaya izin vermek için all parametresiniz kullanın								  |
| Tek bir sayfaya izin vermek istediğinide normal olarak yazın.							  |
| Tek bir sayfaya izin vermek istemediğinizde ise başına "!" işareti koyarak yazın.		  |
******************************************************************************************/
$config['Permission']['page'] = array
(
	//'1' => 'any',
	//'2' => 'any',
	//'3' => 'noperm->|sayfa1|sayfa2',
	//'4' => 'perm->|sayfa3|sayfa4',
	//'5' => 'noperm->|sayfa5|sayfa6',
	//'6' => 'all'
);

/******************************************************************************************
* PROCESS                                                                       		  *
*******************************************************************************************
| Genel Kullanım: İzin verilen nesneleri belirlemek için "perm->|s1|s2" şeklinde kullanın.|
//İzin vermek istemediğiniz nesneleri belirlemek için "noperm->|s1|s2" şeklinde kullanın. |
//Hiç bir nesneye izin vermemek için any parametresini kullanın.						  |
//Her nesneye izin vermek için all parametresiniz kullanın								  |
//Tek bir nesneye izin vermek istediğinide normal olarak yazın.						      |
//Tek bir nesneye izin vermek istemediğinizde ise başına "!" işareti koyarak yazın.		  |
******************************************************************************************/
$config['Permission']['process'] = array
(
	//'1' => 'any',
	//'2' => 'any',
	//'3' => 'noperm->|yetki1|yetki2',
	//'4' => 'perm->|yetki3|yetki4',
	//'5' => 'noperm->|yetki5|yetki6',
	//'6' => 'all'
);