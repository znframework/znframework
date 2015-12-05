<?php
class PipeDriver implements EmailDriverInterface
{
	/***********************************************************************************/
	/* PIPE EMAIL DRIVER					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: PipeDriver
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
	
	public function send($to, $subject, $message, $headers = NULL, $settings = array())
	{
		$returnPath = $settings['mailPath'].' -oi -f '.$settings['from'].' -t -r '.$settings['returnPath'];
		
		$open = @popen($returnPath, 'w');
		
		if( empty($open) )
		{
			return Error::set('Email', 'sendFailureSendmail');
		}
		
		@fputs($open, $headers);
		@fputs($open, $message);
		
		$status = @pclose($open);
		
		if( $status !== 0 )
		{
			Error::set('Email', 'exitStatus', $status);
			Error::set('Email', 'noSocket');
			
			return false;
		}
		
		return true;	
	}
}