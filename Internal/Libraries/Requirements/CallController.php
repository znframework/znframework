<?php
class CallController extends BaseController
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
	// Call
	//----------------------------------------------------------------------------------------------------
	// 
	// Magic Call
	//
	//----------------------------------------------------------------------------------------------------
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage
		(
			'Error', 
			'undefinedFunction', 
			divide(str_ireplace(STATIC_ACCESS, '', get_called_class()), '\\', -1)."::$method()"
		));
	}
}