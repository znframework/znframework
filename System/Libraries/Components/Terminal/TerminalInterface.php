<?php
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
	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Terminali çalıştırır.					 	 						      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @terminalType => php , cmd.											      |
	| 2. array var @settings => Terminal ayarları.						 				      |
	|          																				  |
	| Örnek Kullanım: Terminal::run('cmd');        	  										  |
	|          																				  |
	******************************************************************************************/
	public function run($terminalType, $settings);
}