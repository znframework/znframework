<?php
namespace ZN\Database\Drivers\Traits;

trait UserTrait
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	public function option($option = '')
	{
		return false;
	}
	
	public function with($with = '')
	{
		return false;
	}
	
	public function adminRole($role = '')
	{
		return false;
	}
	
	public function firstName($name = '')
	{
		return false;
	}
	
	public function middleName($name = '')
	{
		return false;
	}
	
	public function lastName($name = '')
	{
		return false;
	}
	
	public function schema($name = '')
	{
		return false;
	}
	
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