<?php
/************************************************************/
/*                      EMAIL(E-POSTA)                      */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* EMAIL DRIVER                                       									  *
*******************************************************************************************
| E-posta gönderiminin hangi platform ile gönderileceğidir.		                          |

  @driver string -> mail (standart mail yöntemini kullanır).
  @driver string -> imap (imap_mail yöntemini kullanır).
  @driver string -> send (mb_send_mail yöntemini kullanır).
  @driver string -> smtp (soket ve dosya yöntemlerini kullanılır).
  @driver string -> pipe (popen yöntemini kullanır).
|          																				  |
******************************************************************************************/
$config['Email']['driver'] = 'mail';

/******************************************************************************************
* SMTP                                              									  *
*******************************************************************************************
| SMTP ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.                         |
|          																				  |
******************************************************************************************/
$config['Email']['smtp'] = array
(
	'host'			=> '',
	'user'			=> '',
	'password'		=> '',
	'port'			=> 587,
	'keepAlive'		=> false,
	'timeout'		=> 10,
	'encode'		=> '',	// empty, tls, ssl
	'dsn'			=> false,
	'auth'			=> true
);

/******************************************************************************************
* GENERAL                                              									  *
*******************************************************************************************
| Genel e-posta ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.                |
|          																				  |
******************************************************************************************/
$config['Email']['general'] = array
(
	'senderMail'    => '', // Ön tanımlı gönderen e-posta adresi.
	'senderName'    => '', // Ön tanımlı gönderen ismi.
	'priority'	   	=> 3,		// 1, 2, 3, 4, 5
	'charset'		=> 'UTF-8',
	'contentType'	=> 'plain',  // plain, html
	'multiPart'		=> 'mixed', // mixed, related, alternative
	'xMailer'		=> 'ZN',
	'encoding'		=> '8bit',
	'mimeVersion'	=> '1.0',
	'mailPath'		=> '/usr/sbin/sendmail'
);