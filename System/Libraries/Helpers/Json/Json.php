<?php 
class __USE_STATIC_ACCESS__Json implements JsonInterface
{
	/***********************************************************************************/
	/* JSON LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Json
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Json::, $this->Json, zn::$use->Json, uselib('Json')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	use CallUndefinedMethodTrait;
	
	/******************************************************************************************
	* ENCODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen ayraçlara göre diziyi özel bir veri tipine çeviriyor.        |
	|															                              |
	******************************************************************************************/	
	public function encode($data = '')
	{
		return json_encode($data);
	}
	
	/******************************************************************************************
	* DECODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function decode($data = '', $array = false, $length = 512)
	{
		if( ! is_string($data) )
		{
			return Error::set('Error', 'stringParameter', '1.(data)');
		}
		
		return json_decode($data, $array, $length);
	}
	
	/******************************************************************************************
	* DECODE OBJECT                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function decodeObject($data = '', $length = 512)
	{
		if( ! is_string($data) )
		{
			return Error::set('Error', 'stringParameter', '1.(data)');
		}
		
		return json_decode($data, false, $length);
	}
	
	/******************************************************************************************
	* DECODE ARRAY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function decodeArray($data = '', $length = 512)
	{
		if( ! is_string($data) )
		{
			return Error::set('Error', 'stringParameter', '1.(data)');
		}
		
		return json_decode($data, true, $length);
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function error()
	{
		return json_last_error_msg();
	}
	
	/******************************************************************************************
	* ERROR VALUE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function errval()
	{
		return json_last_error_msg();
	}
	
	/******************************************************************************************
	* ERROR NO                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|          																				  |
	******************************************************************************************/	
	public function errno()
	{
		return json_last_error();
	}
}