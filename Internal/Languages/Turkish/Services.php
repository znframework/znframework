<?php
//----------------------------------------------------------------------------------------------------
// CRONTAB
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
$lang['Services']['cookie:setError'] = 'Çerez tanımlanamadı!';

//----------------------------------------------------------------------------------------------------
// Crontab
//----------------------------------------------------------------------------------------------------
//
// Crontab Lang Words
//
//----------------------------------------------------------------------------------------------------
$lang['Services']['crontab:timeFormatError'] = 'Geçersiz zaman formatı!';

//----------------------------------------------------------------------------------------------------
// Services
//----------------------------------------------------------------------------------------------------
//
// Services Lang Words
//
//----------------------------------------------------------------------------------------------------
$lang['Services']['email:mustBeArray']          = 'E-posta dizi bilgisi içermelidir!';
$lang['Services']['email:invalidAddress']       = 'Gönderilmedi! % e-posta adresi geçersiz!';
$lang['Services']['email:noSend']               = 'E-posta gönderilmedi!';
$lang['Services']['email:attachmentMissing']    = 'E-posta eki eksik!';
$lang['Services']['email:attachmentUnreadable'] = 'E-posta eki okunamıyor!';
$lang['Services']['email:noFrom']               = 'Kimden bilgisi belirtmeden e-posta gönderilemez!';
$lang['Services']['email:noReceivers']          = 'Cc veya Bcc, için: Alıcıları içermelidir';
$lang['Services']['email:sendFailurePhpmail']   = 'E-posta kullanarak PHP posta göndermek için açılamıyor ()! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!';
$lang['Services']['email:sendFailureSendmail']  = 'PHP Sendmail kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!';
$lang['Services']['email:sendFailureSmtp']      = 'PHP SMTP kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!';
$lang['Services']['email:sent']                 = 'Mesajını başarı ile gönderildi.';
$lang['Services']['email:noSocket']             = 'E-posta gönderimi için bir yuva açılamıyor! Ayarlarınızı kontrol edin!';
$lang['Services']['email:noHostName']           = 'Bir SMTP sunucu ismi belirtilmedi!';
$lang['Services']['email:smtpError']            = 'Aşağıdaki SMTP hatası ile karşılaşıldı: %';
$lang['Services']['email:noSmtpUnpassword']     = 'Hata: Bir SMTP kullanıcı adı ve şifre atamanız gerekir!';
$lang['Services']['email:failedSmtpLogin']      = 'AUTH LOGIN komutunu gönderilemedi! Hata: %';
$lang['Services']['email:smtpAuthUserName']     = 'Kullanıcı adı kimliği doğrulanamadı! Hata: %';
$lang['Services']['email:smtpAuthPassword']     = 'Parola kimlik doğrulaması yapılamadı! Hata: %';
$lang['Services']['email:smtpDataFailure']      = 'SMPT Veri göndermek için açılamıyor: %';
$lang['Services']['email:exitStatus']           = 'Çıkış durum kodu: %';
$lang['Services']['email:mimeMessage']          = 'Bu MIME biçiminde çok parçalı mesajdır.%E-posta uygulaması bu formatı desteklemiyor olabilir.';