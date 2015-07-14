<?php
class StaticAccess
{	
	/***********************************************************************************/
	/* FACEDE LIBRARY	    			                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: StaticAccess
	/* Versiyon: 2.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: benchmark::, $this->benchmark, zn::$use->benchmark, uselib('benchmark')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	protected static function callClass($method, $parameters)
	{
		return call_user_func_array(array(uselib('Static'.Autoloader::$class), $method), $parameters);
	}
	
	public static function __callStatic($method, $parameters)
	{
		return self::callClass($method, $parameters);
	}
	
	public function __call($method, $parameters)
	{
		return self::callClass($method, $parameters);
	}
}