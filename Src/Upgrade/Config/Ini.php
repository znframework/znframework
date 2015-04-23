<?php
/************************************************************/
/*                             INI                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-set_htaccess_file
2-settings
//--------------------------------------------------------------------------------------------------------------------------

/* SET HTTACESS FILE  */
// ini_set() yöntemiyle yapamadığınız ayarlamaları buradan yapabilirsiniz.
// .htaccess dosyasında ini ayarları yapılabilsin mi? 
$config['Ini']['set_htaccess_file'] = false;

/* SETTINGS  */
// .htaccess üzerinden hangi ini ayarlarını yapacaksanız onları yazıyorsunuz.
// anahtar kelime => değeri
// Örnek: upload_max_filesize => "10M" 
$config['Ini']['settings'] = array();
//--------------------------------------------------------------------------------------------------------------------------
