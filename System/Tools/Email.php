<?php 

/************************************************************/
/*                     TOOL EMAIL                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

/******************************************************************************************
* SEND EMAIL                                                                              *
*******************************************************************************************
| Genel Kullanım: E-posta gönderimi için kullanılır. 			                          |
|																						  |
| Parametreler: 4 parametresi vardır.                                              	      |
| 1. string var @to => Alıcı e-posta adresi.				  							  |
| 2. string var @subject => E-posta konusu.				                                  |
| 3. string var @message => E-posta içeriği.				                              |
| 4. string var @extra => İlave ayarlar.				                                  |
|          																				  |
| Örnek Kullanım: send_email('bilgi@zntr.net', 'Konu', 'Mesaj')  						  |
|																						  |
******************************************************************************************/	
if(!function_exists("send_email"))
{
	function send_email($to = '', $subject = '', $message = '', $extra = '')
	{
		if( ! is_string($to) || ! is_email($to) ) 
		{
			return false;
		}
		
		if( ! is_string($subject) ) 
		{
			$subject = '';
		}
		
		if( ! is_value($message) ) 
		{
			$message = '';
		}
		
		if( ! is_string($extra) ) 
		{
			$extra = '';
		}
		
		$result = mb_send_mail($to, $subject, $message, $extra);
			
		if( empty($result) ) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

/******************************************************************************************
* SEND IMAP EMAIL                                                                         *
*******************************************************************************************
| Genel Kullanım: IMAP E-posta gönderimi için kullanılır. 			                      |
|																						  |
| Parametreler: 4 parametresi vardır.                                              	      |
| 1. string var @to => Alıcı e-posta adresi.				  							  |
| 2. string var @subject => E-posta konusu.				                                  |
| 3. string var @message => E-posta içeriği.				                              |
| 4. string var @extra => İlave ayarlar.				                                  |
|          																				  |
| Örnek Kullanım: send_imap_email('bilgi@zntr.net', 'Konu', 'Mesaj')  				      |
|																						  |
******************************************************************************************/	
if(!function_exists("send_imap_email"))
{
	function send_imap_email($to = '', $subject = '', $message = '', $extra = '')
	{
		if( ! is_string($to) || ! is_email($to) ) 
		{
			return false;
		}
		
		if( ! is_string($subject) ) 
		{
			$subject = '';
		}
		
		if( ! is_value($message) ) 
		{
			$message = '';
		}
		
		if( ! is_string($extra) ) 
		{
			$extra = '';
		}
	
		$result = imap_mail($to, $subject, $message, $extra);
			
		if( empty($result) ) 
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}