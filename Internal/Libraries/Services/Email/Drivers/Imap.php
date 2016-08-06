<?php
namespace ZN\Services\Drivers;

use ZN\Services\Abstracts\EmailMappingAbstract;

class ImapDriver extends EmailMappingAbstract
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		\Support::func('imap_mail');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Send
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $to
	// @param string $subject
	// @param string $message
	// @param mixed  $headers
	// @param mixed  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function send($to, $subject, $message, $headers = NULL, $settings = NULL)
	{
		return imap_mail($to, $subject, $message, $headers);	
	}
}