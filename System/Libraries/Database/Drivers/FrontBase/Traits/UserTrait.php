<?php
namespace ZN\Database\Drivers\FrontBase\Traits;

use ZN\Database\Drivers\Traits\UserTrait as CommonUserTrait;

trait UserTrait
{
	use CommonUserTrait;
	
	public function schema($name = '')
	{
		return $name;
	}
	
	public function name($name = '')
	{
		return $name;
	}
	
	public function create($user = '', $parameters = [])
	{
		return 'CREATE USER '.
				$user.
				( ! empty($parameters[0]) ? ' DEFAULT SCHEMA '.$parameters[0] : '' );
	}
	
	public function drop($user = '', $parameters = [])
	{
		return 'DROP USER '.
				$user.
				( ! empty($parameters[0]) ? ' '.$parameters[0] : ' RESTRICT' );
	}
	
	public function alter($user = '', $parameters = [])
	{
		return 'ALERT USER '.
				$user.
				' SET DEFAULT SCHEMA '.$parameters[0];
	}
}