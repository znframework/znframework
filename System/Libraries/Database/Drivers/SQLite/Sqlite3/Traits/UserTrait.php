<?php
namespace Sqlite3;

trait UserTrait
{
	public function name($name = '')
	{
		return false;
	}
	
	public function password($password = '')
	{
		return false;
	}
	
	public function groups($groups = '')
	{
		return false;
	}
	
	public function members($members = '')
	{
		return false;
	}
	
	public function create($user = '', $password = '', $groups = '', $members = '')
	{
		return false;
	}
	
	public function drop($user)
	{
		return false;
	}
	
	public function alter($user = '', $password = '')
	{
		return false;
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