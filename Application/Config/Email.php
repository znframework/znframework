<?php
/************************************************************/
/*                      EMAIL(E-POSTA)                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* PHP MAILER SINIFI REFERANS ALINARAK OLUŞTURULMUŞTUR.                                    *
*******************************************************************************************
| Bu sınıfın oluşturulmasında PHPMailer sınıfı referans alınmıştır.                       |
|          																				  |
| Camel standartlarında yazılan PHPmailer yöntemleri PHP yazım standartına çevrilmiştir.  |
|          																				  |
| Bu nedenle bu sınıfın kullanımında yer alan bir çok yöntemin nasıl kullanıldığı ile     |
| ilgili detaylı bilgiyi PHPMailer dökümantasyonundan yararlanarak öğrenebilirsiniz.	  |
| biz temel olarak kullanılması gereken ve önemli gördüğümüz yöntemleri anlattık.     	  |
|          																				  |
******************************************************************************************/

/******************************************************************************************
* USERNAME                                                                        	      *
*******************************************************************************************
| Genel Kullanım: Kullanıcı e-posta adresi.							 					  |					
******************************************************************************************/
$config['Email']['settings'] = array
(
	'smtpHost'			=> '',
	'smtpUser'			=> '',
	'smtpPassword'		=> '',
	'smtpPort'			=> 587,
	'smtpKeepAlive'		=> false,
	'smtpTimeout'		=> 10,
	'smtpEncode'		=> 'tls',
	'senderMail'		=> '',
	'senderName'		=> '',
	'wordWrap'			=> true,
	'charWrap'			=> 80,
	'validate'			=> true,
	'eol'				=> "\n",
	'dsn'				=> false,
	'priority'	   		=> 3,
	'protocolType' 		=> 'mail',
	'contentType'		=> 'text',
	'charset'			=> 'utf-8',
	'multiPart'			=> 'mixed',
	'sendMultiPart'		=> true,
	'mailPath'			=> '/usr/sbin/sendmail',
	'bccStackMode'		=> false,
	'bccStackSize'		=> 200,
	'altContent'		=> '',
	'mbEnabled'			=> true,
	'iconvEnabled'		=> true,
	'xMailer'			=> 'ZN',
);
