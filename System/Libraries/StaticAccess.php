<?php
class StaticAccess
{
	protected static function useClassName($method, $parameters)
	{
		return call_user_func_array(array(uselib('Static'.static::getClassName()), $method), $parameters);	
	}
	
	public static function __callStatic($method, $parameters)
	{
		return self::useClassName($method, $parameters);
	}

	public function __call($method, $parameters)
	{
		return self::useClassName($method, $parameters);
	}
}