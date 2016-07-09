<?php
namespace ZN\Components;

interface ScheduleInterface
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
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Listeyi oluşturmak için kullanılır.				                      |
	  
	  @param array $data
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function create($data);
}