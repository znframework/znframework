<?php 
namespace ZN\VariableTypes;

class InternalSerial implements SerialInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use \CallUndefinedMethodTrait;
	
	/******************************************************************************************
	* SERIAL                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen ayraçlara göre diziyi özel bir veri tipine çeviriyor.        |
	|															                              |
	******************************************************************************************/	
	public function encode($data = '')
	{
		return serialize($data);
	}
	
	/******************************************************************************************
	* UNSERIAL                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function decode($data = '', $array = false)
	{
		if( ! is_string($data) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(data)');
		}
		
		if( $array === false )
		{
			return (object) unserialize($data);
		}
		else
		{
			return unserialize($data);
		}
	}
	
	/******************************************************************************************
	* UNSERIAL                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function decodeObject($data = '')
	{
		if( ! is_string($data) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(data)');
		}
		
		return (object) unserialize($data);
	}
	
	/******************************************************************************************
	* UNSERIAL                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function decodeArray($data = '')
	{
		if( ! is_string($data) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(data)');
		}
		
		return unserialize($data);
	}
}