<?php
//----------------------------------------------------------------------------------------------------
// EMAIL
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------
$lang['Email']['mustBeArray'] 			= 'The email validation method must be passed an array!';
$lang['Email']['invalidAddress'] 		= 'Invalid email address: %';
$lang['Email']['noSend']       			= 'Cannot send mail!';
$lang['Email']['attachmentMissing'] 	= 'Unable to locate the following email attachment: %';
$lang['Email']['attachmentUnreadable'] 	= 'Unable to open this attachment: %';
$lang['Email']['noFrom'] 				= 'Cannot send mail with no "From" header!';
$lang['Email']['noReceivers'] 			= 'You must include recipients: To, Cc, or Bcc';
$lang['Email']['sendFailurePhpmail'] 	= 'Unable to send email using PHP mail()! Your server might not be configured to send mail using this method!';
$lang['Email']['sendFailureSendmail'] 	= 'Unable to send email using PHP Sendmail! Your server might not be configured to send mail using this method!';
$lang['Email']['sendFailureSmtp'] 		= 'Unable to send email using PHP SMTP! Your server might not be configured to send mail using this method!';
$lang['Email']['sent'] 					= 'Your message has been successfully.';
$lang['Email']['noSocket'] 				= 'Unable to open a socket to Sendmail! Please check settings!';
$lang['Email']['noHostName'] 			= 'You did not specify a SMTP hostname!';
$lang['Email']['smtpError'] 			= 'The following SMTP error was encountered: %';
$lang['Email']['noSmtpUnpassword'] 		= 'Error: You must assign a SMTP username and password!';
$lang['Email']['failedSmtpLogin'] 		= 'Failed to send AUTH LOGIN command! Error: %';
$lang['Email']['smtpAuthUserName']		= 'Failed to authenticate username! Error: %';
$lang['Email']['smtpAuthPassword'] 		= 'Failed to authenticate password! Error: %';
$lang['Email']['smtpDataFailure'] 		= 'Unable to send data: %';
$lang['Email']['exitStatus'] 			= 'Exit status code: %';
$lang['Email']['mimeMessage'] 			= 'This is a multi-part message in MIME format.%Your email application may not support this format.';