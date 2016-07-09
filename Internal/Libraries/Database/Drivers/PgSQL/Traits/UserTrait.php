<?php
namespace ZN\Database\Drivers\PgSQL\Traits;

use ZN\Database\Drivers\Traits\UserTrait as CommonUserTrait;

trait UserTrait
{
	use CommonUserTrait;
	
	protected $postgreQuoteOptions = array
	(
		'PASSWORD',
		'VALID UNTIL'
	);
	
	public function name($name = '')
	{
		return $name;
	}
	
	public function with($with = 'WITH')
	{
		return $with;
	}
	
	public function option($option = '', $value = '')
	{
		if( ! empty($this->postgreQuoteOptions[strtoupper($option)]) )
		{
			$value = presuffix($value, '\'');	
		}
		
		return $option.' '.$value;
	}
	
	public function create($user = '', $parameters = [])
	{
		return 'CREATE USER '.
		        $user.
				( ! empty($parameters[0]) ? ' '.$parameters[0] : '' ).
				( ! empty($parameters[1]) ? ' '.$parameters[1] : '' );
	}
	
	public function drop($user = '')
	{
		return 'DROP USER '.$user;
	}
	
	public function alter($user = '', $parameters = [])
	{
		return 'ALTER USER '.
		        $user.
				( ! empty($parameters[0]) ? ' '.$parameters[0] : '' ).
				( ! empty($parameters[1]) ? ' '.$parameters[1] : '' );
	}
}