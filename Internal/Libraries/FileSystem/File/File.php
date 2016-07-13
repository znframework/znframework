<?php
namespace ZN\FileSystem;

class InternalFile implements FileInterface
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
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Read Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* READ                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya içeriğini okumak için kullanılır.						          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Okunacak dosyanın yolu.										  |
	|          																				  |
	******************************************************************************************/
	public function read($file = '')
	{
		if( ! is_string($file) || ! is_file($file) ) 
		{
			\Errors::set('Error', 'stringParameter', 'file');
			\Errors::set('Error', 'fileParameter', 'file');
			
			return false;
		}
		
		// Dosya içeriğini getir.
		return file_get_contents($file);
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
		if( ! is_string($path) ) 
		{
			\Errors::set('Error', 'stringParameter', 'path');
			
			return false;
		}
		
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
		if( ! is_string($file) || ! is_file($file) ) 
		{
			\Errors::set('Error', 'stringParameter', 'file');
			\Errors::set('Error', 'fileParameter', 'file');
			
			return false;
		}
		
		if( ! is_scalar($data) || empty($data) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'data');
		}

		// Dosyadan gereli veriyi çek.
		$index = strpos(file_get_contents($file), $data);
		
		$contents = $this->contents($file);
	
		return (object)array 
		(
			'index'    => $index,
			'contents' => $contents
		);	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Read Methods Bitiş
	//----------------------------------------------------------------------------------------------------

	
	//----------------------------------------------------------------------------------------------------
	// Write Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function write($file = '', $data = '')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($file) || is_dir($file) ) 
		{
			\Errors::set('Error', 'stringParameter', 'file');
			\Errors::set('Error', 'fileParameter', 'data');
			
			return false;
		}
		
		// Parametre kontrolü yapılıyor.
		if( ! is_scalar($data) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'data');
		}

		if( ! file_put_contents($file, $data) )
		{
			return \Errors::set('Error', 'fileNotWrite', $file);
		}
		
		return true;
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
	public function append($file = '', $data = '')
	{
		// Parametre kontrolleri yapılıyor.
		if( ! is_string($file) || is_dir($file) ) 
		{
			\Errors::set('Error', 'stringParameter', 'file');
			\Errors::set('Error', 'fileParameter', 'file');
			
			return false;
		}
		
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', 'data');
		}
		
		if( ! file_put_contents($file, $data, FILE_APPEND) )
		{
			return \Errors::set('Error', 'fileNotWrite', $file);
		}
		
		return true;
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Write Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
			\Errors::set('Error', 'stringParameter', 'name');
			\Errors::set('Error', 'fileParameter', 'name');
			
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
			return \Errors::set('File', 'alreadyFileError', $name);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Delete Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
			return \Errors::set('Error', 'stringParameter', 'name');
		}
		
		if( ! is_file($name)) 
		{
			return \Errors::set('File', 'notFoundError', $name);	
		}
		else 
		{
			// Dosyayı sil.
			@unlink($name);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete Method Bitiş
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Info Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
			return \Errors::set('Error', 'fileParameter', 'file');
		}
		
		return (object)array
		(
			'basename' 	 => pathInfos($file, 'basename'),
			'size'		 => filesize($file),
			'date' 		 => filemtime($file),
			'readable' 	 => is_readable($file),
			'writable' 	 => is_writable($file),
			'executable' => is_executable($file),
			'permission' => fileperms($file)	
		);
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
			return \Errors::set('Error', 'stringParameter', 'file');
		}
		if( ! is_string($type) ) 
		{
			$type = "b";
		}
		if( ! file_exists($file) )
		{
			return \Errors::set('File', 'notFoundError', $file);
		}
		// ------------------------------------------------------------------------------
		
		$size = 0;
	
		$extension = extension($file);
		$fileSize  = filesize($file);
		// Bu bir dosya ise
		if( ! empty($extension) )
		{
			$size += $fileSize;
		}
		else
		{
			$folderFiles = \Folder::files($file);
			// Dizin içerisinde dosyalar mevcut ise 
			if( $folderFiles )
			{
				// Hesaplanan boyuta dosya boyutlarını ilave et
				foreach( $folderFiles as $val )
				{	
					$size += $this->size($file."/".$val);	
				}
				
				$size += $fileSize;
			}
			else
			{
				// Dizin içerisinde herhangi bir dosya mevcut değilse
				$size += $fileSize;
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
			return \Errors::set('Error', 'stringParameter', 'file');
		}
		if( ! is_string($type) ) 
		{
			$type = "d.m.Y G:i:s";
		}
		if( ! file_exists($file) )
		{
			return \Errors::set('File', 'notFoundError', $file);
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
			return \Errors::set('Error', 'stringParameter', 'file');
		}
		if( ! is_string($type) ) 
		{
			$type = "d.m.Y G:i:s";
		}
		if( ! file_exists($file) )
		{
			return \Errors::set('File', 'notFoundError', $file);
		}
		
		// Dosyanın son değiştirilme tarihi
		$date = filemtime($file);
		 
		return date($type, $date);
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
			return \Errors::set('Error', 'stringParameter', 'file');
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
			return \Errors::set('Error', 'stringParameter', 'file');	
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
	
	//----------------------------------------------------------------------------------------------------
	// Info Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Zip Extract Method Başlangıç
	//----------------------------------------------------------------------------------------------------
	
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
			return \Errors::set('Error', 'stringParameter', 'source');
		}
		
		if( ! is_string($target) ) 
		{
			$target = '';
		}
		
		if( empty($target) )
		{
			$target = removeExtension($source);	
		}
		
		$source = suffix($source, '.zip');
		
		if( ! file_exists($source) )
		{
			return \Errors::set('File', 'notFoundError', $source);
		}
		// ----------------------------------------------------------------------------
		
		$zip = new \ZipArchive;
		
		if( $zip->open($source) === true ) 
		{
			$zip->extractTo($target);
			$zip->close();
			
			return true;
		} 
		else 
		{
			return \Errors::set('File', 'zipExtractError', $target);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Zip Extract Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	public function createZip($path = '', $data = [])
	{			
		$zip = new \ZipArchive();

		$zipPath = suffix($path, ".zip");
		
		if( file_exists($zipPath) ) 
		{	
			unlink($zipPath); 	
		}

		if( $zip->open($zipPath, \ZIPARCHIVE::CREATE) !== true ) 
		{
			return \Errors::set('File', 'zipExtractError', $zipPath);
		}
		
		$status = '';
			
		if( ! empty($data) ) foreach( $data as $key => $val )
		{		
			if( is_numeric($key) )
			{
				$file = $val;
				$fileName = NULL;	
			}
			else
			{
				$file = $key;
				$fileName = $val;	
			}
				
			if( is_dir($file) )
			{
				$allFiles = \Folder::allFiles($file, true);
				
				foreach( $allFiles as $f )
				{
					$status = $zip->addFile($f, $f);
				}	
			}
			else
			{
				$status = $zip->addFile($file, $fileName);
			}
		}	
		
		return $zip->close();	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Rename Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* RENAME                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın ismini değiştirmek için kullanılır.	     				      |											
	|          																				  |
	******************************************************************************************/
	public function rename($oldName = '', $newName = 0)
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_scalar($oldName) || ! is_scalar($newName)  ) 
		{
			\Errors::set('Error', 'valueParameter', 'oldName');
			\Errors::set('Error', 'valueParameter', 'newName');
			
			return false;
		}
		
		if( ! file_exists($oldName) )
		{
			return \Errors::set('File', 'notFoundError', $file);
		}
	
		return rename($oldName, $newName);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Rename Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* CLEAN CACHE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Silinen dosyanın ön bellekten kaldırılması için oluşturulmuştur.        |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. boolean var @real => Gerçek ön bellekten silinip silinemeyeceği.					  |
	| 1. string var @fileName => Ön bellekten silinmesi istenen dosya.		     			  |
	|          											  									  |
	| Örnek Kullanım: $veri = delete('dizin/yeniDosya.txt');        						  |
	|          																				  |
	******************************************************************************************/
	public function cleanCache($real = false, $fileName = '')
	{
		if( ! is_bool($real) ) 
		{
			return \Errors::set('Error', 'booleanParameter', 'real');
		}
		
		if( ! file_exists($fileName) )
		{
			return clearstatcache($real);
		}
		else
		{
			return clearstatcache($real, $fileName);
		}
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
			return \Errors::set('Error', 'stringParameter', 'name');
		}
		if( ! is_numeric($permission) ) 
		{
			$permission = 0755;
		}
		if( ! file_exists($name) )
		{
			return \Errors::set('File', 'notFoundError', $name);
		}
		else
		{
			// Dosyayı yetkilendir.
			chmod($name, $permission);
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
			\Errors::set('Error', 'stringParameter', 'file');
			\Errors::set('Error', 'dirParameter', 'file');
			\Errors::set('Error', 'numericParameter', 'limit');
			\Errors::set('Error', 'stringParameter', 'mode');
			
			return false;
		}
		
		if( ! file_exists($file) )
		{
			return \Errors::set('File', 'notFoundError', $file);
		}
	
		$fileOpen  = fopen($file, $mode);
		$fileWrite = ftruncate($fileOpen, $limit);
		
		fclose($fileOpen);
	}
	
	//----------------------------------------------------------------------------------------------------
	// rowCount()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $file      /
	// @param  bool   $recursive true
	// @return numeric
	//
	//----------------------------------------------------------------------------------------------------
	public function rowCount($file = '/', $recursive = true)
	{
		if( ! is_string($file) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(file)');
		}
		
		if( is_file($file) )
		{
			return count( file($file) );
		}
		elseif( is_dir($file) )
		{
			$files =  \Folder::allFiles($file, $recursive);
			
			$rowCount = 0;
			
			foreach( $files as $f )
			{
				if( is_file($f) )
				{
					$rowCount += count( file($f) );	
				}
			}
			
			return $rowCount;
		}
		else
		{
			return \Errors::set('File', 'notFoundError', $file);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}