<?php
namespace Fbase;

trait UserTrait
{
	use \Driver\UserTrait;
	
	public function schema($name = '')
	{
		return $name;
	}
	
	public function name($name = '')
	{
		return $name;
	}
	
	public function create($user = '', $parameters = array())
	{
		return 'CREATE USER '.
				$user.
				( ! empty($parameters[0]) ? ' DEFAULT SCHEMA '.$parameters[0] : '' );
	}
	
	public function drop($user = '', $parameters = array())
	{
		return 'DROP USER '.
				$user.
				( ! empty($parameters[0]) ? ' '.$parameters[0] : ' RESTRICT' );
	}
	
	public function alter($user = '', $parameters = array())
	{
		return 'ALERT USER '.
				$user.
				' SET DEFAULT SCHEMA '.$parameters[0];
	}
}