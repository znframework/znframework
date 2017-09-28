<?php return
[
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
    'cookie:setError' => 'Could not set the cookie!',

    //----------------------------------------------------------------------------------------------------
    // Crontab
    //----------------------------------------------------------------------------------------------------
    //
    // Crontab Lang Words
    //
    //----------------------------------------------------------------------------------------------------
    'crontab:timeFormatError' => 'Invalid time format!',

    //----------------------------------------------------------------------------------------------------
    // Email
    //----------------------------------------------------------------------------------------------------
    //
    // Email Lang Words
    //
    //----------------------------------------------------------------------------------------------------
    'email:noSend'                  => 'Cannot send mail!',
    'email:attachmentMissing'       => 'Unable to locate the following email attachment: %',
    'email:attachmentUnreadable'    => 'Unable to open this attachment: %',
    'email:noFrom'                  => 'Cannot send mail with no "From" header!',
    'email:sendFailureSendmail'     => 'Unable to send email using PHP Sendmail! Your server might not be configured to send mail using this method!',
    'email:noSocket'                => 'Unable to open a socket to Sendmail! Please check settings!',
    'email:smtpError'               => 'The following SMTP error was encountered: %',
    'email:noSmtpUnpassword'        => 'Error: You must assign a SMTP username and password!',
    'email:failedSmtpLogin'         => 'Failed to send AUTH LOGIN command! Error: %',
    'email:smtpAuthUserName'        => 'Failed to authenticate username! Error: %',
    'email:smtpAuthPassword'        => 'Failed to authenticate password! Error: %',
    'email:smtpDataFailure'         => 'Unable to send data: %',
    'email:exitStatus'              => 'Exit status code: %',
    'email:mimeMessage'             => 'This is a multi-part message in MIME format.%Your email application may not support this format.',
    'email:noHostName'              => 'SMTP Host information is empty!',
    'email:templateColumnError'     => 'The template % parameter does not contain column information! Usage -> table: column',
    'email:templateValueError'      => 'The template % parameter does not contain column value information! Usage -> whereColumn: value'
];
