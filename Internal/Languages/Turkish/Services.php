<?php
//--------------------------------------------------------------------------------------------------------
// Services
//--------------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//--------------------------------------------------------------------------------------------------------

return
[
	//----------------------------------------------------------------------------------------------------
	// Cookie
	//----------------------------------------------------------------------------------------------------
	//
	// Cookie Lang Words
	//
	//----------------------------------------------------------------------------------------------------
	'cookie:setError' => 'Çerez tanımlanamadı!',

	//----------------------------------------------------------------------------------------------------
	// Crontab
	//----------------------------------------------------------------------------------------------------
	//
	// Crontab Lang Words
	//
	//----------------------------------------------------------------------------------------------------
	'crontab:timeFormatError' => 'Geçersiz zaman formatı!',

	//----------------------------------------------------------------------------------------------------
	// Email
	//----------------------------------------------------------------------------------------------------
	//
	// Email Lang Words
	//
	//----------------------------------------------------------------------------------------------------
	'email:mustBeArray'  			=> 'E-posta dizi bilgisi içermelidir!',
	'email:invalidAddress' 			=> 'Gönderilmedi! % e-posta adresi geçersiz!',
	'email:noSend'       			=> 'E-posta gönderilmedi!',
	'email:attachmentMissing'    	=> 'E-posta eki eksik!',
	'email:attachmentUnreadable' 	=> 'E-posta eki okunamıyor!',
	'email:noFrom'  				=> 'Kimden bilgisi belirtmeden e-posta gönderilemez!',
	'email:noReceivers' 			=> 'Cc veya Bcc, için: Alıcıları içermelidir.',
	'email:sendFailurePhpmail'  	=> 'E-posta kullanarak PHP posta göndermek için açılamıyor ()! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!',
	'email:sendFailureSendmail' 	=> 'PHP Sendmail kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!',
	'email:sendFailureSmtp' 		=> 'PHP SMTP kullanarak e-posta göndermek için açılamıyor! Sunucunuz bu yöntemi kullanarak posta göndermek için yapılandırılmamış olabilir!',
	'email:sent' 					=> 'Mesajını başarı ile gönderildi.',
	'email:noSocket' 				=> 'E-posta gönderimi için bir yuva açılamıyor! Ayarlarınızı kontrol edin!',
	'email:noHostName'  			=> 'Bir SMTP sunucu ismi belirtilmedi!',
	'email:smtpError'				=> 'Aşağıdaki SMTP hatası ile karşılaşıldı: %',
	'email:noSmtpUnpassword' 		=> 'Hata: Bir SMTP kullanıcı adı ve şifre atamanız gerekir!',
	'email:failedSmtpLogin'			=> 'AUTH LOGIN komutunu gönderilemedi! Hata: %',
	'email:smtpAuthUserName'		=> 'Kullanıcı adı kimliği doğrulanamadı! Hata: %',
	'email:smtpAuthPassword'		=> 'Parola kimlik doğrulaması yapılamadı! Hata: %',
	'email:smtpDataFailure' 		=> 'SMPT Veri göndermek için açılamıyor: %',
	'email:exitStatus'  			=> 'Çıkış durum kodu: %',
	'email:mimeMessage' 			=> 'Bu MIME biçiminde çok parçalı mesajdır.%E-posta uygulaması bu formatı desteklemiyor olabilir.'
];