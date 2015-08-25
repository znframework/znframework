<?php
/************************************************************/
/*                           REGEX                          */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* REGULAR EXPIRESSIONS                                                                    *
*******************************************************************************************
| Genel Kullanımı: Regex.php kütüphanesi ile ilgili ayarları içerir.					  |
******************************************************************************************/

/******************************************************************************************
* REGULAR EXPIRESSION CHARS                                                               *
*******************************************************************************************
| Genel Kullanımı: Düzenli ifadelerde yer alan özel karakterlerle ilgili aşağıdaki 		  |
| değişiklikler yapılmıştır.					  										  |
******************************************************************************************/
$config['Regex']['regexChars'] = array
(
	'{nonWord}' 		=> '\B',
	'{word}' 			=> '\b',
	'{nonNumeric}' 		=> '\D',
	'{numeric}' 		=> '\d',
	'{schar}' 			=> '\W',
	'{nonSchar}' 		=> '\w',
	'{char}' 			=> '.',
	'{nonSpace}' 		=> '\S',
	'{space}'			=> '\s',
	'{starting}'		=> '^',
	'{ending}'			=> '$',
	'{repeatZ}'			=> '*',
	'{repeat}'			=> '+',
	'{whether}'			=> '?',
	'{or}'				=> '|',
	'{eolR}'			=> '\r',
	'{eolN}'			=> '\n',
	'{eol}'				=> '\r\n',
	'{tab}'				=> '\t',
	'{esc}'				=> '\e',
	'{hex}'				=> '\x'
);

/******************************************************************************************
* REGULAR EXPIRESSION SETTING CHARS                                                       *
*******************************************************************************************
| Genel Kullanımı: Düzenli ifadelerde oluşturulan desen sonuna konulan karakterlerle 	  |
| ilgili aşağıdaki değişiklikler yapılmıştır 											  |
******************************************************************************************/
$config['Regex']['settingChars'] = array
(
	'{insens}' 			=> 'i',
	'{generic}' 		=> 'g',
	'{each}' 			=> 's',
	'{multiline}'		=> 'm', 
	'{inspace>}' 		=> 'x'
);

/******************************************************************************************
* REGULAR EXPIRESSION SPECIAL CHARS                                                       *
*******************************************************************************************
| Genel Kullanımı: Düzenli ifadelerde yer alan özel karakterleri normal karakterler gibi  |
| kullanmak için aşağıdaki değişiklikler yapılmıştır.									  |
******************************************************************************************/
$config['Regex']['specialChars'] = array
(
	'.' 				=> '\.',
	'^' 				=> '\^',
	'$' 				=> '\$',
	'*' 				=> '\*',
	'+' 				=> '\+',
	'?' 				=> '\?',
	'|' 				=> '\|',
	'/' 				=> '\/'
);