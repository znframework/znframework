<?php
//----------------------------------------------------------------------------------------------------
// HEADERS 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Set Htaccess File
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: ini_set() yöntemiyle yapamadığınız ayarlamaları buradan yapabilirsiniz. 
// .htaccess dosyasında ini ayarları yapılabilsin mi? 									  
// Parametreler: true veya false.													      
// Varsayılan: false
//          															  
//----------------------------------------------------------------------------------------------------
$config['Headers']['setHtaccessFile'] = false;

//----------------------------------------------------------------------------------------------------
// Iniset
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Bu bölümün aktif olabilmesi için yukarıdaki ayar true ayarlanmalıdır.   
// İşlev: .htaccess dosyasına header ayarları eklemek için kullanılır.				      
// Parametreler: array() dizi değerler alır.									              
// Varsayılan: array() 
//     															      
//----------------------------------------------------------------------------------------------------
$config['Headers']['iniSet'] = array
(
	'Header set Connection keep-alive'
);

//----------------------------------------------------------------------------------------------------
// Settings
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: header() fonksiyonuna parametreler göndermek için kullanılır.			  
// parametreler param1, param2, param3 .... paramN şeklinde kullanılır.					  
//																					      
// Varsayılan: "content-type: text/html; charset=utf-8"     								  
//
//----------------------------------------------------------------------------------------------------
$config['Headers']['settings'] = array
(
	'content-type: text/html; charset=utf-8'
);