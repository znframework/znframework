<?php
function dbcommon()
{	
	$config = config::get('Database');
	
	if(isset($config['driver'])) 
	{			
		$driver = ucwords($config['driver']);
		
		if(strpos($config['driver'], '->'))
		{
			$subdrivers = explode('->', $config['driver']);
			$driver  = $subdrivers[0];
		}
		
		$driver_path = DRIVES_DIR.$driver.'.php';
		
		if( is_file($driver_path) )			
			require_once($driver_path);
		else
		{
			die(get_message('Database', 'db_driver_error', $driver));
		}
		$driver = $driver.'Driver';
		
		$db = new $driver;
		
		return $db;
	}	
}