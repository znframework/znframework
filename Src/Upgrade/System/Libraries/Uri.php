<?php
/************************************************************/
/*                        CLASS URI                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Uri
{
	
	private static function clean_path()
	{
		$path_info = clean_injection(request_uri());
		
		// ----------------------------------------------------------------------
		
		// URL YÖNLENDİRİLİYOR...
		
		$path_info = route_uri($path_info);
		
		
		if(current_lang())
			$path_info = str_replace(current_lang()."/","",$path_info);
		
		return $path_info;
	}
	
	public static function get($get = '', $index = 1, $while = false)
	{
		if(empty($get)) return false;
		if( ! is_string($get)) return false;
		if( ! (is_string($index) || is_numeric($index))) $index = 1;		
		if( ! (is_bool($while) || is_string($while) || is_numeric($while))) $while = false;
		
		$seg_ind = "";
		$seg_arr = self::segment_array();
		$seg_val = "";
		if( in_array($get, $seg_arr) )
		{ 
			$seg_val = array_search($get, $seg_arr); 
			
			if( ! empty($while) && ! is_numeric($index))
			{
				$get_val = array_search($get, $seg_arr);
				$index_val = array_search($index, $seg_arr);
				$return = "";
		
				for($i = $get_val; $i <= $index_val; $i++)
				{
					$return .= htmlentities($seg_arr[$i])."/";
				}
				
				return substr($return,0,-1);
			}
			
			if($index === "all")
			{
				$return = "";
				
				for($i=1; $i < count($seg_arr) - $seg_val; $i++)
				{
					$return .= htmlentities($seg_arr[$seg_val + $i])."/";
				}
				$return = substr($return,0,-1);
				
				return $return;
			}
			if( ! empty($while))
			{
				$return = "";
				for($i= 1; $i <= $index; $i++)
				{
					$return .= htmlentities($seg_arr[$seg_val + $i])."/";
				}
				$return = substr($return,0,-1);
				
				return $return;
			}
			if($index === "count")
			{
				return count($seg_arr) - 1 - $seg_val;
			}
			if(isset($seg_arr[$seg_val + $index])) 
			{
				return htmlentities($seg_arr[$seg_val + $index]); 
			}
			else 
			{
				return false;
			}
		
			
		} 
		else
		{ 
			return false; 
		}
	}
	
	public static function segment_array()
	{
		$segment_ex = explode("/", self::clean_path());
		return $segment_ex;	
	}
	
	public static function total_segments()
	{
		$segment_ex = explode("/", self::clean_path());
		
		$segment_ex = array_diff($segment_ex, array(""," "));
		$total_segments = count($segment_ex);
		
		return $total_segments;
	}
	
	public static function segment($seg = 1)
	{
		if( ! is_numeric($seg)) return false;
		$ok = $seg;
		if($seg == 0) return false;
		
		$segment = 0;
		
		if($seg < 1)
		{
			$segment = $seg;	
		}
		
		$part = '';
		
		$negative = 0;
		
		$request_uri = server('request_uri');
		
		$base_dir = substr(BASE_DIR,1,-1);
		
		if( isset($base_dir) ) 
		{
			$base_dir_ex = explode("/",$base_dir);
			
			$seg  += count($base_dir);
			
			$negative += count($base_dir);
		}
		if( index_status() ) { $seg += 1; $negative += 1; }
		if( current_lang() ) { $seg += 1; $negative += 1; }
	
		$part = explode('/', $request_uri);
		
		$count_part = count($part);
		
		if($segment < 0)
		{
			$seg = $count_part + ($segment);
		}
		if($negative == $seg) return false;
		
		if($ok > 0) $seg -= 1;
	
		if( isset( $part[$seg]) ) return clean_injection($part[$seg]); else false;
	}	
	
	public static function current_segment()
	{	
		$str = substr(server('current_path'),1,strlen(server('current_path'))-1);
		
		$str = explode("/", $str);
	
		if(count($str) > 1) 
		{
			return clean_injection($str[count($str) - 1]);	
		}
		return clean_injection($str[0]);	
	}
}