<?php
namespace ZN\Services\Drivers;

class ImapDriver implements EmailDriverInterface
{
	/***********************************************************************************/
	/* IMAP MAIL LIBRARY					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: ImapmailDriver
	/* ZN Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Email kütüphanesi tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	public function __construct()
	{
		if( ! function_exists('imap_mail') )
		{
			die(getErrorMessage('Error', 'undefinedFunction', 'imap_mail'));	
		}	
	}
	
	public function send($to, $subject, $message, $headers = NULL, $settings = NULL)
	{
		return imap_mail($to, $subject, $message, $headers);	
	}
}