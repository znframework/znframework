<?php
//----------------------------------------------------------------------------------------------------
// EMAIL 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Driver
//----------------------------------------------------------------------------------------------------
// E-posta gönderiminin hangi platform ile gönderileceğidir.		                          
//
// @driver -> mail (standart mail yöntemini kullanır).
// @driver -> imap (imap_mail yöntemini kullanır).
// @driver -> send (mb_send_mail yöntemini kullanır).
// @driver -> smtp (soket ve dosya yöntemlerini kullanılır).
// @driver -> pipe (popen yöntemini kullanır).
//         																				  
//----------------------------------------------------------------------------------------------------
$config['Email']['driver'] = 'mail';

//----------------------------------------------------------------------------------------------------
// Smtp
//----------------------------------------------------------------------------------------------------
//
// SMTP ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.                         
//         																				  
//----------------------------------------------------------------------------------------------------
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

//----------------------------------------------------------------------------------------------------
// General
//----------------------------------------------------------------------------------------------------
//
// Genel e-posta ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.                
//         																				  
//----------------------------------------------------------------------------------------------------
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