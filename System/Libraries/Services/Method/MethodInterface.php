<?php
interface MethodInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Post
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function post($name, $value);	
	
	//----------------------------------------------------------------------------------------------------
	// Get
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function get($name, $value);
	
	//----------------------------------------------------------------------------------------------------
	// Env
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function env($name, $value);
	
	//----------------------------------------------------------------------------------------------------
	// Server
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function server($name, $value);
	
	//----------------------------------------------------------------------------------------------------
	// Request
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function request($name, $value);
	
	//----------------------------------------------------------------------------------------------------
	// Files
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $filename
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function files($fileName, $type);
	
	//----------------------------------------------------------------------------------------------------
	// Delete
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	//
	//----------------------------------------------------------------------------------------------------
	public function delete($input, $name);
}