<?php
//----------------------------------------------------------------------------------------------------
// LOG 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Create File                                                              		  
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Ana dizine robots.txt dosyası oluşturmak içindir.			  														  																	
//   					  
//----------------------------------------------------------------------------------------------------
$config['Robots']['createFile'] = true;

//----------------------------------------------------------------------------------------------------
// Rules
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Kurallar oluşturmak için kullanılır. Rules dizisi içerisinde sınırsız sayıda
// dizilerden oluşan kurallar kullanılabilir. Her bir dizi elemanı için user-agent, allow ve 
// disallow ayarlanabilir. Birden fazla user-agent kullanılacaksa eleman sayısı artırılabilir.
//
// Çoklu Kullanım: array( array('userAgent' => '*', ...), array('userAgent' => '*') ) Dizi türü
// Tekli Kullanım: array( 'userAgent' => '*' ) Dizge türü 
//	     					  										  				
//----------------------------------------------------------------------------------------------------
$config['Robots']['rules'] = array
(
	'userAgent' => '*',
	'allow'     => array(),
	'disallow'  => array('/System/')	
);