<?php 
/************************************************************/
/*                     USER(KULLANICI)                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-table_name
2-username_column
3-password_column
4-email_column
5-active_column
6-banned_column
7-activation_column

*/

/*
*-------------------------------------------------------------
*/


//-------------------------------------------------------------------------------------
// İşlev: User Sınıfının Bağlantı Kurulacağı Kullanıcı Tablosu Adı.
// Veri: string.
// Kullanımı: Zorunludur.
// Örnek: = $config['User']['table_name'] = 'kullanicilar';
//-------------------------------------------------------------------------------------
$config['User']['table_name'] 		= '';		

//-------------------------------------------------------------------------------------
// User Sınıfının Bağlantı Kurulacağı Kullanici Tablosu Sütunları
//-------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------
// İşlev: Kullanıcı Adını Tutan Sütun.
// Veri: string.
// Kullanımı: Zorunludur.
// Sütun Veri Türü: Varchar
// Örnek: = $config['User']['username_column'] = 'kullanici_adi';
//-------------------------------------------------------------------------------------
$config['User']['username_column'] 	= '';

//-------------------------------------------------------------------------------------
// İşlev: Kullanıcı Şifresini Tutan Sütun.
// Veri: string.
// Kullanımı: Zorunludur.
// Sütun Veri Türü: Varchar
// Veri Uzunluğu: En az 32 karakter.
// Örnek: = $config['User']['username_column'] = 'sifre';
//-------------------------------------------------------------------------------------
$config['User']['password_column']  = '';

//-------------------------------------------------------------------------------------
// İşlev: Kullanıcı E-postasını Tutan Sütun.
// Veri: string.
// Kullanımı: Görecelidir. Kullanıcı adı sütünu e-posta bilgisi içermiyorsa
// bu sütun kullanılmalıdır.
// Sütun Veri Türü: Varchar
// Örnek: = $config['User']['email_column'] = 'eposta';
//-------------------------------------------------------------------------------------
$config['User']['email_column']  = '';

//-------------------------------------------------------------------------------------
// İşlev: Kullanıcıların aktif olma durumunu kontrol eder.
// Veri: string
// Kullanımı: Görecelidir. Kullanıcılardan hangisinin aktif olup
// hangisinin aktif olmadığını öğrenmek için kullanılır. Bu sütunu kullanmak için
// kullanıcı tablosunda bu bölüme uygu sütun oluşturup bu bölüme yazılmadılır.
// Kullanılmayacaksa boş bırakılmalıdır. 
// Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Aktif, 0 Aktif Değil
// Örnek: = $config['User']['active_column'] = 'aktif_durum';
//-------------------------------------------------------------------------------------
$config['User']['active_column']	= '';

//-------------------------------------------------------------------------------------
// İşlev: Kullanıcıların banlı olma durumunu kontrol eder. Bu sütun aktifse banlanmış
// kullanıcılar siteye giriş yapamaz.
// Veri: string
// Kullanımı: Görecelidir. Kullanıcılardan banlananların siteye girememesini sağlar. 
// Bu sütun kullanılmayacaksa boş bırakılmalıdır.
// Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Banlanmış, 0 Banlanmamış
// Örnek: = $config['User']['banned_column'] = 'ban_durum';
//-------------------------------------------------------------------------------------
$config['User']['banned_column']	= ''; 	

//-------------------------------------------------------------------------------------
// İşlev: Üyelik işlemlerinde aktivasyon zorunluluğu olmasını isterseniz kullanıcı 
// tablosunda bu alana uygun bir sütun oluşturulmalı ve sütun adı bu bölüme eklenmelidir.
// Veri: string
// Kullanımı: Görecelidir. Aktivasyon işlemi istenmiyorsa bu sütun boş bırakılmalıdır.
// Sütun Veri Türü: Char / Int. 0 veya 1 değeri tutmalıdır. 1 Aktivasyon Yapılmış, 
// 0 Aktivasyon Yapılmamış
// Örnek: = $config['User']['activation_column'] = 'aktivasyon_durum';
//-------------------------------------------------------------------------------------
$config['User']['activation_column'] = '';