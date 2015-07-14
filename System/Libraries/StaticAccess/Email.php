<?php
class Email
{
	public static function __callStatic($method, $parameters)
	{
		return call_user_func_array(array(uselib("StaticEmail"), $method), $parameters);
	}

	public function __call($method, $parameters)
	{
		return call_user_func_array(array(uselib("StaticEmail"), $method), $parameters);
	}
}