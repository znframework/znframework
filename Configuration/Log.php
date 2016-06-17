<?php
//----------------------------------------------------------------------------------------------------
// LOG 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Create File                                                              		  
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Çalışma esnasında oluşan kod hatalarını kayıt altına alır.			  
// Parametreler: true veya false															  
// Varsayılan: false																		  
// Kayıtlar Logs/ dizini içerisinde kayıt altına alınmaktadır.	  
//   					  
//----------------------------------------------------------------------------------------------------
$config['Log']['createFile'] = false;

//----------------------------------------------------------------------------------------------------
// File Time
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Log dosyalarının ne kadar süre ile kayıtları tutacağı ayarlanır.		  
// Parametreler: Metinsel türde zaman bilgileri day, month, year							  
// Varsayılan: 30 day																	  
// Sürenin dolması durumunda herhangi bir hata oluştuğunda eski kayıtlar					  
// silinir ve yeni hata kaydı eklenir. Böylece Log dosyalarının şismesinin				  
// önüne geçilmiş olur.
//	     					  										  				
//----------------------------------------------------------------------------------------------------
$config['Log']['fileTime'] = '30 day';