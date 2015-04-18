<?php
/************************************************************/
/*                     CLASS  FILE                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class File
{
	private static $error;
	
	public static function read($file = '')
	{
		if( ! is_string($file)) return false;
		if(file_exists($file))
		{
			$file_open = fopen($file, 'r');	
			$file_read = fread($file_open, filesize($file));
			fclose($file_open);
			return $file_read;
		}
		else
		{
			self::$error = get_message('File', 'file_not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;		
		}
	}
	
	
	public static function write($file = '', $data = '')
	{
		if( ! is_string($file)) return false;
		if( ! (is_string($data) || is_numeric($data))) $data = '';
		
		if( ! file_exists($file))
		{
			self::$error = get_message('File', 'file_not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;	
		}

		$file_open 	= fopen($file, 'w');
		$file_write = fwrite($file_open, $data);
		fclose($file_open);
	}	
	
	
	public static function contents($path = '')
	{
		if( ! is_string($path)) return false;
		
		if( ! file_exists($path))
		{
			self::$error = get_message('File', 'file_not_found_error', $path);
			report('Error', self::$error, 'FileLibrary');
			return false;	
		}
		return file_get_contents($path);
	}
	
	
	public static function find($file = '', $str = '')
	{
		if( ! is_string($file)) return false;
		if( ! (is_string($data) || is_numeric($data))) $data = '';
		
		if( ! file_exists($file))
		{
			self::$error = get_message('File', 'file_not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;	
		}
		
		$index = strpos(file_get_contents($file),$str);
		
		$contents = self::contents($file);
	
		$object = (object)array 
		(
			'index' => $index,
			'contents' => $contents
		);	
		
		return $object;	
	}
	
	
	public static function create($name = '')
	{
		if( ! is_string($name)) return false;
		
		if( ! file_exists($name)) 
			touch($name);
		else
		{
			self::$error = get_message('File', 'file_already_file_error', $name);
			report('Error', self::$error, 'FileLibrary');
			return false;	
		}
	}
	
	
	public static function delete($name = '')
	{
		if( ! is_string($name)) return false;
		
		if( ! file_exists($name)) 
		{
			self::$error = get_message('File', 'file_not_found_error', $name);
			report('Error', self::$error, 'FileLibrary');
			return false;	
		}
		else 
			unlink($name);	
	}
	
	
	public static function append($file = '', $data = '')
	{
		if( ! is_string($file)) return false;
		if(is_array($data)) $data = '';
		
		if( ! file_exists($file))	
		{
			self::$error = get_message('File', 'file_not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;
		}
		$file_open 	= fopen($file, 'a');
		$file_write = fwrite($file_open, $data);
		fclose($file_open);
	}	

	
	public static function permission($name = '', $permission = 0755)
	{
		if( ! is_string($name)) return false;
		if( ! is_numeric($permission)) $permission = 0755;
		if( ! file_exists($name))
		{
			self::$error = get_message('File', 'file_not_found_error', $name);
			report('Error', self::$error, 'FileLibrary');
			return false;
		}
		chmod($name, $permission);
	}
	
	
	public static function create_date($file = '', $type = "d.m.Y G:i:s")
	{
		if( ! is_string($file)) return false;
		if( ! is_string($type)) $type = "d.m.Y G:i:s";
		if( ! file_exists($file))
		{
			self::$error = get_message('File', 'file_not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;
		}
		$date = filectime($file); 
		return date($type, $date);
	}
	
	
	public static function change_date($file = '', $type = "d.m.Y G:i:s")
	{
		if( ! is_string($file)) return false;
		if( ! is_string($type)) $type = "d.m.Y G:i:s";
		if( ! file_exists($file))
		{
			self::$error = get_message('File', 'file_not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;
		}
		$date = filemtime($file); 
		return date($type, $date);
	}
	
	
	public static function size($file = '', $type = "b")
	{
		if( ! is_string($file)) return false;
		if( ! is_string($type)) $type = "b";
		if( ! file_exists($file))
		{
			self::$error = get_message('File', 'file_not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;
		}
		$size = 0;
	
		$extension = extension($file);
		
		if( ! empty($extension))
		{
			$size += filesize($file);
		}
		else
		{
			import::library("Folder");
			if(folder::files($file))
			{
				foreach(folder::files($file) as $val)
				{	
					$size += file::size($file."/".$val);	
				}
				$size += filesize($file);
			}
			else
			{
				$size += filesize($file);
			}	
		}
		
		if($type === "b")return  $size;
		if($type === "kb")return round($size / 1024, 2);
		if($type === "mb")return round($size / (1024 * 1024), 2);
		if($type === "gb")return round($size / (1024 * 1024 * 1024), 2);
	}
	
	
	public static function zip_extract($zip = '', $target = '')
	{
		if( ! is_string($zip)) return false;
		if( ! is_string($target)) $target = '';
		if( ! file_exists($zip))
		{
			self::$error = get_message('File', 'file_not_found_error', $zip);
			report('Error', self::$error, 'FileLibrary');
			return false;
		}
		$zip = zip_open($zip);
		
		while($zip_content = zip_read($zip))
		{
			$zip_file = zip_entry_name($zip_content);
			
			if(strpos($zip_file, '.'))
			{
				$target_path = suffix($target) . $zip_file;
				touch($target_path);
				$new_file = fopen($target_path, 'w+');
				fwrite($new_file, zip_entry_read($zip_content));
				fclose($new_file);
			}
			else
			{
				@mkdir(suffix($target) . $zip_file);
			}
		}
	}
	
	public static function error()
	{
		if(isset(self::$error))
			return self::$error;
		else
			return false;
	}
}