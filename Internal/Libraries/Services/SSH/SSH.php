<?php
namespace ZN\Services;

class InternalSSH extends \Requirements implements SSHInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright ConfigController(c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Services:ssh';
	
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
	// Protected $stream
	//----------------------------------------------------------------------------------------------------
	// 
	// @const resource
	//
	//----------------------------------------------------------------------------------------------------
	protected $stream = NULL;
	
	//----------------------------------------------------------------------------------------------------
	// Protected $command
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	protected $command = '';
	
	//----------------------------------------------------------------------------------------------------
	// __construct()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array $config: empty
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct($config = [])
	{
		\Support::func('ssh2_connect', 'SSH(Secure Shell)');
		
		parent::__construct($config);

		$this->connect();
	}

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
			\Exceptions::throws('Error', 'arrayParameter', 'config');
			
			return $this;
		}
		
		if( ! empty($config) )
		{
			$this->config($config);	
		}
		
		// Config/Ftp.php dosyasından ftp ayarları alınıyor.
		$config = $this->config;
	
		// ----------------------------------------------------------------------------
		// SSH BAĞLANTI AYARLARI YAPILANDIRILIYOR
		// ----------------------------------------------------------------------------
		$host      = $config['host'];			
		$port      = $config['port'];	
		$user      = $config['user'];			
		$password  = $config['password'];		
		$methods   = $config['methods'];		
		$callbacks = $config['callbacks'];		
		// ----------------------------------------------------------------------------
	
		// Bağlantı türü ayarına göre ssl veya normal
		// bağlatı yapılıp yapılmayacağı belirlenir.
		if(  ! empty($methods) && ! empty($callbacks))
		{
			$this->connect = ssh2_connect($host, $port, $methods, $callbacks);			
		}
		elseif( ! empty($methods) )
		{
			$this->connect = ssh2_connect($host, $port, $methods);	
		}
		else
		{
			$this->connect = ssh2_connect($host, $port);	
		}
		
		if( empty($this->connect) ) 
		{
			\Exceptions::throws('Error', 'emptyVariable', '@this->connect');
			
			return $this;
		}
		
		if( ! empty($user) )
		{
			$this->login = ssh2_auth_password($this->connect, $user, $password);
		}
		
		if( empty($this->login) )
		{
			\Exceptions::throws('Error', 'emptyVariable', '@this->login');
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
			ssh2_exec($this->connect, 'exit');
			$this->connect = NULL;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// command()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------	
	public function command($command = '')
	{
		$this->command .= $command.' ';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// run()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------	
	public function run($command = '')
	{
		if( ! empty($this->connect) )
		{
			if( ! empty($this->command) )
			{
				$command = rtrim($this->command);
			}
			
			$this->_defaultVariables();
			
			$this->stream = ssh2_exec($this->connect, $command);
			
			return $this->stream;
		}
		
		return false;
	}
	
	//----------------------------------------------------------------------------------------------------
	// output()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function output($length = 4096)
	{
		$stream = $this->stream;
		
		stream_set_blocking($stream, true);
		
		$data = "";
		
		while( $buffer = fread($stream, $length) )
		{
			$data .= $buffer;
		}
		
		fclose($stream);	
		
		return $data;
	}
	
	//----------------------------------------------------------------------------------------------------
	// upload()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $localPath : empty
	// @param string $remotePath: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function upload($localPath = '', $remotePath = '')
	{
		if( ! is_string($localPath) || ! is_string($remotePath) ) 
		{
			\Exceptions::throws('Error', 'stringParameter', 'localPath');
			\Exceptions::throws('Error', 'stringParameter', 'remotePath');
			
			return false;
		}
		
		if( @ssh2_scp_send($this->connect, $localPath, $remotePath) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('File', 'remoteUploadError', $localPath);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// dowload()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $remotePath: empty
	// @param string $localPath : empty
	//
	//----------------------------------------------------------------------------------------------------
	public function download($remotePath = '', $localPath = '')
	{
		if( ! is_string($localPath) || ! is_string($remotePath) ) 
		{
			\Exceptions::throws('Error', 'stringParameter', 'remotePath');
			\Exceptions::throws('Error', 'stringParameter', 'localPath');
			
			return false;
		}
		
		if( @ssh2_scp_recv($this->connect, $remotePath, $localPath) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('File', 'remoteDownloadError', $localPath);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// createFolder()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $path: empty
	//
	//----------------------------------------------------------------------------------------------------	
	public function createFolder($path = '', $mode = 0777, $recursive = true)
	{
		if( ! is_string($path) ) 
		{
			return \Exceptions::throws('Error', 'stringParameter', 'path');	
		}
		
		if( @ssh2_sftp_mkdir($this->connect, $path, $mode, $recursive) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('Folder', 'alreadyFileError', $path);
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
			return \Exceptions::throws('Error', 'stringParameter', 'path');	
		}
		
		if( @ssh2_sftp_rmdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('Folder', 'notFoundError', $path);	
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
			\Exceptions::throws('Error', 'stringParameter', 'oldName');
			\Exceptions::throws('Error', 'stringParameter', 'newName');
			
			return false;	
		}
		
		if( @ssh2_sftp_rename($this->connect, $oldName, $newName) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('Folder', 'changeFolderNameError', $oldName);	
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
			return \Exceptions::throws('Error', 'stringParameter', 'path');
		}
		
		if( @ssh2_sftp_unlink($this->connect, $path) )
		{
			return true;
		}
		else
		{
			return \Exceptions::throws('File', 'notFoundError', $path);	
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
			return \Exceptions::throws('Error', 'stringParameter', 'path');		
		}
		
		if( ! is_numeric($type) )
		{
			$type = 0755;
		}
		
		if( @ssh2_sftp_chmod($this->connect, $path, $type) )
		{
			return true;
		}
		else
		{ 
			return \Exceptions::throws('Error', 'emptyVariable', '@this->connect');	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected _defaultVariables()
	//----------------------------------------------------------------------------------------------------
	// 
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function _defaultVariables()
	{
		$this->command = '';	
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