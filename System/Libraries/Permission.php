<?php 
/************************************************************/
/*                       CLASS PERMISSION                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Perm
{
	private static $permission = array();
	private static $result;
	
	public static function process($role_id = '', $process = '', $object = '')
	{
		if( ! is_numeric($role_id)) return false;
		if( ! is_string($process)) $process = '';
		if( ! is_string($object)) $object = '';
		
		self::$permission = config::get('Permission','process');
		
		if(isset(self::$permission[$role_id])) 
			$rules = self::$permission[$role_id]; 
		else
			return false;
		
		$current_url = $process;
		
		switch($rules)
		{
			case 'all'	: return $object;  break;
			case 'any'	: return false; break;	
		}
		
		if(strpos($rules,"|") > -1) // Birden fazla sayfa var ise..........
		{
			
			$pages = explode("|", $rules);
		
			foreach($pages as $page)
			{
				$page = trim($page);
			
				if($page[0] == "!") $rule = substr(trim($page),1); else $rule = trim($page);
				
				if($pages[0] == "perm=>")
				{
					if(strpos($current_url, $rule) > -1)
					{
						 return $object;
					}
					else
					{
						 self::$result = false;
					}
				}
				else
				{
					
					if(strpos($current_url, $rule) > -1)
					{					
						 return false;
					}
					else
					{
						 self::$result = $object;
					}
				}
			}
			
			return self::$result;
		}
		else
		{
			
			if($rules[0] == "!") $page = substr(trim($rules),1); else $page = trim($rules);
			if(strpos($current_url, $page) > -1)
			{
				if($rules[0] != "!") return $object; else return false;			
			}
			else
			{
				return $object;	
			}
		}

	}
	
	public static function page($role_id = '6')
	{
		if( ! is_numeric($role_id)) return false;
		
		self::$permission = config::get('Permission','page');
		
		if(isset(self::$permission[$role_id])) 
			$rules = self::$permission[$role_id]; 
		else
			return false;

		$current_url = server('current_path');
		
		switch($rules)
		{
			case 'all'	: return true;  break;
			case 'any'	: return false; break;	
		}
		
		if(strpos($rules,"|")) // Birden fazla sayfa var ise..........
		{
			$pages = explode("|", $rules);
		
			foreach($pages as $page)
			{
				$page = trim($page);
			
				if(@$page[0] == "!") $rule = substr(trim($page),1); else $rule = trim($page);
				
				if($pages[0] == "perm=>")
				{
					if(strpos($current_url, $rule) > -1)
					{
						 return true;
					}
					else
					{
						 self::$result = false;
					}
				}
				else
				{
					
					if(@strpos($current_url, $rule) > -1)
					{					
						 return false;
					}
					else
					{
						 self::$result = true;
					}
				}
			}
			
			return self::$result;
		}
		else
		{
			
			if($rules[0] == "!") $page = substr(trim($rules),1); else $page = trim($rules);
			if(strpos($current_url, $page) > -1)
			{
				if($rules[0] != "!") return true; else return false;			
			}
			else
			{
				return true;	
			}
		}
		
	
	}	
}