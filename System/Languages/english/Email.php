<?php
/************************************************************/
/*                     EMAIL LANGUAGE                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www!zntr!net
Copyright 2012-2015 zntr!net - Tüm hakları saklıdır!

*/
$lang['Email']['must_be_array'] 		= 'The email validation method must be passed an array!';
$lang['Email']['invalid_address'] 		= 'Invalid email address: %';
$lang['Email']['attachment_missing'] 	= 'Unable to locate the following email attachment: %';
$lang['Email']['attachment_unreadable'] = 'Unable to open this attachment: %';
$lang['Email']['no_from'] 				= 'Cannot send mail with no "From" header!';
$lang['Email']['no_recipients'] 		= 'You must include recipients: To, Cc, or Bcc';
$lang['Email']['send_failure_phpmail'] 	= 'Unable to send email using PHP mail()! Your server might not be configured to send mail using this method!';
$lang['Email']['send_failure_sendmail'] = 'Unable to send email using PHP Sendmail! Your server might not be configured to send mail using this method!';
$lang['Email']['send_failure_smtp'] 	= 'Unable to send email using PHP SMTP! Your server might not be configured to send mail using this method!';
$lang['Email']['sent'] 					= 'Your message has been successfully.';
$lang['Email']['no_socket'] 			= 'Unable to open a socket to Sendmail! Please check settings!';
$lang['Email']['no_hostname'] 			= 'You did not specify a SMTP hostname!';
$lang['Email']['smtp_error'] 			= 'The following SMTP error was encountered: %';
$lang['Email']['no_smtp_unpw'] 			= 'Error: You must assign a SMTP username and password!';
$lang['Email']['failed_smtp_login'] 	= 'Failed to send AUTH LOGIN command! Error: %';
$lang['Email']['smtp_auth_un']		 	= 'Failed to authenticate username! Error: %';
$lang['Email']['smtp_auth_pw'] 			= 'Failed to authenticate password! Error: %';
$lang['Email']['smtp_data_failure'] 	= 'Unable to send data: %';
$lang['Email']['exit_status'] 			= 'Exit status code: %';