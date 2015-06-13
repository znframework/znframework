<?php
/************************************************************/
/*                      CLASS  FTP                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* FTP                                                                               	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	ftp:: , $this->ftp , zn::$use->ftp , uselib('ftp')->          |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Ftp
{
	/* Connect Değişkeni
	 *  
	 * Bağlantı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $connect = NULL;
	
	/* Login Değişkeni
	 *  
	 * Giriş bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $login = NULL;
	
	/* Error Değişkeni
	 *  
	 * Ftp işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $error = NULL;
	
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
	public static function connect($con = array())
	{	
		if( ! is_array($con) )
		{
			return false;
		}
		
		// Config/Ftp.php dosyasından ftp ayarları alınıyor.
		$config = config::get('Ftp');
		
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
		$ssl = 		( isset($con['ssl_connect']) ) 
					? $con['ssl_connect'] 
					: $config['ssl_connect'];
		
		// ----------------------------------------------------------------------------
	
		// Bağlantı türü ayarına göre ssl veya normal
		// bağlatı yapılıp yapılmayacağı belirlenir.
		self::$connect =  	( $ssl === false ) 
							? @ftp_connect($host, $port, $timeout)
							: @ftp_ssl_connect($host, $port, $timeout);
							
		if( empty(self::$connect) ) 
		{
			return false;
		}
		
		self::$login = @ftp_login(self::$connect, $user, $password);
		
		if( empty(self::$login) )
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
	public static function close()
	{
		if( ! empty(self::$connect) )
		{
			@ftp_close(self::$connect);
		}
		else
		{ 
			return false;
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
	public static function createFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return false;	
		}
		// Bağlantı yoksa otomatik bağlantı oluştur.
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( @ftp_mkdir(self::$connect, $path) )
		{
			return true;
		}
		else
		{
			self::$error =  getMessage('Folder', 'already_file_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false; 
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
	public static function deleteFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return false;	
		}
		// Bağlantı yoksa otomatik bağlantı oluştur.
		if( empty(self::$connect) )
		{
			self::connect();
		}
		
		if( @ftp_rmdir(self::$connect, $path) )
		{
			return true;
		}
		else
		{
			self::$error = getMessage('Folder', 'not_found_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
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
	public static function changeFolder($path = '')
	{
		if( ! is_string($path) ) 
		{
			return false;	
		}
		// Bağlantı yoksa otomatik bağlantı oluştur.
		if(empty(self::$connect)) self::connect();
	
		if( @ftp_chdir(self::$connect, $path) )
		{
			return true;
		}
		else
		{
			self::$error = getMessage('Folder', 'change_folder_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
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
	public static function rename($oldname = '', $newname = '')
	{
		if( ! ( is_string($oldname) || is_string($newname) ) ) 
		{
			return false;	
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( @ftp_rename(self::$connect, $oldname, $newname) )
		{
			return true;
		}
		else
		{
			self::$error = getMessage('Folder', 'change_folder_name_error', $oldname);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
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
	public static function deleteFile($path = '')
	{
		if( ! is_string($path) ) 
		{
			return false;
		}
		
		if( empty(self::$connect) )
		{
			self::connect();
		}
		
		if( @ftp_delete(self::$connect, $path) )
		{
			return true;
		}
		else
		{
			self::$error = getMessage('File', 'not_found_error', $path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
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
	public static function upload($local_path = '', $remote_path = '', $type = 'ascii')
	{
		if( ! (is_string($local_path) || is_string($remote_path)) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'ascii';	
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( $type === 'ascii' )
		{
			$mode = FTP_ASCII;
		}
		else
		{
			$mode = FTP_BINARY;
		}
		
		if( @ftp_put(self::$connect, $local_path, $remote_path, $mode) )
		{
			return true;
		}
		else
		{
			self::$error = getMessage('File', 'remote_upload_error', $local_path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
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
	public static function download($remote_path = '', $local_path = '', $type = 'ascii')
	{
		if( ! (is_string($local_path) || is_string($remote_path)) ) 
		{
			return false;
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'ascii';	
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( $type === 'ascii' )
		{
			$mode = FTP_ASCII;
		}
		else
		{
			$mode = FTP_BINARY;
		}
		
		if( @ftp_get(self::$connect, $local_path, $remote_path, $mode) )
		{
			return true;
		}
		else
		{
			self::$error = getMessage('File', 'remote_download_error', $local_path);
			report('Error', self::$error, 'FtpLibrary');
			return false;	
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
	public static function permission($path = '', $type = 0755)
	{
		if( ! is_string($path) )
		{
			return false;	
		}
		
		if( ! is_numeric($type) )
		{
			$type = 0755;
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		if( @ftp_chmod(self::$connect, $type, $path) )
		{
			return true;
		}
		else
		{ 
			return false;
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
	public static function files($path = '', $extension = '')
	{
		if( ! is_string($path) )
		{
			return false;	
		}
		
		if( empty(self::$connect) )
		{
			self::connect();
		}
		
		$list = @ftp_nlist(self::$connect, $path);
	
		if( ! empty($list) ) foreach($list as $file)
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
			return false;
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
	public static function fileSize($path = '', $type = 'b', $decimal = 2)
	{
		if( ! is_string($path) ) 
		{
			return false;	
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'b';	
		}
		
		if( empty(self::$connect) ) 
		{
			self::connect();
		}
		
		$size = 0;
		
		$extension = extension($path);
		
		if( ! empty($extension) )
		{
			$size = @ftp_size(self::$connect, $path);
		}
		else
		{
			if( self::files($path) )
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
	public static function error()
	{
		if( isset(self::$error) )
		{
			return self::$error;
		}
		else
		{
			return false;
		}
	}
}