<?php 
/************************************************************/
/*                        TOOL AJAX                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/******************************************************************************************
* JSON SEND BACK                                                                          *
*******************************************************************************************
| Genel Kullanım: Ajax işlemleri sırasında verinin json tipinde veri olarak gönderilmesi  |
| için kullanılır.														                  |
|																						  |
| Parametreler: Tek dizi parametresi vardır.                                              |
| 1. array var @data => Gönderilecek olan dizi.							  				  |
|          																				  |
******************************************************************************************/	
function json_send_back($data = array())
{
	if( ! is_array($data) || empty($data) ) 
	{
		return false;
	}
	
	json_encode($data);	exit;
}

/******************************************************************************************
* SEND BACK                                                                               *
*******************************************************************************************
| Genel Kullanım: Ajax işlemleri sırasında veri döndürmek için kullanılır.				  |
|																						  |
| Parametreler: Tek parametreden oluşur.                                                  |
| 1. mixed var @data => Çıktı oluşturulacak veri.							  		      |
|          																				  |
******************************************************************************************/	
function send_back($data = '')
{
	if( ! is_value($data) ) 
	{
		return false;
	}
	echo $data; exit;	
}	
