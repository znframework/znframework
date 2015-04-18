<?php
/************************************************************/
/*                     CLASS  FOLDER                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Folder
{
	
	private static $error;
	
	public static function create($name = '', $permission = 0755)
	{		
		if( ! is_string($name)) $name = '';
		if( ! is_numeric($name)) $permission = 0755;
		
		if( ! file_exists($name) && ! is_file($name)) 
			mkdir($name,$permission);
		else
		{
			self::$error =  get_message('Folder', 'folder_already_file_error', $name);
			report('Error', self::$error, 'FolderLibrary');
			//return false; 
		}
	}
	
	public static function delete_empty($name = '')
	{
		if( ! is_string($name)) $name = '';
		
		if(file_exists($name) && is_dir($name)) 
			rmdir($name);
		else
		{
			self::$error = get_message('Folder', 'folder_not_found_error', $name);
			report('Error', self::$error, 'FolderLibrary');
			//return false;	
		}
	}
	
	public static function copy($source = '', $target = '')
	{
		if( ! is_string($source)) return false;
		if( ! is_string($target)) return false;
		
		if( ! file_exists($source))
		{
			self::$error = get_message('Folder', 'folder_not_found_error', $source);
			report('Error', self::$error, 'FolderLibrary');
			return false;	
		}
		
		if(extension($source) == "")
		{
			import::library("Folder");
			if(count(folder::files($source)) === 0)
			{
				@copy($source, $target);
			}
			else
			{
				if( ! is_dir($target) && ! file_exists($target) )
					folder::create($target);
					
				if(is_array(folder::files($source)))foreach(folder::files($source) as $val)
				{
					@copy($source."/".$val, $target."/".$val);
					folder::copy($source."/".$val, $target."/".$val);
				}
				
					
			}
			
		}
		else
		{
			@copy($source, $target);	
		}
	}
	
	public static function delete($name = '')
	{
		if( ! is_string($name)) return false;
		
		if( ! file_exists($name))
		{
			self::$error = get_message('Folder', 'folder_not_found_error', $name);
			report('Error', self::$error, 'FolderLibrary');
			return false;	
		}
		
		import::library("File");
		
		$extension = extension($name);
		
		if( ! empty($extension))
		{
			file::delete($name);	
		}
		else
		{
			if(count(self::files($name)) < 1)
			{
				self::delete_empty($name);
			}	
			else
			{
				
				if( ! empty($extension))
				{
					file::delete($name."/".$val);
				}
				else
				{
		
					for($i = 0; $i < count(self::files($name)); $i++)foreach(self::files($name) as $val)
					{					
						folder::delete($name."/".$val);
						echo $name."/".$val."<br><br>";
					}
				}
			}
			
			self::delete_empty($name);
		}
		
	}
	
	public static function files($path = '', $extension = '')
	{		
		if( ! is_string($path)) return false;	
		if( ! is_string($extension)) $extension = '';
		
		if(is_file($path))
		{
			self::$error = get_message('Folder', 'folder_folder_parameter_error', $path);
			report('Error', self::$error, 'FolderLibrary');
			return false;		
		}
		
		$files = array();
		
		if(empty($path)) $path = '.';
		
		if(is_dir($path))
		{	
			$dir = opendir($path);
			while($file = readdir($dir))
			{
		
				if($file !== '.' && $file !== '..')
				{
						
						if( ! empty($extension) && $extension !== 'dir')
						{
							if(extension($file) === $extension)
							{
							 $files[] = $file;	
							}
						}
						else
						{
							if($extension === 'dir')
							{
								$extens = extension($file);
								if(empty($extens))
								{
									$files[] = $file;	
								}
							}
							else
							{
								$files[] = $file;
							}
						}
				}
			}
			return $files;
		}
		else
		{
			return false;	
		}
		
	}	
	
	public static function all_files($pattern = "*")
	{
		if( ! is_string($pattern)) return false;	
		
		if(strstr($pattern, '/') != "" && strstr($pattern, '*') == "") $pattern .= "*";
		if(strstr($pattern, '/') == "" && strstr($pattern, '*') == "") $pattern .= "/*";
		
		return glob($pattern);
	}	
	
	public static function permission($name = '', $permission = 0755)
	{
		if( ! is_string($name)) return false;
		if( ! is_numeric($permission)) $permission = 0755;
		
		if( ! file_exists($name))
		{
			self::$error = get_message('Folder', 'folder_not_found_error', $name);
			report('Error', self::$error, 'FolderLibrary');
			return false;	
		}
		chmod($name, $permission);
	}
	
	public static function error()
	{
		if(isset(self::$error))
			return self::$error;
		else
			return false;
	}
}

