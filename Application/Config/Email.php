<?php
/************************************************************/
/*                      EMAIL(E-POSTA)                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-settings
//--------------------------------------------------------------------------------------------------------------------------

/* EMAIL SETTINGS  */
$config["Email"] = array(
	'username'					=> '', // Gerçek bir mail adresi. Örn: bilgi@zntr.net <strong>string kullanıcı adı
	'fromname'					=> '', // Gönderici ismi. Örn: Zntr <strong>string gönderici ismi
	'password'					=> '', // Gerçek mail adresinin şifresi. Örn:zntr1234
	'host'						=> '', // Mail sunucusunun adı. Örn: mail.zntr.net
	'port'						=> 587,// Bağlantı sağlanacak port numarası.	
	'is_html'					=> true, // Html içerikli mail gönderilsin mi? boolean true veya false
	'is_smtp'					=> true, // Smtp kullanılsın mı? boolean true veya false
	'smtp_auth'					=> true, // Kimlik doğrulansın mı? boolean true veya false
	'smtp_debug' 				=> false, // Smtp hata ayıklama açık mı? boolean true veya false
	'smtp_secure'				=> 'tsl', // Bağlantı öneki. Alabileceği değerler string "", "ssl" veya "tls"
	'smtp_keep_alive'			=> false,
	'charset'					=> 'UTF-8',	
	'alt_body'					=> '',
	'priority'					=> '', // 3
	'content'					=> '', // text/plain
	'encoding'					=> '', // 8bit
	'word_wrap'					=> '',
	'send_mail'					=> '', // /usr/sbin/sendmail
	'mailer'					=> '', // mail
	'sender'					=> '',
	'return_path'				=> '',
	'use_send_mail_options' 	=> '', // true
	'confirm_reading_to' 		=> '',
	'host_name' 				=> '',
	'message_id' 				=> '',
	'message_date' 				=> '',
	'helo'	 					=> '',
	'auth_type'	 				=> '',
	'plugin_dir'				=> '',
	'realm'		 				=> '',
	'work_station'				=> '',
	'timeout'		 			=> '',
	'debug_output'				=> '',
	'single_to'					=> '',
	'single_to_array'			=> array(),
	'le'						=> '',
	'dkim_selector'				=> '',
	'dkim_identity'				=> '',
	'dkim_pass_phrase'			=> '',
	'dkim_domain'				=> '',
	'dkim_private'				=> '',
	'action_function'			=> '',
	'version'					=> '', // 5.2.4
	'xmailer'					=> ''

);
//--------------------------------------------------------------------------------------------------------------------------