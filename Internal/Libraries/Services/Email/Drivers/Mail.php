<?php
namespace ZN\Services\Drivers;

class MailDriver implements EmailDriverInterface
{
	/***********************************************************************************/
	/* MAIL LIBRARY							                   	                       */
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
		if( ! function_exists('mail') )
		{
			die(getErrorMessage('Error', 'undefinedFunction', 'mail'));	
		}	
	}
	
	public function send($to, $subject, $message, $headers = NULL, $settings = NULL)
	{
		return mail($to, $subject, $message, $headers);	
	}
}