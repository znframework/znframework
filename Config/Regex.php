<?php
/************************************************************/
/*                           REGEX                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-regex_chars
2-settings_chars
3-special_chars

*/

/*
*-------------------------------------------------------------
*/
/*Düzenli ifadelerde yer alan özel karakterlerle ilgili aşağıdaki değişiklikler yapılmıştır. */
$config['Regex']['regex_chars'] = array(
	'<non-numeric>' 	=> '\D',
	'<numeric>' 		=> '\d',
	'<non-schar>' 		=> '\W',
	'<schar>' 			=> '\w',
	'<char>' 			=> '.',
	'<non-space>' 		=> '\S',
	'<space>'			=> '\s',
	'<starting>'		=> '^',
	'<ending>'			=> '$',
	'<repeat-z>'		=> '*',
	'<repeat>'			=> '+',
	'<whether>'			=> '?',
	'<or>'				=> '|',
	'<perline-r>'		=> '\r',
	'<perline>'			=> '\n',
	'<tab>'				=> '\t',
	'<esc>'				=> '\e',
	'<hex>'				=> '\x'
);

/*Düzenli ifadelerde oluşturulan desen sonuna konulan karakterlerle ilgili aşağıdaki değişiklikler yapılmıştır. */
$config['Regex']['setting_chars'] = array(
	'<insens>' 			=> 'i',
	'<generic>' 		=> 'g',
	'<each>' 			=> 's',
	'<multiline>'		=> 'm', 
	'<inspace>' 		=> 'x'
);

/*Düzenli ifadelerde yer alan özel karakterleri normal karakterler gibi kullanmak için aşağıdaki değişiklikler yapılmıştır. */
$config['Regex']['special_chars'] = array(
	'.' 				=> '\.',
	'^' 				=> '\^',
	'$' 				=> '\$',
	'*' 				=> '\*',
	'+' 				=> '\+',
	'?' 				=> '\?',
	'|' 				=> '\|',
	'/' 				=> '\/'
);