<?php 
/************************************************************/
/*                     USER(KULLANICI)                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* USER                                                                                    *
*******************************************************************************************
| Genel Kullanımı: Kullanıcı işlemleri ile ilgili bağlantı ayarları yer alır.			  |						
******************************************************************************************/

/******************************************************************************************
* TABLE NAME                                                                              *
*******************************************************************************************
| Genel Kullanımı: User Sınıfının Bağlantı Kurulacağı Kullanıcı Tablosu Adı.			  |
| Veri: string.																			  |
| Kullanımı: Zorunludur.																  |
| Örnek: = $config['User']['table-name'] = 'kullanicilar';			  					  |						
******************************************************************************************/
$config['User']['table-name'] 		= '';		

/******************************************************************************************
* USERNAME COLUMN                                                                         *
*******************************************************************************************
| Genel Kullanımı: Kullanıcı Adını Tutan Sütun.											  |
| Veri: string.																			  |
| Kullanımı: Zorunludur.																  |
| Sütun Veri Türü: Varchar															      |
| Örnek: = $config['User']['username-column'] = 'kullanici_adi';			  			  |						
******************************************************************************************/
$config['User']['username-column'] 	= '';

/******************************************************************************************
* PASSWORD COLUMN                                                                         *
*******************************************************************************************
| Genel Kullanımı: Kullanıcı Şifresini Tutan Sütun.										  |
| Veri: string.																	          |
| Kullanımı: Zorunludur.																  |
| Sütun Veri Türü: Varchar																  |
| Veri Uzunluğu: En az 32 karakter.														  |
| Örnek: = $config['User']['username-column'] = 'sifre';			  			          |						
******************************************************************************************/
$config['User']['password-column']  = '';

/******************************************************************************************
* EMAIL COLUMN                                                                            *
*******************************************************************************************
| Genel Kullanımı: Kullanıcı E-postasını Tutan Sütun.									  |
| Veri: string.																			  |
| Kullanımı: Görecelidir. Kullanıcı adı sütünu e-posta bilgisi içermiyorsa				  |
| bu sütun kullanılmalıdır.																  |
| Sütun Veri Türü: Varchar																  |
| Örnek: = $config['User']['email-column'] = 'eposta';		  			          		  |						
******************************************************************************************/
$config['User']['email-column']  = '';

/******************************************************************************************
* EMAIL COLUMN                                                                            *
*******************************************************************************************
| Genel Kullanımı: Kullanıcıların aktif olma durumunu kontrol eder.					      |
| Veri: string																			  |
| Kullanımı: Görecelidir. Kullanıcılardan hangisinin aktif olup						      |
| hangisinin aktif olmadığını öğrenmek için kullanılır. Bu sütunu kullanmak için		  |
| kullanıcı tablosunda bu bölüme uygu sütun oluşturup bu bölüme yazılmadılır.			  |
| Kullanılmayacaksa boş bırakılmalıdır. 												  |
| Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Aktif, 0 Aktif Değil		  |
| Örnek: = $config['User']['active-column'] = 'aktif_durum';		  			          |						
******************************************************************************************/
$config['User']['active-column']	= '';

/******************************************************************************************
* BANNED COLUMN                                                                           *
*******************************************************************************************
| Genel Kullanımı: Kullanıcıların banlı olma durumunu kontrol eder. Bu sütun aktifse	  | 
| banlanmış kullanıcılar siteye giriş yapamaz.										      |
| Veri: string																			  |	
| Kullanımı: Görecelidir. Kullanıcılardan banlananların siteye girememesini sağlar. 	  |
| Bu sütun kullanılmayacaksa boş bırakılmalıdır.										  |
| Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Banlanmış, 0 Banlanmamış	  |
| Örnek: = $config['User']['banned-column'] = 'ban_durum';	  			                  |						
******************************************************************************************/
$config['User']['banned-column']	= ''; 	

/******************************************************************************************
* ACTIVATION COLUMN                                                                       *
*******************************************************************************************
| Genel Kullanımı: Üyelik işlemlerinde aktive zorunluluğu olmasını isterseniz kullanıcı   |
| tablosunda bu alana uygun bir sütun oluşturulmalı ve sütun adı bu bölüme eklenmelidir.  |
| Veri: string																			  |
| Kullanımı: Görecelidir. Aktivasyon işlemi istenmiyorsa bu sütun boş bırakılmalıdır.	  |
| Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Aktivasyon Yapılmış, 		  |
| 0 Aktivasyon Yapılmamış																  |
| Örnek: = $config['User']['activation-column'] = 'aktivasyon_durum';			          |						
******************************************************************************************/
$config['User']['activation-column'] = '';