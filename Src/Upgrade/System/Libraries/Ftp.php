<?php
/************************************************************/
/*                      CLASS  FTP                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Ftp
{
	private static $connect = NULL;
	private static $login = NULL;
	private static $error = NULL;
	
	public static function connect($con = array())
	{	
		if( ! is_array($con)) return false;
		
		
		$config = config::get('Ftp');
		
		$host = (isset($con['host'])) ? $con['host'] : $config['host'];
		$port = (isset($con['port'])) ? $con['port'] : $config['port'];
		$timeout = (isset($con['timeout'])) ? $con['timeout'] : $config['timeout'];
		$user = (isset($con['user'])) ? $con['user'] : $config['user'];
		$password = (isset($con['password'])) ? $con['password'] : $config['password'];
		$ssl = (isset($con['ssl_connect'])) ? $con['ssl_connect'] : $config['ssl_connect'];
	
		self::$connect =  	(($ssl === false)) 
							? @ftp_connect($host, $port, $timeout)
							: @ftp_ssl_connect($host, $port, $timeout);
							
		if(empty(self::$connect)) return false;
		
		self::$login = @ftp_login(self::$connect, $user, $password);
		
		if(empty(self::$login)) return false;
	}
	
	public static function close()
	{
		if( ! empty(self::$connect))
			@ftp_close(self::$connect);
		else 
			return false;
	}
	
	public static function create_folder($path = '')
	{
		if( ! is_string($path)) return false;	
		
		if(empty(self::$connect)) self::connect();
	
		if(@ftp_mkdir(self::$connect, $path))
			return true;
		else
		{
			self::$error =  get_message('Folder', 'folder_already_file_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false; 
		}
	}
	
	public static function delete_folder($path = '')
	{
		if( ! is_string($path)) return false;	
		
		if(empty(self::$connect)) self::connect();
	
		if(@ftp_rmdir(self::$connect, $path))
			return true;
		else
		{
			self::$error = get_message('Folder', 'folder_not_found_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
		}
	
	}
		
	public static function change_folder($path = '')
	{
		if( ! is_string($path)) return false;	
		
		if(empty(self::$connect)) self::connect();
	
		if(@ftp_chdir(self::$connect, $path))
			return true;
		else
		{
			self::$error = get_message('Folder', 'folder_change_folder_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
		}
	}
	
	public static function rename($oldname = '', $newname = '')
	{
		if( ! (is_string($oldname) || is_string($newname))) return false;	
		
		if(empty(self::$connect)) self::connect();
	
		if(@ftp_rename(self::$connect, $oldname, $newname))
			return true;
		else
		{
			self::$error = get_message('Folder', 'folder_change_folder_name_error', $oldname);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
		}
	}
	
	public static function delete_file($path = '')
	{
		if( ! is_string($path)) return false;
		
		if(empty(self::$connect)) self::connect();
	
		if(@ftp_delete(self::$connect, $path))
			return true;
		else
		{
			self::$error = get_message('File', 'file_not_found_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
		}
	}
	
	public static function upload($local_path = '', $remote_path = '', $type = 'ascii')
	{
		if( ! (is_string($local_path) || is_string($remote_path))) return false;
		
		if( ! is_string($type)) $type = 'ascii';	
		
		if(empty(self::$connect)) self::connect();
	
		if($type === 'ascii')
			$mode = FTP_ASCII;
		else
			$mode = FTP_BINARY;
			
		if(@ftp_put(self::$connect, $local_path, $remote_path, $mode))
			return true;
		else
		{
			self::$error = get_message('File', 'file_remote_upload_error', $local_path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
		}
	}
	
	public static function download($remote_path = '', $local_path = '', $type = 'ascii')
	{
		if( ! (is_string($local_path) || is_string($remote_path))) return false;
		
		if( ! is_string($type)) $type = 'ascii';	
		
		if(empty(self::$connect)) self::connect();
	
		if($type === 'ascii')
			$mode = FTP_ASCII;
		else
			$mode = FTP_BINARY;
			
		if(@ftp_get(self::$connect, $local_path, $remote_path, $mode))
			return true;
		else
		{
			self::$error = get_message('File', 'file_remote_download_error', $local_path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
		}
	}
	
	public static function permission($path = '', $type = 0755)
	{
		if( ! is_string($path)) return false;	
		
		if( ! is_numeric($type)) $type = 0755;
		
		if(empty(self::$connect)) self::connect();
	
		if(@ftp_chmod(self::$connect, $type, $path))
			return true;
		else 
			return false;
	}
	
	public static function files($path = '', $extension = '')
	{
		if( ! is_string($path)) return false;	
		
		if(empty(self::$connect)) self::connect();
		
		$list = @ftp_nlist(self::$connect, $path);
	
		foreach($list as $file)
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
		
		if( ! empty($files))
			return $files;
		else
			return false;
	}
	
	public static function file_size($path = '', $type = 'b')
	{
		if( ! is_string($path)) return false;	
		
		if( ! is_string($type)) $type = 'b';	
		
		if(empty(self::$connect)) self::connect();
	
		$size = 0;
		
		$extension = extension($path);
		
		if( ! empty($extension))
		{
			$size = @ftp_size(self::$connect, $path);
		}
		else
		{
			import::library("Folder");
			if(self::files($path))
			{
				foreach(self::files($path) as $val)
				{	
					$size += @ftp_size(self::$connect, $path."/".$val);	
				}
				$size += @ftp_size(self::$connect, $path);
			}
			else
			{
				$size += @ftp_size(self::$connect, $path);
			}	
		}
		
		if($type === "b")return  $size;
		if($type === "kb")return round($size / 1024, 2);
		if($type === "mb")return round($size / (1024 * 1024), 2);
		if($type === "gb")return round($size / (1024 * 1024 * 1024), 2);
	}
	
	public static function error()
	{
		if(isset(self::$error))
			return self::$error;
		else
			return false;
	}
}