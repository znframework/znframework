<?php
/************************************************************/
/*                     CLASS  FILE                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* FILE                                                                               	  *
*******************************************************************************************
| Dahil(Import) Edilirken : File   		     					                          |
| Sınıfı Kullanırken      :	file::   		    									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class File
{
	/* Error Değişkeni
	 *  
	 * Dosya işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $error;
	
	/******************************************************************************************
	* READ                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya içeriğini okumak için kullanılır.						          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Okunacak dosyanın yolu.										  |
	|          																				  |
	| Örnek Kullanım: read('dizin/dosya.txt');        									      |
	|          																				  |
	******************************************************************************************/
	public static function read($file = '')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($file) )
		{
			return false;
		}
		
		// Dosya mevcutsa işlemi gerçekleştir.
		if( file_exists($file) )
		{
			// Dosyadaki veriyi oku.
			$file_open = fopen($file, 'r');	
			$file_read = fread($file_open, filesize($file));
			fclose($file_open);
			
			return $file_read;
		}
		else
		{
			// Dosya mevcut değilse hata raporu oluştur.
			self::$error = get_message('File', 'not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
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
	public static function write($file = '', $data = '')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($file) ) 
		{
			return false;
		}
		
		// Parametre kontrolü yapılıyor.
		if( ! is_value($data) ) 
		{
			$data = '';
		}
		
		$file_open 	= fopen($file, 'w');
		
		$file_write = fwrite($file_open, $data);
		
		fclose($file_open);
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
	public static function contents($path = '')
	{
		if( ! is_string($path) ) 
		{
			return false;
		}
		
		if( ! file_exists($path) )
		{
			self::$error = get_message('File', 'not_found_error', $path);
			report('Error', self::$error, 'FileLibrary');
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
	public static function find($file = '', $data = '')
	{
		if( ! is_string($file) || empty($data) ) 
		{
			return false;
		}
		if( ! is_value($data) ) 
		{
			$data = '';
		}
		if( ! file_exists($file) )
		{
			self::$error = get_message('File', 'not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
			return false;	
		}
		
		// Dosyadan gereli veriyi çek.
		$index = strpos(file_get_contents($file), $data);
		
		$contents = self::contents($file);
	
		$object = (object)array 
		(
			'index' => $index,
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
	public static function create($name = '')
	{
		// Parametre kontrolü yapılıyor.
		if( ! is_string($name) ) 
		{
			return false;
		}
		// Dosya mevcut değilse oluştur.
		if( ! file_exists($name) )
		{ 
			// Dosyayı oluştur.
			touch($name);
		}
		else
		{
			// Dosya mevcutsa hatayı rapor et.
			self::$error = get_message('File', 'already_file_error', $name);
			report('Error', self::$error, 'FileLibrary');
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
	public static function delete($name = '')
	{
		if( ! is_string($name) ) 
		{
			return false;
		}
		if( ! file_exists($name)) 
		{
			self::$error = get_message('File', 'not_found_error', $name);
			report('Error', self::$error, 'FileLibrary');
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
	public static function append($file = '', $data = '')
	{
		// Parametre kontrolleri yapılıyor.
		if( ! is_string($file) ) 
		{
			return false;
		}
		if( ! is_value($data) )
		{
			$data = '';
		}
	
		// Dosyaya veriyi yaz.
		$file_open 	= fopen($file, 'a');
		
		$file_write = fwrite($file_open, $data);
		
		fclose($file_open);

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
	public static function permission($name = '', $permission = 0755)
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
			self::$error = get_message('File', 'not_found_error', $name);
			report('Error', self::$error, 'FileLibrary');
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
	| Örnek Kullanım: create_date('dizin/dosya.txt', 'd.m.Y');        						  |
	|          																				  |
	******************************************************************************************/
	public static function create_date($file = '', $type = "d.m.Y G:i:s")
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
			self::$error = get_message('File', 'not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
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
	| Örnek Kullanım: change_date('dizin/dosya.txt', 'd.m.Y');        						  |
	|          																				  |
	******************************************************************************************/
	public static function change_date($file = '', $type = "d.m.Y G:i:s")
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
			self::$error = get_message('File', 'not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
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
	| Örnek Kullanım: file::info('dizin/dosya.txt');        						          |
	|          																				  |
	| Dönen Değerler: basename, size, date, readable, writable, executable, permission        |
	|          																				  |
	******************************************************************************************/
	public static function info($file = '')
	{
		if( ! is_file($file) )
		{
			return false;
		}
		
		$file_info = array
		(
			'basename' 	 => path_info($file, 'basename'),
			'size'		 => filesize($file),
			'date' 		 => filemtime($file),
			'readable' 	 => is_readable($file),
			'writable' 	 => is_writable($file),
			'executable' => is_executable($file),
			'permission' => fileperms($file)	
		);
		
		return (object)$file_info;
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
	public static function size($file = '', $type = "b", $decimal = 2)
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
			self::$error = get_message('File', 'not_found_error', $file);
			report('Error', self::$error, 'FileLibrary');
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
			if( folder::files($file) )
			{
				// Hesaplanan boyuta dosya boyutlarını ilave et
				foreach(folder::files($file) as $val)
				{	
					$size += file::size($file."/".$val);	
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
	public static function zip_extract($source = '', $target = '')
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
			self::$error = get_message('File', 'not_found_error', $source);
			report('Error', self::$error, 'FileLibrary');
			return false;
		}
		// ----------------------------------------------------------------------------
		
		// Kaynak zip dosyası açılıyor.
		$zip = zip_open($source);
		
		// Zip dosyası okunuyor.
		while($zip_content = zip_read($zip))
		{
			$zip_file = zip_entry_name($zip_content);
			
			if( strpos($zip_file, '.') )
			{
				$target_path = suffix($target).$zip_file;
				
				touch($target_path);
				
				$new_file = fopen($target_path, 'w+');
				fwrite($new_file, zip_entry_read($zip_content));
				fclose($new_file);
			}
			else
			{
				@mkdir(suffix($target).$zip_file);
			}
		}
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosya işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
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