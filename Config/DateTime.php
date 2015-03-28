<?php
/************************************************************/
/*                        DATETIME                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-timezone
2-iconv_in_charset
3-iconv_out_charset
4-setlocale
5-set_time_format_chars
6-set_date_format_chars
//--------------------------------------------------------------------------------------------------------------------------

/* TIME ZONE */
// Saatlerde kaymama olmaması için bölge seçimi yapılmıştır.
// Bulunduğunu bölgeye göre ayarlayabilirsiniz. 
// Varsayılan olarak Europe/Istanbul seçilmiştir.
$config['DateTime']['timezone'] = 'Europe/Istanbul';

/* ICONV IN CHARSET */
// Tüm Tarih ve Saat fonksiyonları için geçerli bir ayardır.
// Bazı karakterlerin özellikle Türkçe karakterlerin
// bozuk görünmesi sebebi ile kullanımış bir yöntemdir.
// iconv() yönteminin giriş dili olarak latin5 belirlenmiştir.
$config['DateTime']['iconv_in_charset'] = 'latin5';

/* ICONV OUT CHARSET */
// Tüm Tarih ve Saat fonksiyonları için geçerli bir ayardır.
// Yukarıdaki giriş karakterlerin hangi karakter setine
// çevrileceğini belirler. utf-8 olarak belirlenmiştir.
$config['DateTime']['iconv_out_charset'] = 'utf-8';

/* SET LOCALE */
// Bu ayarın geçerli olduğu Tarih ve Saat fonksiyonları
// standart_time()
// current_time()
// current_date()
// current_date_time()
// set_time()
$config['DateTime']['setlocale'] = array(

	'charset' => 'tr_TR.UTF-8',
	'language' => 'turkish',
	
);

/* SET TIME FORMAT CHARS */
// set_time() yöntemi için oluşturulmuş özel kullanımlar yerine
// aşağıda anahtar olarak belirlenmiş ifadelerde kullanılabilir.
// Örnek: %a yerine <short_day> ifadesi kullanılabilir.
// ' | ' ifadesi ile ayrılmış anahtar değerler alternatif olarak 
// kullanılabilirler.
// Örnek: <short_day_name> , <short_day> ya da <sd> kullanılabilir
// hepsini karşılığı %a özel ifadesidir.
$config['DateTime']['set_time_format_chars'] = array
(
	'<short_day_name>|<short_day>|<sd>' 						=> '%a',
	'<day_name>|<day>|<d>' 										=> '%A',
	'<day_number0>|<daynum0>|<dn0>' 							=> '%d',
	'<day_number>|<daynum>|<dn>' 								=> '%e',
	'<year_day_number0>|<yeardaynum0>|<ydn>' 					=> '%j',	
	'<iso_week_day_number>|<iso_weekdaynum>|<iwdn>' 			=> '%u',
	'<week_day_number>|<weekdaynum>|<wdn>'						=> '%w',
	'<week_number>|<weeknum>|<wn>' 								=> '%U',
	'<starting_monday_year_week_number>|<sm_yearweeknum>|<smywn>'=> '%W',
	'<short_month_name>|<short_month>|<sm>' 					=> '%b',
	'<month_name>|<month>|<mon>' 								=> '%B',
	'<month_number>|<monnum>|<mn>' 								=> '%m',	
	'<century>|<cen>' 											=> '%C',
	'<short_year>|<sy>'			 								=> '%y',
	'<year>|<y>' 												=> '%Y',
	'<hour024>|<h024>' 											=> '%H',
	'<hour24>|<h24>' 											=> '%k',
	'<hour012>|<h012>' 											=> '%I',
	'<hour12>|<h12>' 											=> '%l',	
	'<minute0>|<minute>|<min>|<min0>' 							=> '%M',
	'<AMPM>|<AM>'												=> '%p',
	'<ampm>|<am>' 												=> '%P',
	'<second>|<second0>|<sec>|<sec0>' 							=> '%S',
	'<clock>' 													=> '%X',	
	'<date_time>' 												=> '%c',
	'<date>' 													=> '%x'
);

/* SET DATE FORMAT CHARS */
// set_date() yöntemi için oluşturulmuş özel kullanımlar yerine
// aşağıda anahtar olarak belirlenmiş ifadelerde kullanılabilir.
// Örnek: D yerine <short_day> ifadesi kullanılabilir.
// ' | ' ifadesi ile ayrılmış anahtar değerler alternatif olarak 
// kullanılabilirler.
// Örnek: <short_day_name> , <short_day> ya da <sd> kullanılabilir
// hepsini karşılığı D özel ifadesidir.
$config['DateTime']['set_date_format_chars'] = array
(
	'<short_day_name><short_day>|<sd>' 							=> 'D',
	'<day_name>|<day>|<d>' 										=> 'l',
	'<day_number0>|<daynum0>|<dn0>' 							=> 'd',
	'<day_number>|<daynum>|<dn>' 								=> 'j',
	'<total_days>|<td>' 										=> 't',
	'<year_day_number0>|<year_day_number>|<yeardaynum0>|<yeardaynum>|<ydn0>|<ydn>' => 'z',	
	'<week_day_number>|<weekdaynum>|<wdn>' 						=> 'N',
	'<week_day_number0>|<weekdaynum0>|<wdn0>' 					=> 'w',
	'<week_number>|<weeknum>|<wn>' 								=> 'W',	
	'<short_month_name>|<sort_month>|<sm>' 						=> 'M',
	'<month_name>|<month>|<mon>' 								=> 'F',
	'<month_number0>|<monnum0>|<mn0>' 							=> 'm',	
	'<month_number>|<monnum>|<mn>' 								=> 'n',	
	'<short_year>|<sy>' 										=> 'y',	
	'<year>|<y>' 												=> 'o',
	'<current_year>|<cy>' 										=> 'Y',
	'<year_number>|<yearnum>|<yn>' 								=> 'L',
	'<hour024>|<h024>' 											=> 'H',
	'<hour24>|<h24>' 											=> 'G',
	'<hour012>|<h012>' 											=> 'h',
	'<hour12>|<h12>' 											=> 'g',
	'<minute0>|<minute>|<min|<min0>' 							=> 'i',
	'<AMPM>|<AM>' 												=> 'A',
	'<ampm>|<am>' 												=> 'a',
	'<second>|<second0>|<sec>|<sec0>' 							=> 's',
	'<micro_second>|<micsec>|<ms>'					 			=> 'u',
	'<internet_connection_time>|<incontime>|<ict>' 				=> 'B',																						
	'<iso>' 													=> 'c',
	'<rfc>' 													=> 'r',
	'<unix>' 													=> 'U'																										
);
//--------------------------------------------------------------------------------------------------------------------------