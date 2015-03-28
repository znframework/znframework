<?php 

/************************************************************/
/*                     TOOL EMAIL                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

// Function: send_email()
// İşlev: E-posta gönderimi için kullanılır.
// Parametreler
// @to = E-posta gönderilecek olan kişinin e-posta adresi.
// @subject = Gönderilecek e-postanın konusu.
// @message = Gönderilecek e-postanın içeriği.
// @extra = E-posta'nın ilave ayarları.
if(!function_exists("send_email"))
{
	function send_email($to = '', $subject = '', $message = '', $extra = '')
	{
		if( ! is_string($to) || ! is_email($to)) return false;
		if( ! is_string($subject)) $subject = '';
		if( ! is_string($message)) $message = '';
		if( ! is_string($extra)) $extra = '';
		
		$result = mail($to,$subject,$message, $extra);	
		if(empty($result)) 
			return false;
		else
			return true;
	}
}

// Function: send_imap_email()
// İşlev: Imap E-posta gönderimi için kullanılır.
// Parametreler
// @to = E-posta gönderilecek olan kişinin e-posta adresi.
// @subject = Gönderilecek e-postanın konusu.
// @message = Gönderilecek e-postanın içeriği.
// @extra = E-posta'nın ilave ayarları.
if(!function_exists("send_imap_email"))
{
	function send_imap_email($to = '', $subject = '', $message = '', $extra = '')
	{
		if( ! is_string($to) || ! is_email($to)) return false;
		if( ! is_string($subject)) $subject = '';
		if( ! is_string($message)) $message = '';
		if( ! is_string($extra)) $extra = '';
		
		$result = imap_mail($to,$subject,$message, $extra);	
		if(empty($result)) 
			return false;
		else
			return true;
	}
}