<?php
/************************************************************/
/*                    SECURITY(GÜVENLİK)                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-bad_words
2-url_indection_change_char

*/

/*
*-------------------------------------------------------------
*/

// Security sınıfında kullanılan nc_encode() yönteminin temizlemesi istenilen kelimeler.
// Temizlenen kelimelerin yerini alacak yeni kelime.
$config['Security']['nc_encode'] = array 
(
		'bad_words' => array
		(
			'<script>', 
			'</script>', 
			'<?', 
			'<?php', 
			'?>', 
			'<%', 
			'%>', 
			'<script', 
			'</script'
		), // string veya array veri tipi içerebilir.
		
		'change_bad_words' => '[badwords]' // string veya array veri tipi olmalıdır.
);

// URL saldırılarına karşı tehlike arz edeceğini düşündüğünüz ve değiştirilmesini istediğiniz kelimeler veya imgeler.
// Anahtar ifade olarak değişmesini istediğiniz karakterler, değer olarak değişecek karakterlerin yerini alacak yeni karakterler.
// NOT: Küçük-Büyük harf duyarlılığı yoktur. 
// Değişmesini istediğiniz karaketer özel karakter ise özel karaketerin başına \ karakteri koymanız gereklidir. Örnek \.
// Değiştirme işlemi için preg_replace() yöntemi kullanıldığı için özel karakterlerin başına \ karaketeri getirmelisiniz.
// Sınırlayıcı karakterler olan / / karakterleri kullanmanıza gerek yoktur. Örnek: Yanlış kullanım: /ab\./, doğru kullanım: ab\.
$config['Security']['url_injection_change_chars'] = array
(
	// 'old_chars' => 'change_new_chars'
); 