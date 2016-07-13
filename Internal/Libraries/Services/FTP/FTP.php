<?php
namespace ZN\Services;

class InternalFTP implements FTPInterface
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
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Services:ftp';
	
	//----------------------------------------------------------------------------------------------------
	// Protected $connect
	//----------------------------------------------------------------------------------------------------
	// 
	// @const resource
	//
	//----------------------------------------------------------------------------------------------------
	protected $connect = NULL;
	
	//----------------------------------------------------------------------------------------------------
	// Protected $login
	//----------------------------------------------------------------------------------------------------
	// 
	// @const resource
	//
	//----------------------------------------------------------------------------------------------------
	protected $login = NULL;
	
	//----------------------------------------------------------------------------------------------------
	// __construct()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $config: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct($config = [])
	{
		$this->config($config);
		$this->connect();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Call Undefined Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// connect()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $config: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function connect($config = [])
	{	
		if( ! is_array($config) )
		{
			return \Errors::set('Error', 'arrayParameter', 'config');
		}
		
		if( ! empty($config) )
		{
			$this->config($config);	
		}
		
		// Config/Ftp.php dosyasından ftp ayarları alınıyor.
		$config = $this->config;
	
		// ----------------------------------------------------------------------------
		// FTP BAĞLANTI AYARLARI YAPILANDIRILIYOR
		// ----------------------------------------------------------------------------
		$host     = $config['host'];			
		$port     = $config['port'];		
		$timeout  = $config['timeout'];		
		$user     = $config['user'];			
		$password = $config['password'];		
		$ssl 	  = $config['sslConnect'];	
		// ----------------------------------------------------------------------------
	
		// Bağlantı türü ayarına göre ssl veya normal
		// bağlatı yapılıp yapılmayacağı belirlenir.
		$this->connect =  	( $ssl === false ) 
							? @ftp_connect($host, $port, $timeout)
							: @ftp_ssl_connect($host, $port, $timeout);
							
		if( empty($this->connect) ) 
		{
			return \Errors::set('Error', 'emptyVariable', '@this->connect');
		}
		
		$this->login = @ftp_login($this->connect, $user, $password);
		
		if( empty($this->login) )
		{
			return false;
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// close()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------	
	public function close()
	{
		if( ! empty($this->connect) )
		{
			@ftp_close($this->connect);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// createFolder()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function createFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'path');	
		}
		
		if( @ftp_mkdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Errors::set('Folder', 'alreadyFileError', $path);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// deleteFolder()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function deleteFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'path');	
		}
		
		if( @ftp_rmdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Errors::set('Folder', 'notFoundError', $path);	
		}
	
	}
	
	//----------------------------------------------------------------------------------------------------
	// changeFolder()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function changeFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'path');
		}
	
		if( @ftp_chdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Errors::set('Folder', 'changeFolderError', $path);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// rename()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $oldName: empty
	// @param string $newName: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function rename($oldName = '', $newName = '')
	{
		if( ! is_string($oldName) || ! is_string($newName) ) 
		{
			\Errors::set('Error', 'stringParameter', 'oldName');
			\Errors::set('Error', 'stringParameter', 'newName');
			
			return false;	
		}
		
		if( @ftp_rename($this->connect, $oldName, $newName) )
		{
			return true;
		}
		else
		{
			return \Errors::set('Folder', 'changeFolderNameError', $oldName);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// deleteFile()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function deleteFile($path = '')
	{
		if( ! is_string($path) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'path');
		}
		
		if( @ftp_delete($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Errors::set('File', 'notFoundError', $path);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// upload()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $localPath : empty
	// @param string $remotePath: empty
	// @param string $type      : binary, ascii
	//
	//----------------------------------------------------------------------------------------------------	
	public function upload($localPath = '', $remotePath = '', $type = 'ascii')
	{
		if( ! is_string($localPath) || ! is_string($remotePath) ) 
		{
			\Errors::set('Error', 'stringParameter', 'localPath');
			\Errors::set('Error', 'stringParameter', 'remotePath');
			
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'ascii';	
		}
		
		if( @ftp_put($this->connect, $remotePath, $localPath, \Convert::toConstant($type, 'FTP_')) )
		{
			return true;
		}
		else
		{
			return \Errors::set('File', 'remoteUploadError', $localPath);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// dowload()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $remotePath: empty
	// @param string $localPath : empty
	// @param string $type      : binary, ascii
	//
	//----------------------------------------------------------------------------------------------------
	public function download($remotePath = '', $localPath = '', $type = 'ascii')
	{
		if( ! is_string($localPath) || ! is_string($remotePath) ) 
		{
			\Errors::set('Error', 'stringParameter', 'remotePath');
			\Errors::set('Error', 'stringParameter', 'localPath');
			
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'ascii';	
		}
		
		if( @ftp_get($this->connect, $localPath, $remotePath, \Convert::toConstant($type, 'FTP_')) )
		{
			return true;
		}
		else
		{
			return \Errors::set('File', 'remoteDownloadError', $localPath);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// permission()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	// @param int $type   : 0755
	//
	//----------------------------------------------------------------------------------------------------
	public function permission($path = '', $type = 0755)
	{
		if( ! is_string($path) )
		{
			return \Errors::set('Error', 'stringParameter', 'path');		
		}
		
		if( ! is_numeric($type) )
		{
			$type = 0755;
		}
		
		if( @ftp_chmod($this->connect, $type, $path) )
		{
			return true;
		}
		else
		{ 
			return \Errors::set('Error', 'emptyVariable', '@this->connect');	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// files()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path     : empty
	// @param string $extension: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function files($path = '', $extension = '')
	{
		if( ! is_string($path) )
		{
			return \Errors::set('Error', 'stringParameter', 'path');		
		}

		$list = @ftp_nlist($this->connect, $path);
	
		if( ! empty($list) ) foreach( $list as $file )
		{
			if( $file !== '.' && $file !== '..' )
			{				
				if( ! empty($extension) && $extension !== 'dir' )
				{
					if( extension($file) === $extension )
					{
						$files[] = $file;	
					}
				}
				else
				{
					if( $extension === 'dir' )
					{
						$extens = extension($file);
						
						if( empty($extens) )
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
		
		if( ! empty($files) )
		{
			return $files;
		}
		else
		{
			return \Errors::set('Error', 'emptyVariable', '@files');	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// fileSize()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path   : empty
	// @param string $type   : b, kb, mb, gb
	// @param int    $decimal: 2
	//
	//----------------------------------------------------------------------------------------------------
	public function fileSize($path = '', $type = 'b', $decimal = 2)
	{
		if( ! is_string($path) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'path');		
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'b';	
		}
		
		$size = 0;
		
		$extension = extension($path);
		
		if( ! empty($extension) )
		{
			$size = @ftp_size($this->connect, $path);
		}
		else
		{
			if( $this->files($path) )
			{
				foreach($this->files($path) as $val)
				{	
					$size += @ftp_size($this->connect, $path."/".$val);	
				}
				$size += @ftp_size($this->connect, $path);
			}
			else
			{
				$size += @ftp_size($this->connect, $path);
			}	
		}
		
		if( $type === "b" ) 
		{
			return  $size;
		}
		if( $type === "kb" )
		{
			return round($size / 1024, $decimal);
		}
		if( $type === "mb" )
		{
			return round($size / (1024 * 1024), $decimal);
		}
		if( $type === "gb" )
		{
			return round($size / (1024 * 1024 * 1024), $decimal);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// __destruct()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function __destruct()
	{
		$this->close();	
	}
}