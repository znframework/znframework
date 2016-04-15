<?php
namespace Postgre;

trait UserTrait
{
	use \Driver\UserTrait;
	
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
	
	public function create($user = '', $parameters = array())
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
	
	public function alter($user = '', $parameters = array())
	{
		return 'ALTER USER '.
		        $user.
				( ! empty($parameters[0]) ? ' '.$parameters[0] : '' ).
				( ! empty($parameters[1]) ? ' '.$parameters[1] : '' );
	}
}