<?php
namespace ZN\FileSystem;

class InternalFTP extends \Requirements implements FTPInterface
{
	//----------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// const config
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const config  = 'Services:ftp';
	
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
	public function __construct()
	{
		parent::__construct();
		
		$this->connect();
	}
	
	//----------------------------------------------------------------------------------------------------
	// connect()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $config: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function connect(Array $config = []) : InternalFTP
	{	
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
			return \Exceptions::throws('Error', 'emptyVariable', 'Connect');
		}
		
		$this->login = ftp_login($this->connect, $user, $password);
		
		if( empty($this->login) )
		{
			return \Exceptions::throws('Error', 'emptyVariable', 'Login');
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
	public function close() : Bool
	{
		if( ! empty($this->connect) )
		{
			return ftp_close($this->connect);
		}

		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// createFolder()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function createFolder(String $path) : Bool
	{
		if( ftp_mkdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('FileSystem', 'folder:alreadyFileError', $path);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// deleteFolder()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function deleteFolder(String $path) : Bool
	{
		if( ftp_rmdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('FileSystem', 'folder:notFoundError', $path);	
		}
	
	}
	
	//----------------------------------------------------------------------------------------------------
	// changeFolder()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function changeFolder(String $path) : Bool
	{
		if( ftp_chdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('FileSystem', 'folder:changeFolderError', $path);
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
	public function rename(String $oldName, String $newName) : Bool
	{
		if( ftp_rename($this->connect, $oldName, $newName) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('FileSystem', 'folder:changeFolderNameError', $oldName);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// deleteFile()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function deleteFile(String $path) : Bool
	{
		if( ftp_delete($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('FileSystem', 'file:notFoundError', $path);	
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
	public function upload(String $localPath, String $remotePath, String $type = 'ascii') : Bool
	{
		if( ftp_put($this->connect, $remotePath, $localPath, \Converter::toConstant($type, 'FTP_')) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('FileSystem', 'file:remoteUploadError', $localPath);	
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
	public function download(String $remotePath, String $localPath, String $type = 'ascii') : Bool
	{
		if( ftp_get($this->connect, $localPath, $remotePath, \Converter::toConstant($type, 'FTP_')) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('FileSystem', 'file:remoteDownloadError', $localPath);
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
	public function permission(String $path, Int $type = 0755) : Bool
	{
		if( ftp_chmod($this->connect, $type, $path) )
		{
			return true;
		}
		else
		{ 
			return \Exceptions::throws('Error', 'emptyVariable', '@this->connect');	
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
	public function files(String $path, String $extension = NULL) : Array
	{
		$list = ftp_nlist($this->connect, $path);
	
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
			$this->error = lang('Error', 'emptyVariable', '@files');	

			return [];
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
	public function fileSize(String $path, String $type = 'b', Int $decimal = 2) : Float
	{
		$size = 0;
		
		$extension = extension($path);
		
		if( ! empty($extension) )
		{
			$size = ftp_size($this->connect, $path);
		}
		else
		{
			if( $this->files($path) )
			{
				foreach( $this->files($path) as $val )
				{	
					$size += ftp_size($this->connect, $path."/".$val);	
				}

				$size += ftp_size($this->connect, $path);
			}
			else
			{
				$size += ftp_size($this->connect, $path);
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