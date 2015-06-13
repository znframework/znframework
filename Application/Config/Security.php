<?php
/************************************************************/
/*                    SECURITY(GÜVENLİK)                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* SECURITY                                                                                *
*******************************************************************************************
| Genel Kullanımı: Sistem güvenliği için oluşturulmuş bir ayar dosyasıdır.			      |						
******************************************************************************************/

/******************************************************************************************
* NC ENCODE                                                                               *
*******************************************************************************************
| Genel Kullanımı: Security sınıfında kullanılan ncEncode() yönteminin temizlemesi 	  |
| istenilen kelimeler. Temizlenen kelimelerin yerini alacak yeni kelime.			      |						
******************************************************************************************/
$config['Security']['nc_encode'] = array 
(
		'bad_chars' => array
		(
			'<!--',
			'-->',
			'<?',
			'?>',
			'<', 
			'>',
		), // string veya array
		
		'change_bad_chars' => '[badchars]' // string veya array
);

/******************************************************************************************
* URL CHANGE CHARS                                                                        *
*******************************************************************************************
| Genel Kullanımı: URL saldırılarına karşı tehlike arz edeceğini düşündüğünüz ve 		  |
| değiştirilmesini istediğiniz kelimeler veya imgeler. Anahtar ifade olarak değişmesini   |
| istediğiniz karakterler, değer olarak değişecek karakterlerin yerini                    |
| alacak yeni karakterler.																  |
| NOT: Küçük-Büyük harf duyarlılığı yoktur. 											  |
| Değişmesini istediğiniz karaketer özel karakter ise özel karaketerin başına \ karakteri |
| koymanız gereklidir. Örnek \. Değiştirme işlemi için preg_replace() yöntemi kullanıldığı|
| için özel karakterlerin başına \ karaketeri getirmelisiniz. Sınırlayıcı karakterler 	  |
| olan / / karakterleri kullanmanıza gerek yoktur. 										  |
| Örnek: Yanlış kullanım: /ab\./, doğru kullanım: ab\.			     					  |						
******************************************************************************************/
$config['Security']['url_change_chars'] = array
(
	'<' 	=> '',
	'>' 	=> ''
	// 'old_chars' => 'change_new_chars'
); 

/******************************************************************************************
* FILE BAD CHARS                                                                          *
*******************************************************************************************
| Genel Kullanımı: Dosya isimlerinde tehlike yaratacak karater listesi.			          |						
******************************************************************************************/
$config['Security']['file_bad_chars'] = array
(
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
);

/******************************************************************************************
* URL BAD CHARS                                                                           *
*******************************************************************************************
| Genel Kullanımı: URL adresinde tehlike yaratacak karater listesi.			          	  |						
******************************************************************************************/
$config['Security']['url_bad_chars'] = array
(
	'"', "'", '<', '>', "?", '&',
	':', '=', '{', '}', '[', '/',
    ']', '(', ')', ';', '$', '#',
	'\\', '../', '%20', '&22'
);

/******************************************************************************************
* INJECTION BAD CHARS                                                                     *
*******************************************************************************************
| Genel Kullanımı: Script saldırılarına neden olacak karater listesi.			          |						
******************************************************************************************/
$config['Security']['injection_bad_chars'] = array
(
	'or.+\=' => '',
);

/******************************************************************************************
* SCRIPT BAD CHARS                                                                        *
*******************************************************************************************
| Genel Kullanımı: Script saldırılarına neden olacak karater listesi.			          |						
******************************************************************************************/
$config['Security']['script_bad_chars'] = array
(
	'document\.cookie'	=> 'document&#46;cookie',
	'document\.write' 	=> 'document&#46;write',
	'\.parentNode' 		=> '&#46;parentNode',
	'\.innerHTML' 		=> '&#46;innerHTML',
	'\-moz\-binding' 	=> '&#150;moz&#150;binding',
	'<comment>' 		=> '&#60;comment&#62;',
	'<\!\[CDATA\[',
	'<\!\-\-',
	'\-\->',
	'<' 				=> '&#60;',
	'>' 				=> '&#62;',
);

/******************************************************************************************
* REGULAR EXPRESSION BAD CHARS                                                            *
*******************************************************************************************
| Genel Kullanımı: Düzenli ifadelerde tehlikeye neden olacak karater listesi.			  |						
******************************************************************************************/
$config['Security']['regex_bad_chars'] = array
(
	"([\"'])?data\s*:[^\\1]*?base64[^\\1]*?,[^\\1]*?\\1?",
	'(document|(document\.)?window)\.(location|on\w*)',
	'expression\s*(\(|&\#40;)', 
	'Redirect\s+30\d',
	'javascript\s*:',	
	'vbscript\s*:',
	'wscript\s*:',
	'jscript\s*:',
	'vbs\s*:',		
);