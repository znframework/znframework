<?php
namespace Cubrid;

trait UserTrait
{
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
	
	public function create($user = '', $password = '', $groups = '', $members = '')
	{
		return 'CREATE USER '.
		        $user.
				( ! empty($password) ? ' PASSWORD '.$password : '' ).
				( ! empty($groups)   ? ' GROUPS '.$groups     : '' ).
				( ! empty($members)  ? ' MEMBERS '.$members   : '' );
	}
	
	public function drop($user = '')
	{
		return 'DROP USER '.$user;
	}
	
	public function alter($user = '', $password = '')
	{
		return 'ALTER USER '.$user.( ! empty($password) ? ' PASSWORD '.$password : '' );
	}
	
	public function grant()
	{
		return false;	
	}
	
	public function revoke()
	{
		return false;	
	}
	
	public function setPassword()
	{
		return false;	
	}
	
	public function rename()
	{
		return false;	
	}
}