<?php
/************************************************************/
/*                     ENCODE(ŞİFRELEME)                    */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* ENCODE                                                                         	  	  *
*******************************************************************************************
| Genel Kullanım: Encode sınıfına yönelik tek bir ayar içerir. 							  |
******************************************************************************************/

/******************************************************************************************
* CRYPTO DRIVERS                                                                      	  *
*******************************************************************************************
| Genel Kullanım: Veri şifrelemede kullanılan şifreleme sürücüleri.						  |		
 
  @drivers: mcyrpt, openssl, hash, phash, mhash
|																						  |									
******************************************************************************************/
$config['Encode']['driver'] = 'mcrypt';

/******************************************************************************************
* ENCODE  TYPE                                                                        	  *
*******************************************************************************************
| Genel Kullanım: Encode.php kütüphanesinde yer alan yöntemlerin temel olarak hangi		  |
| şifreleme algoritmasını kullanacağı seçmek için kullanılır. Şifrelenmesini istediğiniz  |
| hash algorimatsını yazmanız yeterlidir.				 								  |											
******************************************************************************************/
$config['Encode']['type'] = 'md5';

/******************************************************************************************
* PROJECT KEY                                                                         	  *
*******************************************************************************************
| Genel Kullanım: Encode sınıfına ait super() yöntemi için oluşturulmuş şifrelemeye	      |
| dahil edilecek ilave karakter ayarıdır. Böyle bir kullanımın oluşturulmasının temel	  |
| amacı her projede yer alan kullanıcı şifrelerinin birbirlerinden farklı olmasını 		  |
| sağlayarak şifre güvenliğini sağlamaktır.					     						  |
******************************************************************************************/
$config['Encode']['projectKey'] = 'default project';