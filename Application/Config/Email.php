<?php
/************************************************************/
/*                      EMAIL(E-POSTA)                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* EMAIL SETTINGS                                    									  *
*******************************************************************************************
| E-posta ile ilgili ayarlar yer almaktadır.					                          |
|          																				  |
******************************************************************************************/
$config['Email'] = array
(
	'smtpHost'			=> '',
	'smtpUser'			=> '',
	'smtpPassword'		=> '',
	'smtpPort'			=> 587,
	'smtpKeepAlive'		=> false,
	'smtpTimeout'		=> 10,
	'smtpEncode'		=> 'tls',	// tls, ssl
	'senderMail'		=> '',
	'senderName'		=> '',
	'wordWrap'			=> true,
	'charWrap'			=> 80,
	'validate'			=> true,
	'eol'				=> "\n",
	'dsn'				=> false,
	'priority'	   		=> 3,		// 1, 2, 3, 4, 5
	'protocolType' 		=> 'mail',  // mail, smtp
	'contentType'		=> 'text',  // text, html
	'charset'			=> 'utf-8',
	'multiPart'			=> 'mixed', // mixed, related
	'sendMultiPart'		=> true,
	'mailPath'			=> '/usr/sbin/sendmail',
	'bccStackMode'		=> false,
	'bccStackSize'		=> 200,
	'altContent'		=> '',
	'mbEnabled'			=> true,
	'iconvEnabled'		=> true,
	'xMailer'			=> 'ZN',
);
