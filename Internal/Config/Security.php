<?php
//----------------------------------------------------------------------------------------------------
// SECURITY 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Nc Encode
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Security sınıfında kullanılan ncEncode() yönteminin temizlemesi 	  
// istenilen kelimeler. Temizlenen kelimelerin yerini alacak yeni kelime.			      						
//
//----------------------------------------------------------------------------------------------------
$config['Security']['ncEncode'] =  
[
		'badChars' => 
		[
			'<!--',
			'-->',
			'<?',
			'?>',
			'<', 
			'>'
		], // string veya array
		
		'changeBadChars' => '[badchars]' // string veya array
];

//----------------------------------------------------------------------------------------------------
// Url Change Chars
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: URL saldırılarına karşı tehlike arz edeceğini düşündüğünüz ve 		  
// değiştirilmesini istediğiniz kelimeler veya imgeler. Anahtar ifade olarak değişmesini   
// istediğiniz karakterler, değer olarak değişecek karakterlerin yerini                    
// alacak yeni karakterler.																  
// NOT: Küçük-Büyük harf duyarlılığı yoktur. 											  
//
// Değişmesini istediğiniz karaketer özel karakter ise özel karaketerin başına \ karakteri 
// koymanız gereklidir. Örnek \. Değiştirme işlemi için preg_replace() yöntemi kullanıldığı
// için özel karakterlerin başına \ karaketeri getirmelisiniz. Sınırlayıcı karakterler 	  
// olan / / karakterleri kullanmanıza gerek yoktur. 										 
// Örnek: Yanlış kullanım: /ab\./, doğru kullanım: ab\.		
//	     					  				
//----------------------------------------------------------------------------------------------------
$config['Security']['urlChangeChars'] = 
[
	'<' 	=> '',
	'>' 	=> ''
	// 'old_chars' => 'change_new_chars'
]; 

//----------------------------------------------------------------------------------------------------
// File Bad Chars
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Dosya isimlerinde tehlike yaratacak karater listesi.			          					
//
//----------------------------------------------------------------------------------------------------
$config['Security']['fileBadChars'] = 
[
	'<!--', '-->', '<', '>', '"', "'", '&', '?', '$', '#', '{', '}', '[', ']', '=', ';', '../', '%20', '&22',
	'%3c', 		// <
	'%3e',		// >
	'%28',		// (
	'%29',		// )
	'%2528',	// (
	'%26',		// &
	'%24',		// $
	'%3f',		// ?
	'%3b',		// ;
	'%3d'		// =
];

//----------------------------------------------------------------------------------------------------
// Url Bad Chars
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: URL adresinde tehlike yaratacak karater listesi.			          	  					
//
//----------------------------------------------------------------------------------------------------
$config['Security']['urlBadChars'] = 
[
	'"', "'", '<', '>', "?", '&',
	':', '=', '{', '}', '[', '/',
    ']', '(', ')', ';', '$', '#',
	'\\', '../', '%20', '&22'
];

//----------------------------------------------------------------------------------------------------
// Injection Bad Chars
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Script saldırılarına neden olacak karater listesi.			          					
//
//----------------------------------------------------------------------------------------------------
$config['Security']['injectionBadChars'] = 
[
	'or.+\=' => '',
];

//----------------------------------------------------------------------------------------------------
// Script Bad Chars
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Script saldırılarına neden olacak karater listesi.			          						
//
//----------------------------------------------------------------------------------------------------
$config['Security']['scriptBadChars'] = 
[
	'document\.cookie'	=> 'document&#46;cookie',
	'document\.write' 	=> 'document&#46;write',
	'\.parentNode' 		=> '&#46;parentNode',
	'\.innerHTML' 		=> '&#46;innerHTML',
	'\-moz\-binding' 	=> '&#150;moz&#150;binding',
	'<' 				=> '&#60;',
	'>' 				=> '&#62;',
];

//----------------------------------------------------------------------------------------------------
// Regex Bad Chars
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Düzenli ifadelerde tehlikeye neden olacak karater listesi.			  					
//
//----------------------------------------------------------------------------------------------------
$config['Security']['regexBadChars'] = 
[
	"([\"'])?data\s*:[^\\1]*?base64[^\\1]*?,[^\\1]*?\\1?",
	'(document|(document\.)?window)\.(location|on\w*)',
	'expression\s*(\(|&\#40;)', 
	'Redirect\s+30\d',
	'javascript\s*:',	
	'vbscript\s*:',
	'wscript\s*:',
	'jscript\s*:',
	'vbs\s*:',		
];