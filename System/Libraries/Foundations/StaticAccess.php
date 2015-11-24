<?php
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
		$class = uselib(STATIC_ACCESS.static::getClassName());
		
		switch( count($parameters) )
		{
			// Parametre yoksa
			case 0 : return $class->$method();
	
			// 1 parametre için
			case 1 : return $class->$method($parameters[0]);
			
			// 2 parametre için
			case 2 : return $class->$method($parameters[0], $parameters[1]);
			
			// 3 parametre için
			case 3 : return $class->$method($parameters[0], $parameters[1], $parameters[2]);
	
			// 4 parametre için
			case 4 : return $class->$method($parameters[0], $parameters[1], $parameters[2], $parameters[3]);
				
			// 5 parametre için
			case 5 : return $class->$method($parameters[0], $parameters[1], $parameters[2], $parameters[3], $parameters[4]);
			
			// Daha fazla parametre için
			default: return call_user_func_array(array($class, $method), $parameters);
		}	
	}
}