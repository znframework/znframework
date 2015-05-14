<?php 
/************************************************************/
/*              AUTOLOAD(OTOMATİK DAHİL ETME)               */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-Library
2-Tool
3-Coder
4-Language
//--------------------------------------------------------------------------------------------------------------------------

/* LIBRARY	*/
// İşlev:Otomatik olarak kütüphane yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz kütüphaneleri diziye elaman olarak sırayla ekleyin.
// Örnek: array("Database", "Validation");
$config['Autoload']['library'] 	= array(); // Array

/* COMPONENT	*/
// İşlev:Otomatik olarak bileşen yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz bileşenleri diziye elaman olarak sırayla ekleyin.
// Örnek: array("Database", "Validation");
$config['Autoload']['component'] = array(); // Array

/* TOOL	*/
// İşlev:Otomatik olarak araç yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz araçları diziye elaman olarak sırayla ekleyin.
// Örnek: array("Cleaner", "Rounder");
$config['Autoload']['tool'] 	= array(); // Array

/* MODEL	*/
// İşlev:Otomatik olarak model dosyası yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz model dosyalarını diziye elaman olarak sırayla ekleyin.
// Örnek: array("ModelPage1", "ModelPage2");
$config['Autoload']['model'] 	= array(); // Array

/* LANGUAGE	*/
// İşlev:Otomatik olarak dil dosyası yüklemek için kullanılır
// Parametre:Dahil etmek istediğiniz dil dosyalarını diziye elaman olarak sırayla ekleyin.
// Örnek: array("DilDosyasi1", "DilDosyasi2");
$config['Autoload']['language'] = array(); // Array

/* COMPOSER AUTOLOAD	*/
// İşlev:Composer autoload dosyasının yüklenip yüklenilmeyeceğine karar verir.
// Parametre:True, false veya yol değeri alır. True, vendor/autoload.php dosyasının yüklnemesi anlamına gelir.
// Parametre olarak yol değeri belirtilebilir. Örnek: example/vendor/autoload.php
// Örnek: true veya false
$config['Autoload']['composer'] = false;
//--------------------------------------------------------------------------------------------------------------------------