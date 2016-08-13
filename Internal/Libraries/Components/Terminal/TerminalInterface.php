<?php namespace ZN\Components;

interface TerminalInterface
{
	//----------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
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