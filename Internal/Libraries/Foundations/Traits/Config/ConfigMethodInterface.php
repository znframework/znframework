<?php
namespace ZN\Foundations\Traits\Config;

interface ConfigMethodInterface
{
	//----------------------------------------------------------------------------------------------------
	// config()                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// @param  array  $settings: empty
	// @param  string $path    : empty
	// @return object 	        		     		 
	//          																				 
	//----------------------------------------------------------------------------------------------------
	public function config(Array $settings, String $path);
}