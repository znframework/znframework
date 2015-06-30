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
		// NAMESPACE bilgisinün kontrolü yapılıyor.	
		// $class değişkeninin tuttuğu veri için \ sembolü varsa
		// bu bilgi namespace bilgisi olarak kabul edilir.
		// ----------------------------------------------------------------------------------------
		if( strstr($class, '\\') )
		{
			$classEx = explode('\\', $class);
			
			$class = end($classEx);	
		}
		
		$path = CONFIG_DIR.'ClassMap.php';	
		
		// ----------------------------------------------------------------------------------------
		// ClassMap oluşturulmamış ise oluştur.
		// Sistemin çalışması için gerekli bir kontroldür.
		// ----------------------------------------------------------------------------------------
		if( ! file_exists($path) )
		{
			Autoloader::createClassMap();
		}
	
		global $config;
			
		require_once $path;
		
		$classMap = $config['ClassMap'];
		
		$classes = array_values($classMap);

		$classesToLower = array_map('strtolower', $classes);
		
		$index = array_search(strtolower($class), array_values($classesToLower));
		
		if( $index > -1 )
		{
			$arrayKeys = array_keys($classMap);
			
			$file = $arrayKeys[$index];
			
			if( file_exists($file) )
			{
				require_once($file);
			}
			else
			{
				die($file.' is not found!');	
			}
		}
		else
		{
			die($class.' is not found!');
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
		global $config;
			
		require_once CONFIG_DIR.'Autoloader.php';
		
		$classMap = $config['Autoloader']['classMap'];
		
		if( ! empty($classMap) ) foreach($classMap as $directory)
		{
			$classes = self::searchClassMap($directory);
		}
		
		// ----------------------------------------------------------------------------------------
		// ClassMap dosyasının metinsel bölümü oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		$classMapPage  = '<?php'.eol();
		$classMapPage .= '$config[\'ClassMap\'] = array'.eol().'('.eol();
		
		if( ! empty($classes) ) foreach($classes as $k => $v)
		{
			$classMapPage .= "\t".'\''.$k.'\' => \''.$v.'\','.eol();
		}
		
		$classMapPage = rtrim($classMapPage, ','.eol());
		
		$classMapPage .= eol().');';
		
		$path = CONFIG_DIR.'ClassMap.php';
		
		if( file_exists($path) )
		{
			if( trim($classMapPage ) === trim(file_get_contents($path)) )
			{
				return false;	
			}
		}
		
		// ----------------------------------------------------------------------------------------
		// ClassMap verisi yine aynı isimde bir dosya olarak oluşturuluyor.
		// ----------------------------------------------------------------------------------------
		$fileOpen  = fopen($path, 'w');
		
		$fileWrite = fwrite($fileOpen, $classMapPage);
		
		fclose($fileOpen);
	}
	
	/******************************************************************************************
	* PRIVATE SEARCH CLASS MAP                                                                *
	*******************************************************************************************
	| Genel Kullanım: Config/Autoloader.php dosyasında belirtilen dizinlere ait sınıfların.   |
	| yol bilgisi oluşturulur. createClassMap() yöntemi için oluşturulmuştur.    			  |
	|          																				  |
	******************************************************************************************/
	private static function searchClassMap($directory = '')
	{
		static $classes;
		
		$directory = suffix($directory);
		
		$files = glob($directory.'*');
	
		if( ! empty($files) ) foreach($files as $v)
		{
			if( is_file($v) && extension($v) === 'php' )
			{
				$classEx = explode('/', $v);
				$classes[$v] = removeExtension(end($classEx));	
			}
			elseif( is_dir($v) )
			{
				self::searchClassMap($v);
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