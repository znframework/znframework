<?php
namespace Cubrid;

trait UserTrait
{
	use \Driver\UserTrait;
	
	public function name($name = '')
	{
		return $name;
	}
	
	public function password($password = '')
	{
		return presuffix($password, '\'');
	}
	
	public function groups($groups = '')
	{
		return $groups;
	}
	
	public function members($members = '')
	{
		return $members;
	}
	
	public function create($user = '', $parameters = array())
	{
		return 'CREATE USER '.
		        $user.
				( ! empty($parameters[0]) ? ' PASSWORD '.$parameters[0] : '' ).
				( ! empty($parameters[1]) ? ' GROUPS '.$parameters[1]   : '' ).
				( ! empty($parameters[2]) ? ' MEMBERS '.$parameters[2]  : '' );
	}
	
	public function drop($user = '')
	{
		return 'DROP USER '.$user;
	}
	
	public function alter($user = '', $parameters = array())
	{
		return 'ALTER USER '.$user.( ! empty($parameters[0]) ? ' PASSWORD '.$parameters[0] : '' );
	}
}