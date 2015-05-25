<?php
/************************************************************/
/*                         CALENDAR                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* CALENDAR                                                                           	  *
*******************************************************************************************
| Genel Kullanım: Tavimle ilgili ayarların yapıldığı dosyadır.                            |
******************************************************************************************/

/******************************************************************************************
* MONTH NAMES                                                                         	  *
*******************************************************************************************
| Genel Kullanım: Dillere göre ay bilgilerini tutan dizidir.                			  |
******************************************************************************************/
$config['Calendar']['month_names'] = array
(
	'tr' => array
			(
				'Ocak', 'Şubat', 'Mart', 
				'Nisan', 'Mayıs', 'Haziran', 
				'Temmuz', 'Ağustos', 'Eylül', 
				'Ekim', 'Kasım', 'Aralık'
			),
				
	'en' => array
			(
				'Janury', 'February', 'March', 
				'April', 'May', 'June', 
				'July', 'August', 'September', 
				'October', 'November', 'December'
			)
);

/******************************************************************************************
*SHORT MONTH NAMES                                                                        *
*******************************************************************************************
| Genel Kullanım: Dillere göre kısa isimli ay bilgilerini tutan dizidir.                  |
******************************************************************************************/
$config['Calendar']['short_month_names'] = array
(
	'tr' => array
			(
				'Oca', 'Şub', 'Mar', 
				'Nis', 'May', 'Haz', 
				'Tem', 'Ağu', 'Eyl', 
				'Eki', 'Kas', 'Ara'
			),
				
	'en' => array
			(
				'Jan', 'Feb', 'Mar', 
				'Apr', 'May', 'Jun', 
				'Jul', 'Aug', 'Sep', 
				'Oct', 'Nov', 'Dec'
			)
);

/******************************************************************************************
* DAY NAMES                                                                           	  *
*******************************************************************************************
| Genel Kullanım: Dillere göre gün bilgilerini tutan dizidir.                			  |
******************************************************************************************/
$config['Calendar']['day_names'] = array
(
	'tr' => array
			(
				'Pazartesi', 'Salı', 
				'Çarşamba', 'Perşembe', 
				'Cuma', 'Cumartesi', 'Pazar'
			),
				
	'en' => array
			(
				'Monday', 'Tuesday', 
				'Wednesday', 'Thursday', 
				'Friday', 'Saturday', 'Sunday'
			)
);


/******************************************************************************************
* SHORT DAY NAMES                                                                         *
*******************************************************************************************
| Genel Kullanım: Dillere göre kısa isimli gün bilgilerini tutan dizidir.                 |
******************************************************************************************/
$config['Calendar']['short_day_names'] = array
(
	'tr' => array
			(
				'Pzt', 'Sal', 'Çar', 
				'Per', 'Cum', 'Cts', 'Paz'
			),	
			
	'en' => array
			(
				'Mon', 'Tue', 'Wed', 
				'Thu', 'Fri', 'Sat', 'Sun'
			)
);