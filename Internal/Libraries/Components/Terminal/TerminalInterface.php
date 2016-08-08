<?php
namespace ZN\Components;

interface TerminalInterface
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
	// Run
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $terminalType
	// @param array  $settings
	//
	//----------------------------------------------------------------------------------------------------
	public function run(String $terminalType = 'php', Array $settings = []);
}