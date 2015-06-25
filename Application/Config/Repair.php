 <?php
/************************************************************/
/*                          REPAIR                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* REPAIR                                                                                  *
*******************************************************************************************
| Genel Kullanımı: Web sitenizde onarım işlemleri ile ilgili ayarları içerir.			  |
| Düzenleme yapılan bilgisayar/bilgisayarların, kullanıcılardan 						  |
| ayırt edilmesini sağlar. System Repair moda alındığında aktif olur, 					  |
| sistem çalışırken sistemde düzenleme yapma olanağı sağlar.							  |
| Not: Sistem repair moda alınmadan önce bu değer ip'nize göre ayarlanmalıdır.			  |
| Varsayılan: 127.0.0.1			  |														  |
******************************************************************************************/

/******************************************************************************************
* MODE                                                                                    *
*******************************************************************************************
| Genel Kullanımı: Sistemi onarmak için modu true olarak ayarlamalısınız.				  |
******************************************************************************************/
$config['Repair']['mode'] = false; 

/******************************************************************************************
* MACHINES                                                                                *
*******************************************************************************************
| Genel Kullanımı: Sistem üzerinde onarım yapılırken diğer kullanıcıların bu onarımdan	  |
| etkilenmemesi için ip ayırt etme yönteminden yayarlanılmıştır. Aşağıdaki diziye 		  |
| gireceğiz ip bilgisine sahip bilgisayarlarda onarım sayfası görüntülenirken diğer		  |
| kullanıcılarda bu sayfada onarım olduğuna dair bir mesaj görünecektir. Böylece		  |
| geliştiriciler sitelerini onarmaya devam ederken kullanıcılar sitenizi kullanmaya		  |
| devam edebilecekler.							  	 				     				  |	
******************************************************************************************/
$config['Repair']['machines'] = array(); 

/******************************************************************************************
* PAGES                                                                                   *
*******************************************************************************************
| Genel Kullanımı: Onarım işlemi yapılan sayfalar belirtiliyor. Tek bir sayfa ise 		  |
| string atama yapabirsiniz. Birden çok sayfa belirtilecekse dizi içerisinde sırası ile	  |
| onarım yapılan sayfalar belirtilir. Eğer tüm sayfalarda onarım yapılıyorsa string 	  |
| "all" ataması kullanılır.						  	 				     				  |	
******************************************************************************************/
$config['Repair']['pages'] = array();

/******************************************************************************************
* ROUTE PAGE                                                                              *
*******************************************************************************************
| Genel Kullanımı: Onarıma alınan sayfa ziyaret edildiğinde kullanıcıların hangi sayfaya  |
| yönlenmesi isteniyorsa o sayfanın yolu belirtilir.						  	 		  |	
******************************************************************************************/
$config['Repair']['routePage'] = ''; 