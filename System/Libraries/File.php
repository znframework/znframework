<?php
class __USE_STATIC_ACCESS__File
{
	/***********************************************************************************/
	/* FILE LIBRARY	    					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: File
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: file::, $this->file, zn::$use->file, uselib('file')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Error Değişkeni
	 *  
	 * Dosya işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $error;
	
	/******************************************************************************************
	* READ                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya içeriğini okumak için kullanılır.						          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Okunacak dosyanın yolu.										  |
	| 2. string var @mode => Dosya modu. Varsayılan:r										  |
	|          																				  |
	******************************************************************************************/
	public function read($file = '', $mode = 'r')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($file) || ! is_string($mode) )
		{
			return false;
		}
		
		// Dosya mevcutsa işlemi gerçekleştir.
		if( file_exists($file) )
		{
			// Dosyadaki veriyi oku.
			$fileOpen = fopen($file, $mode);	
			$fileRead = fread($fileOpen, filesize($file));
			
			fclose($fileOpen);
			
			return $fileRead;
		}
		else
		{
			// Dosya mevcut değilse hata raporu oluştur.
			$this->error = getMessage('File', 'notFoundError', $file);
			report('Error', $this->error, 'FileLibrary');
			return false;		
		}
	}
	
	/******************************************************************************************
	* WRITE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosyaya veri yazmak için kullanılır.		     				          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Veri yazılacak dosyanın yolu.									  |
	| 2. string/numeric var @data => Dosyaya yazılacak veri.         			     	      |
	|          																				  |
	| Örnek Kullanım: write('dizin/dosya.txt', 'a');        								  |
	|          																				  |
	******************************************************************************************/
	public function write($file = '', $data = '', $mode = 'w')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($file) || is_dir($file) || ! is_string($mode) ) 
		{
			return false;
		}
		
		// Parametre kontrolü yapılıyor.
		if( ! isValue($data) ) 
		{
			$data = '';
		}

		$fileOpen  = fopen($file, $mode);
		$fileWrite = fwrite($fileOpen, $data);
		
		fclose($fileOpen);
	}	
	
	/******************************************************************************************
	* CONTENTS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Dosya içeriğine erişmek için kullanılır.		     				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Veri okunacak dosyanın yolu.									  |
	|          																				  |
	| Örnek Kullanım: contents('dizin/dosya.txt');        									  |
	|          																				  |
	******************************************************************************************/
	public function contents($path = '')
	{
		if( ! is_string($path) || ! isFileExists($path) ) 
		{
			return false;
		}
		
		if( ! file_exists($path) )
		{
			$this->error = getMessage('File', 'notFoundError', $path);
			report('Error', $this->error, 'FileLibrary');
			return false;	
		}
		// Dosya içeriğini getir.
		return file_get_contents($path);
	}
	
	/******************************************************************************************
	* FIND                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya içerisinde arama yapmak için kullanılır.    				      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Aranacak dosyanın yolu.									      |
	| 2. string var @data => Aranacak veri.								            	      |
	|          											  									  |
	| Örnek Kullanım: $veri = contents('dizin/dosya.txt', 'a');        						  |
	|          																				  |
	| Dönen Değerler: Object veri türünde 2 değer döner => index, contents        			  |
	| 1. $veri->index => Aranan veri bulunursa bulunan karakterin indeks numarasını verir.    |
	| 2. $veri->contents => Aranan veri bulunursa bulunan içerik döner.                       |
	|          																				  |
	******************************************************************************************/
	public function find($file = '', $data = '')
	{
		if( ! is_string($file) || empty($data) || ! isFileExists($file) ) 
		{
			return false;
		}
		if( ! isValue($data) ) 
		{
			$data = '';
		}
		if( ! file_exists($file) )
		{
			$this->error = getMessage('File', 'notFoundError', $file);
			report('Error', $this->error, 'FileLibrary');
			return false;	
		}
		
		// Dosyadan gereli veriyi çek.
		$index = strpos(file_get_contents($file), $data);
		
		$contents = $this->contents($file);
	
		$object = (object)array 
		(
			'index'    => $index,
			'contents' => $contents
		);	
		
		return $object;	
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosya oluşturmak için kullanılır.    				     			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Oluşturulacak dosyanın adı veya yolu.							  |
	|          											  									  |
	| Örnek Kullanım: create('dizin/yeniDosya.txt');        						          |
	|          																				  |
	******************************************************************************************/
	public function create($name = '')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($name) || is_dir($name) ) 
		{
			return false;
		}
		// Dosya mevcut değilse oluştur.
		if( ! file_exists($name) )
		{ 
			// Dosyayı oluştur.
			@touch($name);
		}
		else
		{
			// Dosya mevcutsa hatayı rapor et.
			$this->error = getMessage('File', 'alreadyFileError', $name);
			report('Error', $this->error, 'FileLibrary');
			return false;	
		}
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosya silmek için kullanılır.    	 			     			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek dosyanın adı veya yolu.							      |
	|          											  									  |
	| Örnek Kullanım: $veri = delete('dizin/yeniDosya.txt');        						  |
	|          																				  |
	******************************************************************************************/
	public function delete($name = '')
	{
		if( ! is_string($name) ) 
		{
			return false;
		}
		
		if( ! isFileExists($name)) 
		{
			$this->error = getMessage('File', 'notFoundError', $name);
			report('Error', $this->error, 'FileLibrary');
			return false;	
		}
		else 
		{
			// Dosyayı sil.
			unlink($name);	
		}
	}
	
	/******************************************************************************************
	* APPEND                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosyaya veri yazmak için kullanılır.		     				          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Veri yazılacak dosyanın yolu.									  |
	| 2. string/numeric var @data => Dosyaya yazılacak veri.         			     	      |
	|          																				  |
	| Örnek Kullanım: append('dizin/dosya.txt', 'b');        								  |
	|          																				  |
	******************************************************************************************/
	public function append($file = '', $data = '', $mode = 'a')
	{
		// Parametre kontrolleri yapılıyor.
		if( ! is_string($file) || ! is_string($mode) || is_dir($file) ) 
		{
			return false;
		}
		if( ! isValue($data) )
		{
			$data = '';
		}
	
		// Dosyaya veriyi yaz.
		$fileOpen  = @fopen($file, $mode);
		$fileWrite = @fwrite($fileOpen, $data);
		
		@fclose($fileOpen);

	}	

	/******************************************************************************************
	* PERMISSION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosyaya yetkilerini düzenlemek için kullanılır.		     			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Yetki verilecek dosyanın ismi veya yolu.						  |
	| 2. numeric var @name => Dosyaya verilecek yetki kodu.         			     	      |
	|          																				  |
	| Örnek Kullanım: permission('dizin/dosya.txt', 0755);        							  |
	|          																				  |
	******************************************************************************************/
	public function permission($name = '', $permission = 0755)
	{
		if( ! is_string($name) ) 
		{
			return false;
		}
		if( ! is_numeric($permission) ) 
		{
			$permission = 0755;
		}
		if( ! file_exists($name) )
		{
			$this->error = getMessage('File', 'notFoundError', $name);
			report('Error', $this->error, 'FileLibrary');
			return false;
		}
		else
		{
			// Dosyayı yetkilendir.
			chmod($name, $permission);
		}
	}
	
	/******************************************************************************************
	* CREATE DATE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın oluşturulma tarihi bilgisine ulaşmak için kullanılır.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Oluşturma bilgisi öğrenilecek dosyanın yolu.			  		  |
	| 2. string var @type => Oluşturulma tarihinin ne şekilde gösterileceğidir.         	  |
	|          																				  |
	| Örnek Kullanım: createDate('dizin/dosya.txt', 'd.m.Y');        						  |
	|          																				  |
	******************************************************************************************/
	public function createDate($file = '', $type = "d.m.Y G:i:s")
	{
		if( ! is_string($file) ) 
		{
			return false;
		}
		if( ! is_string($type) ) 
		{
			$type = "d.m.Y G:i:s";
		}
		if( ! file_exists($file) )
		{
			$this->error = getMessage('File', 'notFoundError', $file);
			report('Error', $this->error, 'FileLibrary');
			return false;
		}
		
		// Dosyanın oluşturulma tarihi
		$date = filectime($file); 
		
		return date($type, $date);
	}
	
	/******************************************************************************************
	* CHANGE DATE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın değiştirilme tarihi bilgisine ulaşmak için kullanılır.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Değiştirme bilgisi öğrenilecek dosyanın yolu.			  		  |
	| 2. string var @type => Değiştirilme tarihinin ne şekilde gösterileceğidir.         	  |
	|          																				  |
	| Örnek Kullanım: changeDate('dizin/dosya.txt', 'd.m.Y');        						  |
	|          																				  |
	******************************************************************************************/
	public function changeDate($file = '', $type = "d.m.Y G:i:s")
	{
		if( ! is_string($file) ) 
		{
			return false;
		}
		if( ! is_string($type) ) 
		{
			$type = "d.m.Y G:i:s";
		}
		if( ! file_exists($file) )
		{
			$this->error = getMessage('File', 'notFoundError', $file);
			report('Error', $this->error, 'FileLibrary');
			return false;
		}
		
		// Dosyanın son değiştirilme tarihi
		$date = filemtime($file);
		 
		return date($type, $date);
	}
	
	/******************************************************************************************
	* INFO		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın hakkında bilgi almak için kullanılır.						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Bilgileri öğrenilecek dosyanın yolu.			  		          |
	|          																				  |
	| Örnek Kullanım: File::info('dizin/dosya.txt');        						          |
	|          																				  |
	| Dönen Değerler: basename, size, date, readable, writable, executable, permission        |
	|          																				  |
	******************************************************************************************/
	public function info($file = '')
	{
		if( ! is_file($file) )
		{
			return false;
		}
		
		$fileInfo = array
		(
			'basename' 	 => pathInfos($file, 'basename'),
			'size'		 => filesize($file),
			'date' 		 => filemtime($file),
			'readable' 	 => is_readable($file),
			'writable' 	 => is_writable($file),
			'executable' => is_executable($file),
			'permission' => fileperms($file)	
		);
		
		return (object)$fileInfo;
	}
	
	/******************************************************************************************
	* SIZE		                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın boyutunu öğrenmek için kullanılır.							  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @file => Boyutu öğrenilecek dosyanın yolu.			  		              |
	| 2. string var @type => Boyutun ne şekilde gösterileceğidir.         	                  |
	|          																				  |
	| Örnek Kullanım: size('dizin/dosya.txt', 'b');        						              |
	|          																				  |
	| Type parametresi için kullanılabilir değerler        									  |
	| 1. b => byte cinsinden         														  |
	| 2. kb => kilo byte cinsinden değer döndürür.       									  |
	| 3. mb => mega byte cinsinden değer döndürür.          								  |
	| 4. gb => giga byte cinsinden değer döndürür.          								  |
	|          																				  |
	******************************************************************************************/
	public function size($file = '', $type = "b", $decimal = 2)
	{
		// Parametre kontrolleri yapılıyor. --------------------------------------------
		if( ! is_string($file) ) 
		{
			return false;
		}
		if( ! is_string($type) ) 
		{
			$type = "b";
		}
		if( ! file_exists($file) )
		{
			$this->error = getMessage('File', 'notFoundError', $file);
			report('Error', $this->error, 'FileLibrary');
			return false;
		}
		// ------------------------------------------------------------------------------
		
		$size = 0;
	
		$extension = extension($file);
		
		// Bu bir dosya ise
		if( ! empty($extension) )
		{
			$size += filesize($file);
		}
		else
		{
			// Dizin içerisinde dosyalar mevcut ise 
			if( Folder::files($file) )
			{
				// Hesaplanan boyuta dosya boyutlarını ilave et
				foreach( Folder::files($file) as $val )
				{	
					$size += $this->size($file."/".$val);	
				}
				
				$size += filesize($file);
			}
			else
			{
				// Dizin içerisinde herhangi bir dosya mevcut değilse
				$size += filesize($file);
			}	
		}
		
		// Dosyanın boyutunun hangi birim ile gösterileceğinin kontrolü yapılmaktadır.
		// BYTES
		if( $type === "b" )
		{
			return  $size;
		}
		// KILO BYTES
		if( $type === "kb" )
		{
			return round($size / 1024, $decimal);
		}
		// MEGA BYTES
		if( $type === "mb" )
		{
			return round($size / (1024 * 1024), $decimal);
		}
		// GIGA BYTES
		if( $type === "gb" )
		{
			return round($size / (1024 * 1024 * 1024), $decimal);
		}
	}
	
	/******************************************************************************************
	* ZIP EXTRACT		                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Zip dosyanı çıkarmak için kullanılır.							          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @source => Çıkartılacak zip dosyasının yolu.			  		          |
	| 2. string var @target => Çıkartma işleminin hangi dizine yapılacağı.         	          |
	|          																				  |
	| Örnek Kullanım: source('kaynak/dosya.zip', 'hedef/dizin');        				      |
	|          																				  |
	******************************************************************************************/
	public function zipExtract($source = '', $target = '')
	{
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($source) ) 
		{
			return false;
		}
		if( ! is_string($target) ) 
		{
			$target = '';
		}
		if( ! file_exists($source) )
		{
			$this->error = getMessage('File', 'notFoundError', $source);
			report('Error', $this->error, 'FileLibrary');
			return false;
		}
		// ----------------------------------------------------------------------------
		
		// Kaynak zip dosyası açılıyor.
		$zip = zip_open($source);
		
		// Zip dosyası okunuyor.
		while( $zipContent = zip_read($zip) )
		{
			$zipFile = zip_entry_name($zipContent);
			
			if( strpos($zipFile, '.') )
			{
				$targetPath = suffix($target).$zipFile;
				
				touch($targetPath);
				
				$newFile = fopen($targetPath, 'w+');
				
				fwrite($newFile, zip_entry_read($zipContent));
				fclose($newFile);
			}
			else
			{
				@mkdir(suffix($target).$zipFile);
			}
		}
	}
	
	/******************************************************************************************
	* LIMIT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosyayı boyutlandırmak için kullanılır.		     				      |											
	|          																				  |
	******************************************************************************************/
	public function limit($file = '', $limit = 0, $mode = 'r+')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($file) || is_dir($file) || ! is_numeric($limit) || ! is_string($mode) ) 
		{
			return false;
		}
		
		if( ! file_exists($file) )
		{
			$this->error = getMessage('File', 'notFoundError', $file);
			report('Error', $this->error, 'FileLibrary');
			return false;
		}
	
		$fileOpen  = fopen($file, $mode);
		$fileWrite = ftruncate($fileOpen, $limit);
		
		fclose($fileOpen);
	}
	
	/******************************************************************************************
	* RENAME                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın ismini değiştirmek için kullanılır.	     				      |											
	|          																				  |
	******************************************************************************************/
	public function rename($oldName = '', $newName = 0)
	{
		// Parametre kontrolü yapılıyor.
		if( ! isValue($oldName) || ! isValue($newName)  ) 
		{
			return false;
		}
		
		if( ! file_exists($oldName) )
		{
			$this->error = getMessage('File', 'notFoundError', $file);
			report('Error', $this->error, 'FileLibrary');
			return false;
		}
	
		return rename($oldName, $newName);
	}	
	
	/******************************************************************************************
	* FILE OWNER                                                                              *
	*******************************************************************************************
	| Genel Kullanım:  Dosya sahibini döndürür.		  										  |
	|     														                              |
	******************************************************************************************/
	public function owner($file = '')
	{
		if( ! is_string($file))
		{
			return false;	
		}
		
		if( function_exists('posix_getpwuid') )
		{
			return posix_getpwuid(fileowner($file));
		}
		else
		{
			return fileowner($file);
		}
	}
	
	/******************************************************************************************
	* FILE GROUP                                                                              *
	*******************************************************************************************
	| Genel Kullanım:  Dosya sahib grubunu döndürür.		  								  |
	|     														                              |
	******************************************************************************************/
	public function group($file = '')
	{
		if( ! is_string($file))
		{
			return false;	
		}
		
		if( function_exists('posix_getgrgid') )
		{
			return posix_getgrgid(filegroup($file));
		}
		else
		{
			return filegroup($file);
		}
	}
	
	/******************************************************************************************
	* PASS THRU                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dosya tanıtıcısını geçerli konumdan dosya sonuna kadar okur  |
	| ve sonucu çıktı tamponuna yazar.		 		  										  |
	|     														                              |
	******************************************************************************************/
	public function open($file = '', $mode = '', $includePath = false)
	{
		if( ! is_string($file) || ! is_string($mode) || ! is_bool($includePath) )
		{
			return false;	
		}
		
		return fopen($file, $mode, $includePath);
	}
	
	/******************************************************************************************
	* PASS THRU                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dosya tanıtıcısını geçerli konumdan dosya sonuna kadar okur  |
	| ve sonucu çıktı tamponuna yazar.		 		  										  |
	|     														                              |
	******************************************************************************************/
	public function passThru($source = '')
	{
		if( ! is_resource($source) )
		{
			return false;	
		}
		
		return fpassthru($source);
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Açılan bir dosyanın kapatılması gerekirse bu yöntem kullanılır.		  |
	|     														                              |
	******************************************************************************************/
	public function close($source = '')
	{
		if( ! is_resource($source) )
		{
			return false;	
		}
		
		return fclose($source);
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosya işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		if( isset($this->error) )
		{
			return $this->error;
		}
		else
		{
			return false;
		}
	}
}