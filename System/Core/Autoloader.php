<?php
/************************************************************/
/*                   CLASS  AUTOLOADER                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* AUTOLOADER                                                                           	  *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Etmeye Gerek Yoktur.   							      |
| Sınıfı Kullanırken      :	Sistem Tarafından Kullanılılır.		 			     		  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class Autoloader
{	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Otomatik yükleyiciği çağırmak için oluşturulmuş yöntemdir.			  |
	|          																				  |
	******************************************************************************************/
	public static function run($class)
	{
		// ----------------------------------------------------------------------------------------
		// ClassMap oluşturulmamış ise oluştur.
		// Sistemin çalışması için gerekli bir kontroldür.
		// ----------------------------------------------------------------------------------------
		$path = CONFIG_DIR.'ClassMap.php';
		
		if( ! file_exists($path) )
		{
			self::createClassMap();
		}

		$classInfo = self::getClassFileInfo($class);
	
		$file = $classInfo['path'];
	
		if( file_exists($file) )
		{	
			require_once($file);
		}
		else
		{
			die(getErrorMessage('Error', 'classError', $class));
		}
	} 
	
	/******************************************************************************************
	* CREATE CLASS MAP                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.   |
	| yol bilgisi oluşturulur. Böylece bir sınıf dahil edilmeden kullanılabilir.			  |
	|          																				  |
	******************************************************************************************/
	public static function createClassMap()
	{
		$classMap = Config::get('Autoloader', 'classMap');
		
		if( ! empty($classMap) ) foreach($classMap as $directory)
		{
			$classMaps = self::searchClassMap($directory, $directory);
		}
		
		$path = CONFIG_DIR.'ClassMap.php';
		
		if( file_exists($path) )
		{
			$classMapCount = Config::get('ClassMap', 'count');
			
			if( $classMapCount === count($classMaps) )
			{
				return false;	
			}
		}
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının metinsel bölümü oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		$classMapPage  = '<?php'.eol();
		$classMapPage .= '$config[\'ClassMap\'][\'path\'] = array'.eol().'('.eol();
		
		if( ! empty($classMaps) ) foreach($classMaps as $k => $v)
		{
			$classMapPage .= "\t".'\''.$k.'\' => \''.$v.'\','.eol();
		}
		
		$classMapPage  = rtrim($classMapPage, ','.eol());	
		$classMapPage .= eol().');'.eol(2);
		$classMapPage .= '$config[\'ClassMap\'][\'count\'] = '.count($classMaps).';';
		
		// ----------------------------------------------------------------------------------------
		// ClassMap verisi yine aynı isimde bir dosya olarak oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		$fileOpen  = fopen($path, 'w');		
		$fileWrite = fwrite($fileOpen, $classMapPage);
		
		fclose($fileOpen);
	}
	
	/******************************************************************************************
	* GET CLASS FILE INFO                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Çağrılan sınıfın sınıf, yol ve namespace bilgilerini almak için 		  |
	| oluşturulmuştur.								  										  |
	|          																				  |
	******************************************************************************************/
	public static function getClassFileInfo($class = '')
	{
		$classMap = Config::get('ClassMap', 'path');
			
		$classMapCaseLower = array_change_key_case($classMap, CASE_LOWER);	
		$classCaseLower   = strtolower($class);
		
		// ----------------------------------------------------------------------------------------
		// DOSYA bilgisi oluşturuluyor...
		// ----------------------------------------------------------------------------------------
		$file = isset($classMapCaseLower[$classCaseLower])
			  ? $classMapCaseLower[$classCaseLower]
			  : '';
		// ----------------------------------------------------------------------------------------
		
		// ----------------------------------------------------------------------------------------
		// NAMESPACE bilgisi oluşturuluyor...
		// ----------------------------------------------------------------------------------------	  
		$className  = array_keys($classMap);
		$classIndex = array_search($classCaseLower, array_keys($classMapCaseLower));	
		$namespace  = $className[$classIndex + 1];
	
		if( $classMap[$namespace] !== $file )
		{
			$namespace = $class;	
		}
		// ----------------------------------------------------------------------------------------
		
		return array
		(
			'path' 		=> $file,
			'class'	   	=> $class,
			'namespace'	=> $namespace
		);
	}
	
	/******************************************************************************************
	* PRIVATE SEARCH CLASS MAP                                                                *
	*******************************************************************************************
	| Genel Kullanım: Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.   |
	| yol bilgisi oluşturulur. createClassMap() yöntemi için oluşturulmuştur.    			  |
	|          																				  |
	******************************************************************************************/
	private static function searchClassMap($directory = '', $baseDirectory = '' )
	{
		static $classes;
		
		$directory 	   = suffix($directory); 
		$baseDirectory = suffix($baseDirectory); 
		
		$files = glob($directory.'*');
	
		if( ! empty($files) ) foreach($files as $v)
		{
			if( is_file($v) && extension($v) === 'php' )
			{
				$classEx = explode('/', $v);
				
				// Sınıf isimleri ve yolları oluşturuluyor...
				$classes[removeExtension(end($classEx))] = $v;
				
				// Sınıf namespace(isim alanları) ve yolları oluşturuluyor.	
				$classes[str_replace('/', '\\', str_replace($baseDirectory, '', removeExtension($v)))] = $v;	
			}
			elseif( is_dir($v) )
			{
				self::searchClassMap($v, $baseDirectory);
			}
		}	
		
		return $classes;
	}
}

/* AUTOLOADER RUN *
*
* 
* Otomatik Yükleme Çalıştırılıyor...
*/
spl_autoload_register('Autoloader::run');