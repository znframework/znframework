<?php
namespace ZN\Foundations;

class StaticAccess
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
	* MAGIC METHOD CALL STATIC                                                                *
	*******************************************************************************************
	| Genel Kullanım: Dinamik sınıflara statik erişim sağlamak için kullanılmaktadır.         |
	|															                              |
	******************************************************************************************/	
	public static function __callStatic($method, $parameters)
	{
		return self::useClassName($method, $parameters);
	}

	/******************************************************************************************
	* MAGIC METHOD CALL                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Bir sınıfa statik erişildiği gibi dinamik olarak erişmek içindir.       |
	|															                              |
	******************************************************************************************/	
	public function __call($method, $parameters)
	{
		return self::useClassName($method, $parameters);
	}
	
	/******************************************************************************************
	* PROTECTED USE CLASS NAME                                                                *
	*******************************************************************************************
	| Genel Kullanım: Statik ve dinamik çağrılar için oluşturulmuş yardım yöntemdir.          |
	|															                              |
	******************************************************************************************/	
	protected static function useClassName($method, $parameters)
	{
		return uselib(STATIC_ACCESS.static::getClassName())->$method(...$parameters);
	}
}