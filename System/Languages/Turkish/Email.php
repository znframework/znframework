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
$lang['Email']['mustBeArray']          = 'E-posta dizi bilgisi içermelidir!';
$lang['Email']['invalidAddress']       = 'Gönderilmedi! % e-posta adresi geçersiz!';
$lang['Email']['noSend']               = 'E-posta gönderilmedi!';
$lang['Email']['attachmentMissing']    = 'E-posta eki eksik!';
$lang['Email']['attachmentUnreadable'] = 'E-posta eki okunamıyor!';
$lang['Email']['noFrom']               = 'Kimden bilgisi belirtmeden e-posta gönderilemez!';
$lang['Email']['noReceivers']          = 'Cc veya Bcc, için: Alıcıları içermelidir';
$lang['Email']['sendFailurePhpmail']   = 'E-posta kullanarak PHP posta göndermek için açılamıyor ()! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!';
$lang['Email']['sendFailureSendmail']  = 'PHP Sendmail kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!';
$lang['Email']['sendFailureSmtp']      = 'PHP SMTP kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!';
$lang['Email']['sent']                 = 'Mesajını başarı ile gönderildi.';
$lang['Email']['noSocket']             = 'E-posta gönderimi için bir yuva açılamıyor! Ayarlarınızı kontrol edin!';
$lang['Email']['noHostName']           = 'Bir SMTP sunucu ismi belirtilmedi!';
$lang['Email']['smtpError']            = 'Aşağıdaki SMTP hatası ile karşılaşıldı: %';
$lang['Email']['noSmtpUnpassword']     = 'Hata: Bir SMTP kullanıcı adı ve şifre atamanız gerekir!';
$lang['Email']['failedSmtpLogin']      = 'AUTH LOGIN komutunu gönderilemedi! Hata: %';
$lang['Email']['smtpAuthUserName']     = 'Kullanıcı adı kimliği doğrulanamadı! Hata: %';
$lang['Email']['smtpAuthPassword']     = 'Parola kimlik doğrulaması yapılamadı! Hata: %';
$lang['Email']['smtpDataFailure']      = 'SMPT Veri göndermek için açılamıyor: %';
$lang['Email']['exitStatus']           = 'Çıkış durum kodu: %';
$lang['Email']['mimeMessage']          = 'Bu MIME biçiminde çok parçalı mesajdır.%E-posta uygulaması bu formatı desteklemiyor olabilir.';