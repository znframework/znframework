<?php
namespace ZN\FileSystem;

class InternalFile extends \CallController implements FileInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
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
	public function read(String $file)
	{
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
	public function contents(String $file)
	{
		return file_get_contents($file);
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
	public function find(String $file, $data)
	{
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
	public function write(String $file, $data)
	{
		return file_put_contents($file, $data);
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
	public function append(String $file, $data)
	{
		return file_put_contents($file, $data, FILE_APPEND);
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
	public function create(String $name)
	{
		// Dosya mevcut değilse oluştur.
		if( ! is_file($name) )
		{ 
			// Dosyayı oluştur.
			@touch($name);
		}
		
		return \Exceptions::throws('File', 'alreadyFileError', $name);	
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
	public function delete(String $name)
	{
		if( ! is_file($name)) 
		{
			return \Exceptions::throws('File', 'notFoundError', $name);	
		}
		else 
		{
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
	public function info(String $file)
	{
		if( ! is_file($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
	public function size(String $file, $type = "b", $decimal = 2)
	{
		if( ! file_exists($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
	public function createDate(String $file, $type = 'd.m.Y G:i:s')
	{
		if( ! file_exists($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
	public function changeDate(String $file, $type = 'd.m.Y G:i:s')
	{
		if( ! file_exists($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
	public function owner(String $file)
	{
		if( ! file_exists($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
	public function group(String $file)
	{
		if( ! file_exists($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
	public function zipExtract(String $source, String $target = NULL)
	{
		$source = suffix($source, '.zip');

		if( ! file_exists($source) )
		{
			return \Exceptions::throws('File', 'notFoundError', $source);
		}

		if( empty($target) )
		{
			$target = removeExtension($source);	
		}
		
		$zip = new \ZipArchive;
		
		if( $zip->open($source) === true ) 
		{
			$zip->extractTo($target);
			$zip->close();
			
			return true;
		} 
		else 
		{
			return \Exceptions::throws('File', 'zipExtractError', $target);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Zip Extract Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	public function createZip(String $path, Array $data)
	{			
		$zip = new \ZipArchive();

		$zipPath = suffix($path, ".zip");
		
		if( file_exists($zipPath) ) 
		{	
			unlink($zipPath); 	
		}

		if( $zip->open($zipPath, \ZIPARCHIVE::CREATE) !== true ) 
		{
			return \Exceptions::throws('File', 'zipExtractError', $zipPath);
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
	public function rename(String $oldName, String $newName)
	{
		if( ! file_exists($oldName) )
		{
			return \Exceptions::throws('File', 'notFoundError', $oldName);
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
	public function cleanCache(String $fileName = NULL, $real = false)
	{
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
	public function permission(String $file, Integer $permission = NULL)
	{
		if( ! file_exists($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
		}
		
		chmod($file, ($permission === NULL ? 0755 : $permission) );
	}
	
	/******************************************************************************************
	* LIMIT                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosyayı boyutlandırmak için kullanılır.		     				      |											
	|          																				  |
	******************************************************************************************/
	public function limit(String $file, $limit = 0, $mode = 'r+')
	{
		if( ! is_file($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
	public function rowCount(String $file = NULL, $recursive = true)
	{
		$file = $file === NULL ? '/' : $file;

		if( ! file_exists($file) )
		{
			return \Exceptions::throws('File', 'notFoundError', $file);
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
			return \Exceptions::throws('File', 'notFoundError', $file);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}