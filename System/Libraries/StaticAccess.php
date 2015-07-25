<?php
class StaticAccess
{
	/***********************************************************************************/
	/* STATIC ACCESS LIBRARIES	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: StaticAccess
	/* Versiyon: 2.0 Temmuz V029 Güncellemesi
	/* Tanımlanma: Static ve Non Static
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Sistem tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
		return call_user_func_array(array(uselib('__USE_STATIC_ACCESS__'.static::getClassName()), $method), $parameters);	
	}
}