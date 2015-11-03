<?php
/************************************************************/
/*                      COOKIE(OTURUM)                      */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* CAPTCHA                                                                         	  	  *
*******************************************************************************************
| Genel Kullanım: Çerezlerle ilgili ayarlar yapmak için kullanılır.       		  	      |
******************************************************************************************/

/******************************************************************************************
* ENCODE                                                                             	  *
*******************************************************************************************
| Genel Kullanım: Cookie değerlerini tutan anahtar ifadelerin hangi şifreleme algoritması |
| ile şifreleneceği belirtilir. Şifrelenmesini istediğini hash algorimatsını yazmanız     |
| yeterlidir. Boş bırakılması halinde herhangi bir şifreleme yapmayacaktır.				  |
******************************************************************************************/
$config['Cookie']['encode'] = 'md5';

/******************************************************************************************
* REGENERATE ID                                                                           *
*******************************************************************************************
| Genel Kullanım: Çerez oluşturulurken farklı bir PHPSESSID oluşturmasını			      |
| sağlamak için bu değerin true olması gerekir. Güvenlik açısındanda			          |
| true olması önerilir.			                                                          |									
******************************************************************************************/
$config['Cookie']['regenerate'] = true;

/******************************************************************************************
* TIME                                                                                    *
*******************************************************************************************
| Genel Kullanım: Çerez süresini ayarlamak için kullanılır.								  |
| Parametre:Saniye cinsinden sayısal zaman değeri girilir.		                          |								
******************************************************************************************/
$config['Cookie']['time'] = 604800; // Integer / Numeric / String Numeric

/******************************************************************************************
* PATH                                                                                    *
*******************************************************************************************
| Genel Kullanım: Çerez nesnelerinin hangi dizinde tutulacağını ayarlamak için kullanılır.|						
******************************************************************************************/
$config['Cookie']['path'] = '/'; // String

/******************************************************************************************
* DOMAIN                                                                                  *
*******************************************************************************************
| Genel Kullanım: Çerezlerin hangi domain adresiden geçerli olacağını belirlemek için 	  |
| kullanılır.			      														      |							
******************************************************************************************/
$config['Cookie']['domain'] = ''; // String

/******************************************************************************************
* SECURE                                                                                  *
*******************************************************************************************
| Genel Kullanım: Çerezin istemciye güvenli bir HTTPS bağlantısı üzerinden mi aktarılması | 
| gerektiğini belirtmek için kullanılır.	  								              |		      														 						
******************************************************************************************/
$config['Cookie']['secure'] = false; // Boolean

/******************************************************************************************
* HTTPONLY                                                                                *
*******************************************************************************************
| Genel Kullanım: TRUE olduğu takdirde çerez sadece HTTP protokolü üzerinden erişilebilir |
| olacaktır. Yani çerez, JavaScript gibi betik dilleri tarafından erişilebilir 			  |
| olmayacaktır.   								             							  |		      															 						
******************************************************************************************/
$config['Cookie']['httpOnly'] = true; // Boolean