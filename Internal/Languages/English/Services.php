<?php
//----------------------------------------------------------------------------------------------------
// Services
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Cookie
//----------------------------------------------------------------------------------------------------
//
// Cookie Lang Words
//
//----------------------------------------------------------------------------------------------------
$lang['Services']['cookie:setError'] = 'Could not set the cookie!';

//----------------------------------------------------------------------------------------------------
// Crontab
//----------------------------------------------------------------------------------------------------
//
// Crontab Lang Words
//
//----------------------------------------------------------------------------------------------------
$lang['Services']['crontab:timeFormatError'] = 'Invalid time format!';

//----------------------------------------------------------------------------------------------------
// Email
//----------------------------------------------------------------------------------------------------
//
// Email Lang Words
//
//----------------------------------------------------------------------------------------------------
$lang['Services']['email:mustBeArray'] 			= 'The email validation method must be passed an array!';
$lang['Services']['email:invalidAddress'] 		= 'Invalid email address: %';
$lang['Services']['email:noSend']       			= 'Cannot send mail!';
$lang['Services']['email:attachmentMissing'] 	= 'Unable to locate the following email attachment: %';
$lang['Services']['email:attachmentUnreadable'] 	= 'Unable to open this attachment: %';
$lang['Services']['email:noFrom'] 				= 'Cannot send mail with no "From" header!';
$lang['Services']['email:noReceivers'] 			= 'You must include recipients: To, Cc, or Bcc';
$lang['Services']['email:sendFailurePhpmail'] 	= 'Unable to send email using PHP mail()! Your server might not be configured to send mail using this method!';
$lang['Services']['email:sendFailureSendmail'] 	= 'Unable to send email using PHP Sendmail! Your server might not be configured to send mail using this method!';
$lang['Services']['email:sendFailureSmtp'] 		= 'Unable to send email using PHP SMTP! Your server might not be configured to send mail using this method!';
$lang['Services']['email:sent'] 					= 'Your message has been successfully.';
$lang['Services']['email:noSocket'] 				= 'Unable to open a socket to Sendmail! Please check settings!';
$lang['Services']['email:noHostName'] 			= 'You did not specify a SMTP hostname!';
$lang['Services']['email:smtpError'] 			= 'The following SMTP error was encountered: %';
$lang['Services']['email:noSmtpUnpassword'] 		= 'Error: You must assign a SMTP username and password!';
$lang['Services']['email:failedSmtpLogin'] 		= 'Failed to send AUTH LOGIN command! Error: %';
$lang['Services']['email:smtpAuthUserName']		= 'Failed to authenticate username! Error: %';
$lang['Services']['email:smtpAuthPassword'] 		= 'Failed to authenticate password! Error: %';
$lang['Services']['email:smtpDataFailure'] 		= 'Unable to send data: %';
$lang['Services']['email:exitStatus'] 			= 'Exit status code: %';
$lang['Services']['email:mimeMessage'] 			= 'This is a multi-part message in MIME format.%Your email application may not support this format.';