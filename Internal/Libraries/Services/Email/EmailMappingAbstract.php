<?php
namespace ZN\Services\Abstracts;

abstract class EmailMappingAbstract
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
	abstract public function send($to, $subject, $message, $headers, $settings);
}