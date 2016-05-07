<?php 
//----------------------------------------------------------------------------------------------------
// FUNCTIONS 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Autoload                                                          
//----------------------------------------------------------------------------------------------------
//
// Functions/Autoloader/ dizininde bulunan dosyalar otomatik olarak dahil edilir.
// Bunu kapatmak için aşağıdaki status ayarına ait değer false, açmak için true olarak ayarlanır.
// Dizin içi dizinlerde de arama yapılması istenirse recursive true olarak ayarlanır.					  
//											     			 	  						  
//----------------------------------------------------------------------------------------------------
$config['Starting']['autoload'] = array
(
	'status'    => false,
	'recursive' => false
);

//----------------------------------------------------------------------------------------------------
// Handload                                                                  
//----------------------------------------------------------------------------------------------------
//
// El ile yüklenmek istenen fonksiyon dosyalarının yol bilgileri belirtilir. 
// Yol bilgisi belirtilirken Functions/Handload/ kök dizin kabul edilir. 				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Starting']['handload'] = array();