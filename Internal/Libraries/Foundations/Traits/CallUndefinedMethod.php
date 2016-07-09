<?php
namespace ZN\Foundations\Traits;

trait CallUndefinedMethodTrait
{
	//----------------------------------------------------------------------------------------------------
	// Call
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $method
	// @param  array  $param
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', str_ireplace(STATIC_ACCESS, '', __CLASS__)."::$method()"));
	}
}