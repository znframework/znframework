<?php 
//----------------------------------------------------------------------------------------------------
// USER 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Table Name
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: User Sınıfının Bağlantı Kurulacağı Kullanıcı Tablosu Adı.			  
// Veri: string.																			  
// Kullanımı: Zorunludur.																  
// Örnek: = $config['User']['tableName'] = 'kullanicilar';			  					  						
//
//----------------------------------------------------------------------------------------------------
$config['User']['tableName'] = '';	

//----------------------------------------------------------------------------------------------------
// Join Column
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Birleştirmenin yapılmak istendiği sütun bilgisi. Genellikle ID sütünu kullanılır.																			  
// Veri: string.																			  
// Kullanımı: Zorunlu değildir.															  
// Sütun Veri Türü: mixed															      
// Örnek: = $config['User']['joinColumn'] = 'id';					     			      						
//
//----------------------------------------------------------------------------------------------------
$config['User']['joinColumn'] = '';

//----------------------------------------------------------------------------------------------------
// Join Tables
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Kullanıcılarla ilgili birden fazla tablo varsa bu tabloları 
// birleştirmek için kullanılır.															  
// Kullanımı: Zorunlu değildir.															  
// Örnek: array																			  
//        ( 																				  
//		      'tablo2' => 'birlestirilecekSutun2',									      
//		      'tablo3' => 'birlestirilecekSutun3'									          
//        )			  					  												  						
//
//----------------------------------------------------------------------------------------------------
$config['User']['joinTables'] = array();	

//----------------------------------------------------------------------------------------------------
// Username Column
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Kullanıcı Adını Tutan Sütun.											 
// Veri: string.																			  
// Kullanımı: Zorunludur.																  
// Sütun Veri Türü: Varchar															      
// Örnek: = $config['User']['usernameColumn'] = 'kullanici_adi';			  			  						
//
//----------------------------------------------------------------------------------------------------
$config['User']['usernameColumn'] = '';

//----------------------------------------------------------------------------------------------------
// Password Column
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Kullanıcı Şifresini Tutan Sütun.										  
// Veri: string.																	          
// Kullanımı: Zorunludur.																  
// Sütun Veri Türü: Varchar																  
// Veri Uzunluğu: En az 32 karakter.														  
// Örnek: = $config['User']['usernameColumn'] = 'sifre';			  			         						
//
//----------------------------------------------------------------------------------------------------
$config['User']['passwordColumn'] = '';

//----------------------------------------------------------------------------------------------------
// Email Column
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Kullanıcı E-postasını Tutan Sütun.									  
// Veri: string.																			  
// Kullanımı: Görecelidir. Kullanıcı adı sütünu e-posta bilgisi içermiyorsa				  
// bu sütun kullanılmalıdır.																  
// Sütun Veri Türü: Varchar																  
// Örnek: = $config['User']['emailColumn'] = 'eposta';		  			          		  						
//
//----------------------------------------------------------------------------------------------------
$config['User']['emailColumn'] = '';

//----------------------------------------------------------------------------------------------------
// Active Column
//----------------------------------------------------------------------------------------------------
// 
// Genel Kullanımı: Kullanıcıların aktif olma durumunu kontrol eder.					      
// Veri: string																			  
// Kullanımı: Görecelidir. Kullanıcılardan hangisinin aktif olup						      
// hangisinin aktif olmadığını öğrenmek için kullanılır. Bu sütunu kullanmak için		  
// kullanıcı tablosunda bu bölüme uygu sütun oluşturup bu bölüme yazılmadılır.			  
// Kullanılmayacaksa boş bırakılmalıdır. 												  
// Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Aktif, 0 Aktif Değil		  
// Örnek: = $config['User']['activeColumn'] = 'aktif_durum';		  			          					
//
//----------------------------------------------------------------------------------------------------
$config['User']['activeColumn']	= '';

//----------------------------------------------------------------------------------------------------
// Banned Column                                                                          
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Kullanıcıların banlı olma durumunu kontrol eder. Bu sütun aktifse	  
// banlanmış kullanıcılar siteye giriş yapamaz.										      
// Veri: string																			  
// Kullanımı: Görecelidir. Kullanıcılardan banlananların siteye girememesini sağlar. 	  
// Bu sütun kullanılmayacaksa boş bırakılmalıdır.										  
// Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Banlanmış, 0 Banlanmamış	  
// Örnek: = $config['User']['bannedColumn'] = 'ban_durum';	  			                  					
//
//----------------------------------------------------------------------------------------------------
$config['User']['bannedColumn']	= ''; 	

//----------------------------------------------------------------------------------------------------
// Activation Column                                                                     
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Üyelik işlemlerinde aktive zorunluluğu olmasını isterseniz kullanıcı   
// tablosunda bu alana uygun bir sütun oluşturulmalı ve sütun adı bu bölüme eklenmelidir.  
// Veri: string																			  
// Kullanımı: Görecelidir. Aktivasyon işlemi istenmiyorsa bu sütun boş bırakılmalıdır.	  
// Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Aktivasyon Yapılmış, 		  
// 0 Aktivasyon Yapılmamış																  
// Örnek: = $config['User']['activationColumn'] = 'aktivasyon_durum';			          			
//
//----------------------------------------------------------------------------------------------------
$config['User']['activationColumn'] = '';

//----------------------------------------------------------------------------------------------------
// Email Sende Info                              			                              
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Aktivasyon işlemleri veya şifremini unuttum işlemleri esnasından 
// gönderilecek e-posta'ya ait gönderen ismi ve e-posta bilgilerini belirtmek içindir. 
// Genellikle site adı ve e-posta adresi tercih edilir.							  		  				
//
//----------------------------------------------------------------------------------------------------
$config['User']['emailSenderInfo'] = array
(
	'name' => '',
	'mail' => ''
);