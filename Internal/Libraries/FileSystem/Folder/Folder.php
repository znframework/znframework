<?php
namespace ZN\FileSystem;

class InternalFolder extends \CallController implements FolderInterface
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
	// Create Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizin oluşturmak için kullanılır.    				     			      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Oluşturulacak dizinin adı veya yolu.							  |
	| 2. string var @permission => Oluşturulacak dizinin yetki kodu							  |
	|          											  									  |
	| Örnek Kullanım: create('dizin/yeniDizin');        						              |
	|          																				  |
	******************************************************************************************/
	public function create(String $file, Integer $permission = NULL, $recursive = true)
	{
		if( is_dir($file) )
		{
           return \Exceptions::throws('Folder', 'alreadyFileError', $file);
		}

        return mkdir($file, ( $permission === NULL ? 0755 : $permission ), $recursive);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Create Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Rename Method Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* RENAME                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin adını değiştirmek için kullanılır.    				     	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @oldname => Dizinin eski ismi.							  				  |
	| 2. string var @newname => Dizinin yeni ismi.							  				  |
	|          											  									  |
	| Örnek Kullanım: rename('dizin/eskiIsim', 'dizin/yeniIsim');        				      |
	|          																				  |
	******************************************************************************************/
	public function rename(String $oldName, String $newName)
	{
		if( ! file_exists($oldName) )
		{
            return \Exceptions::throws('Folder', 'notFoundError', $oldName);
		}

		return rename($oldName, $newName);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Rename Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Delete Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* DELETE EMPTY                                                                            *
	*******************************************************************************************
	| Genel Kullanım: İçi boş dizini silmek için kullanılır.    	 			     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek boş dizinin adı veya yolu.							  |
	|          											  									  |
	| Örnek Kullanım: $veri = deleteEmpty('dizin/yeniDizin');        					      |
	|          																				  |
	******************************************************************************************/
	public function deleteEmpty(String $folder)
	{
		if( ! is_dir($folder) )
		{
           return \Exceptions::throws('Folder', 'notFoundError', $folder);
		}

		return rmdir($folder);
	}
	
	/******************************************************************************************
	* DELETE	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: İçi dolu veya boş dizini silmek için kullanılır.    	 			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek dizinin adı veya yolu.							      |
	|          											  									  |
	| Örnek Kullanım: $veri = delete('dizin/yeniDizin');        					          |
	|          																				  |
	| Not: Bu yöntem bir dizinin içindeki diğer tüm verileride dizin ile birlikte silecektir. |
	|          																				  |
	******************************************************************************************/
	public function delete(String $name)
	{
		if( ! file_exists($name) )
		{
			return \Exceptions::throws('Folder', 'notFoundError', $name);
		}

		// Is File
		if( is_file($name) )
		{
			// Delete File
			\File::delete($name);	
		}
		else
		{
			// Is Dir
			if( ! $this->files($name) )
			{
				// Delete Empty Dir
				$this->deleteEmpty($name);
			}	
			else
			{			
				// Delete
				for($i = 0; $i < count($this->files($name)); $i++)
				{
					foreach($this->files($name) as $val)
					{					
						$this->delete($name."/".$val);
					}
				}
			}
			
			// Delete Empty Dir
			$this->deleteEmpty($name);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Info Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* FILE INFO	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin içerisinde yer alan dosyalar hakkında bilgi edinmek için	  |
	| kullanılır.																			  |
	|															                              |
	******************************************************************************************/
	public function fileInfo(String $dir, String $extension = NULL)
	{
		if( is_dir($dir) )
		{
			$files = $this->files($dir, $extension);
			
			$dir = suffix($dir);
			
			$filesInfo = [];
			
			foreach($files as $file)
			{
				$filesInfo[$file]['basename'] 	= pathInfos($dir.$file, 'basename');
				$filesInfo[$file]['size'] 		= filesize($dir.$file);
				$filesInfo[$file]['date'] 		= filemtime($dir.$file);
				$filesInfo[$file]['readable'] 	= is_readable($dir.$file);
				$filesInfo[$file]['writable'] 	= is_writable($dir.$file);
				$filesInfo[$file]['executable'] = is_executable($dir.$file);
				$filesInfo[$file]['permission'] = fileperms($dir.$file);
			}
			
			return $filesInfo;
		}
		elseif( is_file($dir) )
		{
			$fileinfo = \File::info($dir);
			return (array) $fileinfo;
		}
		else
		{
			return \Exceptions::throws('Folder', 'notFoundError', $dir);
		}	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Info Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Copy Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* COPY                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: İçi boş veya dolu bir dizini kopyalamak için kullanılır.    	 		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @source => Hangi dizinin kopyalanacağını belirtir.			  		      |
	| 2. string var @target => Kopyalanan dizinin hangi yola yapıştırılacağı belirtir.        |
	|          											  									  |
	| Örnek Kullanım: $veri = copy('dizin/kaynakDizin', 'dizin/hedefDizin');        		  |
	|          																				  |
	******************************************************************************************/
	public function copy(String $source, String $target)
	{
		if( ! file_exists($source) )
		{
			return \Exceptions::throws('Folder', 'notFoundError', $source);
		}
		
		// Bu bir dizinse
		if( is_dir($source) )
		{
			// Dizinin içinde mevcut dosya varsa
			if( ! $this->files($source) )
			{
				@copy($source, $target);
			}
			else
			{			
				// Kopyalanacak dizin mevcut değilse oluştur.
				if( ! is_dir($target) && ! file_exists($target) )
				{
					$this->create($target);
				}
				
				// Kopyalama işlemini başlat.
				if( is_array($this->files($source)) )foreach( $this->files($source) as $val )
				{
					$sourceDir = $source."/".$val;
					$targetDir = $target."/".$val;
					
					if( is_file($sourceDir) )
					{
						copy($sourceDir, $targetDir);
					}
					
					$this->copy($sourceDir, $targetDir);
				}							
			}		
		}
		else
		{
			// Bu bir dosya ise
			@copy($source, $target);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Copy Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* CHANGE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Çalışma dizini değiştirmek için kullanılır.    	 		     		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Değiştirilecek çalışma dizininin adı veya yolu.				  |
	|          											  									  |
	| Örnek Kullanım: $veri = changer('dizin/yeniDizin');        					          |
	|          																				  |
	******************************************************************************************/	
	public function change(String $name)
	{
		if( ! is_dir($name) )
		{
            return \Exceptions::throws('Folder', 'notFoundError', $name);
		}

		return chdir($name);
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
	public function files(String $path, String $extension = NULL)
	{
		if( ! is_dir($path) )
		{
			return \Exceptions::throws('Folder', 'notFoundError', $path);
		}
		
		$files = [];
		
		// 1. Parametre boş ise bu parametreyi aktif dizin olarak belirle.
		if( empty($path) )
		{
			$path = '.';
		}
		
		$dir = opendir($path);
		
		while( $file = readdir($dir) )
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
						if( is_dir(suffix($path).$file) )
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
	
	/******************************************************************************************
	* ALL FILES	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Bir dizin içindeki dosya ve dizin listesini almak için kullanılır.      |
	| Bu yöntemin files() yönteminden farkı herhangi bir uzantı parametresinin olmamasıdır.	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @pattern => Listesi alınacak dizinin adı veya yolu.	Varsayılan:*		  |
	|          											  									  |
	| Örnek Kullanım: $veri = allFiles('dizin/'); // tüm dosya ve dizinleri listeler.        |
	|          																				  |
	******************************************************************************************/
	public function allFiles(String $pattern = NULL, $allFiles = false)
	{
	    $pattern = $pattern === NULL ? '*' : $pattern;
		
		if( $allFiles === true )
		{
			static $classes;
		
			$directory = suffix($pattern); 
			
			$files = glob($directory.'*');
		
			if( ! empty($files) ) foreach( $files as $v )
			{
				if( is_file($v) )
				{
					$classEx = explode('/', $v);

					$classes[] = $v;
				}
				elseif( is_dir($v) )
				{
					$this->allFiles($v, $allFiles);
				}
			}	
			
			return $classes;
		}
		
		// Parametrede / eki var ve yıldız yoksa /* formuna dönüştür.
		if( strstr($pattern, '/') != "" && strstr($pattern, '*') == "" ) 
		{
			$pattern .= "*";
		}
		
		// Parametrede / eki yoksa ve yıldız yoksa /* formuna dönüştür.
		if( strstr($pattern, '/') == "" && strstr($pattern, '*') == "" ) 
		{
			$pattern .= "/*";
		}
		
		// Yukarıdaki kontrollerin amacı kullanıcıların
		// daha esnek parametre kullanabilmelerine
		// yardımcı olmak içindir.
		
		return glob($pattern);
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
	public function permission(String $name, Integer $permission = NULL)
	{
	    if( ! file_exists($name) )
        {
            return \Exceptions::throws('File', 'notFoundError', $name);
        }

	    $permission = $permission === NULL ? 0755 : $permission;

		return \File::permission($name, $permission);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}