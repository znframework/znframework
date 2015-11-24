<?php
class __USE_STATIC_ACCESS__FTP implements FTPInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Config Değişkeni
	 *  
	 * FTP ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	/* Connect Değişkeni
	 *  
	 * Bağlantı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $connect = NULL;
	
	/* Login Değişkeni
	 *  
	 * Giriş bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $login = NULL;
	
	public function __construct($config = array())
	{
		$this->config = Config::get('Ftp');	
		
		$this->connect($config);
	}
	
	use CallUndefinedMethodTrait;
	
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
	use ErrorControlTrait;
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Ftp bağlantısını gerçekleştirmek için kullanılır.    				      |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.		                                      |
	| 1. array var @con => Bağlantı parametrelerini içeren dizi parametresidir.	  			  |
	| Bu yöntem kullanılmazsa bağlantı Config/Ftp.php dosyasındaki ayarlara göre yapılacaktır.|
	| Bu nedenle kullanımı zorunlu değildir.         										  |
	|          																				  |
	| Örnek Kullanım: connect(array('host' => 'localhost', 'user' => 'zntr' ...));        	  |
	| 																			       		  |
	| Bağlantı Dizisi Parametreleri         												  |
	| 1.host         																		  |
	| 2.user         																		  |
	| 3.password         																	  |
	| 4.port = 21        																	  |
	| 5.timeout = 90         																  |
	| 6.ssl_connect = false         														  |
	|         																		          |
	******************************************************************************************/	
	public function connect($con = array())
	{	
		if( ! is_array($con) )
		{
			return Error::set(lang('Error', 'arrayParameter', 'con'));
		}
		
		// Config/Ftp.php dosyasından ftp ayarları alınıyor.
		$config = $this->config;
		
		// ----------------------------------------------------------------------------
		// FTP BAĞLANTI AYARLARI YAPILANDIRILIYOR
		// ----------------------------------------------------------------------------
		
		// Host Ayarları
		$host = 	( isset($con['host']) ) 
					? $con['host'] 
					: $config['host'];
		
		// Port Ayarları			
		$port =     ( isset($con['port']) ) 
					? $con['port'] 
					: $config['port'];
		
		// Timeout Ayarları			
		$timeout = 	( isset($con['timeout']) ) 
					? $con['timeout'] 
					: $config['timeout'];
		
		// User Ayarları			
		$user = 	( isset($con['user']) ) 
					? $con['user'] 
					: $config['user'];
			
		// Password Ayarları			
		$password = ( isset($con['password']) ) 
					? $con['password'] 
					: $config['password'];
		
		// Ssl Connect Ayarları			
		$ssl = 		( isset($con['sslConnect']) ) 
					? $con['sslConnect'] 
					: $config['sslConnect'];
		
		// ----------------------------------------------------------------------------
	
		// Bağlantı türü ayarına göre ssl veya normal
		// bağlatı yapılıp yapılmayacağı belirlenir.
		$this->connect =  	( $ssl === false ) 
							? @ftp_connect($host, $port, $timeout)
							: @ftp_ssl_connect($host, $port, $timeout);
							
		if( empty($this->connect) ) 
		{
			return Error::set(lang('Error', 'emptyVariable', '@this->connect'));
		}
		
		$this->login = @ftp_login($this->connect, $user, $password);
		
		if( empty($this->login) )
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* CLOSE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Ftp bağlantısını kapatmak için kullanılır.    				          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.		                                  |
	|          																				  |
	| Örnek Kullanım: close();        	  												      |
	|         																		          |
	******************************************************************************************/	
	public function close()
	{
		if( ! empty($this->connect) )
		{
			@ftp_close($this->connect);
		}
		else
		{ 
			return Error::set(lang('Error', 'emptyVariable', '@this->connect'));
		}
	}
	
	/******************************************************************************************
	* CREATE FOLDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Dizin oluşturmak için kullanılır.    				     			      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Oluşturulacak dizinin adı veya yolu.							  |
	| 2. string var @permission => Oluşturulacak dizinin yetki kodu							  |
	|          											  									  |
	| Örnek Kullanım: createFolder('dizin/yeniDizin');        						          |
	|          																				  |
	******************************************************************************************/
	public function createFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'path'));	
		}
		
		if( @ftp_mkdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			$this->error =  getMessage('Folder', 'alreadyFileError', $path);
			return Error::set($this->error);
		}
	}
	
	/******************************************************************************************
	* DELETE FOLDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: İçi boş dizini silmek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek boş dizinin adı veya yolu.							  |
	|          											  									  |
	| Örnek Kullanım: deleteFolder('dizin/yeniDizin');        					              |
	|          																				  |
	******************************************************************************************/
	public function deleteFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'path'));	
		}
		
		if( @ftp_rmdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			$this->error = getMessage('Folder', 'notFoundError', $path);
			return Error::set($this->error);	
		}
	
	}
	
	/******************************************************************************************
	* CHANGE FOLDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Çalışma dizini değiştirmek için kullanılır.    	 		     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Değiştirilecek çalışma dizininin adı veya yolu.				  |
	|          											  									  |
	| Örnek Kullanım: changeFolder('dizin/yeniDizin');        				         	      |
	|          																				  |
	******************************************************************************************/	
	public function changeFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'path'));
		}
	
		if( @ftp_chdir($this->connect, $path) )
		{
			return true;
		}
		else
		{
			$this->error = getMessage('Folder', 'changeFolderError', $path);
			return Error::set($this->error);
		}
	}
	
	/******************************************************************************************
	* RENAME                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizi veya dosyanın adını değiştirmek için kullanılır.    				  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @oldname => Dizinin eski ismi.							  				  |
	| 2. string var @newname => Dizinin yeni ismi.							  				  |
	|          											  									  |
	| Örnek Kullanım: rename('dizin/eskiIsim', 'dizin/yeniIsim');        				      |
	|          																				  |
	******************************************************************************************/
	public function rename($oldName = '', $newName = '')
	{
		if( ! is_string($oldName) || ! is_string($newName) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'oldName'));
			Error::set(lang('Error', 'stringParameter', 'newName'));
			
			return false;	
		}
		
		if( @ftp_rename($this->connect, $oldName, $newName) )
		{
			return true;
		}
		else
		{
			$this->error = getMessage('Folder', 'changeFolderNameError', $oldName);
			return Error::set($this->error);	
		}
	}
	
	/******************************************************************************************
	* DELETE  FILE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Dosya silmek için kullanılır.    	 			     			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek dosyanın adı veya yolu.							      |
	|          											  									  |
	| Örnek Kullanım: deleteFile('dizin/yeniDosya.txt');        			     	          |
	|          																				  |
	******************************************************************************************/
	public function deleteFile($path = '')
	{
		if( ! is_string($path) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'path'));
		}
		
		if( @ftp_delete($this->connect, $path) )
		{
			return true;
		}
		else
		{
			$this->error = getMessage('File', 'notFoundError', $path);
			return Error::set($this->error);	
		}
	}
	
	/******************************************************************************************
	* UPLOAD                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Sunucuya dosya yüklemek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @local_path => Yerelden sunucuya yüklenecek dosya yolu.					  |
	| 2. string var @remote_path => Dosyanın yükleneceği sunucudaki dizinin yolu              |
	| 3. string var @type => Veri aktarım tipi. Varsayılan:ascii. ascii veya binary           |
	|          											  									  |
	| Örnek Kullanım: upload('yerel/yeniDosya.txt', 'sunucu/dizin', 'binary');                |
	|          																				  |
	******************************************************************************************/
	public function upload($localPath = '', $remotePath = '', $type = 'ascii')
	{
		if( ! is_string($localPath) || ! is_string($remotePath) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'localPath'));
			Error::set(lang('Error', 'stringParameter', 'remotePath'));
			
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'ascii';	
		}
		
		if( $type === 'ascii' )
		{
			$mode = FTP_ASCII;
		}
		else
		{
			$mode = FTP_BINARY;
		}
		
		if( @ftp_put($this->connect, $localPath, $remotePath, $mode) )
		{
			return true;
		}
		else
		{
			$this->error = getMessage('File', 'remoteUploadError', $localPath);
			return Error::set($this->error);	
		}
	}
	
	/******************************************************************************************
	* DOWNLOAD                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Sunucudan dosya indirmek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @remote_path => Dosyanın indirileceği sunucudaki dosyanın yolu            |
	| 2. string var @local_path => Dosyanın indirileceği yereldeki dizin yolu.			      |
	| 3. string var @type => Veri aktarım tipi. Varsayılan:ascii. ascii veya binary           |
	|          											  									  |
	| Örnek Kullanım: download('sunucu/yeniDosya.txt', 'yerel/dizin', 'binary');              |
	|          																				  |
	******************************************************************************************/
	public function download($remotePath = '', $localPath = '', $type = 'ascii')
	{
		if( ! is_string($localPath) || ! is_string($remotePath) ) 
		{
			Error::set(lang('Error', 'stringParameter', 'remotePath'));
			Error::set(lang('Error', 'stringParameter', 'localPath'));
			
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'ascii';	
		}
	
		if( $type === 'ascii' )
		{
			$mode = FTP_ASCII;
		}
		else
		{
			$mode = FTP_BINARY;
		}
		
		if( @ftp_get($this->connect, $localPath, $remotePath, $mode) )
		{
			return true;
		}
		else
		{
			$this->error = getMessage('File', 'remoteDownloadError', $localPath);
			return Error::set($this->error);
		}
	}
	
	/******************************************************************************************
	* PERMISSION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosya ve dizin yetkilerini düzenlemek için kullanılır.		     	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Yetki verilecek dosyanın ismi veya yolu.						  |
	| 2. numeric var @name => Dosyaya verilecek yetki kodu. Varsayılan:0755  	     	      |
	|          																				  |
	| Örnek Kullanım: permission('dizin/dosya.txt', 0755);        							  |
	|          																				  |
	******************************************************************************************/
	public function permission($path = '', $type = 0755)
	{
		if( ! is_string($path) )
		{
			return Error::set(lang('Error', 'stringParameter', 'path'));		
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
			return Error::set(lang('Error', 'emptyVariable', '@this->connect'));	
		}
	}
	
	/******************************************************************************************
	* FILES	                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizin içindeki dosya ve dizin listesini almak için kullanılır.      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @path => Listesi alınacak dizinin adı veya yolu.						  |
	| 2. string var @extension => Listede hangi uzantılı dosyaların yer alacağıdır. Bu 		  |
	| parametre boş bırakılırsa tüm dosya ve dizinler listeye alınacaktır.         			  |
	|          											  									  |
	| Örnek Kullanım: $veri = files('dizin/', 'php'); // php uzantılı dosyaları listeler.     |
	| Örnek Kullanım: $veri = files('dizin/', 'dir'); // sadece dizinleri listeler.           |
	| Örnek Kullanım: $veri = files('dizin/'); // tüm dosya ve dizinleri listeler.            |
	|          																				  |
	******************************************************************************************/
	public function files($path = '', $extension = '')
	{
		if( ! is_string($path) )
		{
			return Error::set(lang('Error', 'stringParameter', 'path'));		
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
			return Error::set(lang('Error', 'emptyVariable', '@files'));	
		}
	}
	
	/******************************************************************************************
	* FILE SIZE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın boyutunu öğrenmek için kullanılır.							  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Boyutu öğrenilecek dosyanın yolu.			  		              |
	| 2. string var @type => Boyutun ne şekilde gösterileceğidir.         	                  |
	|          																				  |
	| Örnek Kullanım: fileSize('dizin/dosya.txt', 'b');        						      |
	|          																				  |
	| Type parametresi için kullanılabilir değerler        									  |
	| 1. b => byte cinsinden         														  |
	| 2. kb => kilo byte cinsinden değer döndürür.       									  |
	| 3. mb => mega byte cinsinden değer döndürür.          								  |
	| 4. gb => giga byte cinsinden değer döndürür.          								  |
	|          																				  |
	******************************************************************************************/
	public function fileSize($path = '', $type = 'b', $decimal = 2)
	{
		if( ! is_string($path) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'path'));		
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
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Ftp işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.  |
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		if( isset($this->error) )
		{
			Error::set($this->error);	
			return $this->error;
		}
		else
		{
			return false;
		}
	}
}