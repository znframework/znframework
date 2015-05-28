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
				'Ocak' 		=> 'Oca', 
				'Şubat' 	=> 'Şub', 
				'Mart' 		=> 'Mar', 
				'Nisan' 	=> 'Nis', 
				'Mayıs' 	=> 'May', 
				'Haziran' 	=> 'Haz', 
				'Temmuz' 	=> 'Tem', 
				'Ağustos' 	=> 'Ağu', 
				'Eylül' 	=> 'Eyl', 
				'Ekim' 		=> 'Eki', 
				'Kasım'		=> 'Kas', 
				'Aralık' 	=> 'Ara'
			),
				
	'en' => array
			(
				'Janury'	=> 'Jan', 
				'February'	=> 'Feb', 
				'March'		=> 'Mar', 
				'April'		=> 'Apr', 
				'May'		=> 'May', 
				'June'		=> 'Jun', 
				'July'		=> 'Jul', 
				'August'	=> 'Aug', 
				'September'	=> 'Sep', 
				'October'	=> 'Oct', 
				'November'	=> 'Nov', 
				'December'	=> 'Dec'
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
				'Pazartesi' => 'Pzt', 
				'Salı'		=> 'Sal',	 	
				'Çarşamba'	=> 'Çar', 
				'Perşembe'	=> 'Per', 
				'Cuma'		=> 'Cum', 
				'Cumartesi'	=> 'Cts', 
				'Pazar'		=> 'Paz'
			),
				
	'en' => array
			(
				'Monday'	=> 'Mon', 
				'Tuesday'	=> 'Tue', 
				'Wednesday'	=> 'Wed', 
				'Thursday'	=> 'Thu', 
				'Friday'	=> 'Fri', 
				'Saturday'	=> 'Sat', 
				'Sunday'	=> 'Sun'
			)
);