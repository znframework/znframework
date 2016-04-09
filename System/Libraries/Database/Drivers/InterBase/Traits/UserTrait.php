<?php
namespace Ibase;

trait UserTrait
{
	use \Driver\UserTrait;
	
	public function adminRole($role = '')
	{
		return $role;
	}
	
	public function firstName($name = '')
	{
		return $name;
	}
	
	public function middleName($name = '')
	{
		return $name;
	}
	
	public function lastName($name = '')
	{
		return $name;
	}
	
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
				' PASSWORD '.presuffix($parameters[0], '\'').
				( ! empty($parameters[1]) ? ' FIRSTNAME '.presuffix($parameters[1], '\'') : '' ).
				( ! empty($parameters[2]) ? ' MIDDLENAME '.presuffix($parameters[2], '\'') : '' ).
				( ! empty($parameters[3]) ? ' LASTNAME '.presuffix($parameters[3], '\'') : '' );
				( ! empty($parameters[4]) ? ' GRANT ADMIN ROLE' : '');
	}
	
	public function drop($user = '')
	{
		return 'DROP USER '.$user;
	}
	
	public function alter($user = '', $parameters = array())
	{
		return 'ALTER USER '.
		        $user.
				' PASSWORD '.presuffix($password, '\'').
				( ! empty($parameters[1]) ? ' FIRSTNAME '.presuffix($parameters[1], '\'') : '' ).
				( ! empty($parameters[2]) ? ' MIDDLENAME '.presuffix($parameters[2], '\'') : '' ).
				( ! empty($parameters[3]) ? ' LASTNAME '.presuffix($parameters[3], '\'') : '' );
				( ! empty($parameters[4]) ? ' '.$parameters[4].' ADMIN ROLE' : '');
	}
}