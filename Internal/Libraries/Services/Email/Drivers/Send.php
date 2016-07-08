<?php
namespace ZN\Services\Drivers;

class SendDriver implements EmailDriverInterface
{
	/***********************************************************************************/
	/* SEND MAIL LIBRARY					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: MailDriver
	/* ZN Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Email kütüphanesi tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	public function __construct()
	{
		if( ! function_exists('mb_send_mail') )
		{
			die(getErrorMessage('Error', 'undefinedFunction', 'mb_send_mail'));	
		}	
	}
	
	public function send($to, $subject, $message, $headers = NULL, $settings = NULL)
	{
		return mb_send_mail($to, $subject, $message, $headers);	
	}
}