<?php
/************************************************************/
/*                     CLASS IMAGE                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* IMAGE                                                                            	      *
*******************************************************************************************
| Dahil(Import) Edilirken : Image   							                          |
| Sınıfı Kullanırken      :	image::   											          |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Image
{
	/* Dir Name Değişkeni
	 *  
	 * Oluşturulan yeni resmin kaydedileceği dizin bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $dir_name = 'thumbs';
	
	/* Fıle Değişkeni
	 *  
	 * Dosyanın yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $file;
	
	/* Thumb Path Değişkeni
	 *  
	 * Thumb dosyası için yol bilgini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $thumb_path;
	
	/* Error Değişkeni
	 *  
	 * Ftp işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $error;
	
	// Dosya yolu verisinde düzenleme yapılıyor.
	private static function new_path($file_path)
	{
		$file_ex = explode("/", $file_path);
		
		self::$file = $file_ex[count($file_ex) - 1];
	
		self::$thumb_path = substr($file_path,0,strlen($file_path) - strlen(self::$file)).self::$dir_name;
	
		self::$thumb_path = suffix(self::$thumb_path);	
		
		self::$thumb_path = str_replace(base_url(), "", self::$thumb_path);
	}
	
	// Uzantı kontrolü yapıyor.
	private static function from_file_type($paths)
	{
		
		// UZANTI JPG
		if( extension(self::$file) === 'jpg' )
		{ 
			return imagecreatefromjpeg($paths);
		}
		// UZANTI JPEG
		elseif( extension(self::$file) === 'jpeg' ) 
		{
			return imagecreatefromjpeg($paths);
		}
		// UZANTI PNG
		elseif( extension(self::$file) === 'png' )
		{
			return imagecreatefrompng($paths);
		}
		// UZANTI GIF
		elseif( extension(self::$file) === 'gif' )  
		{
			return imagecreatefromgif($paths);
		}
		else 
		{
			return false;
		}
	}
	
	// Dosya uzantısı kontrol ediliyor.
	private static function is_image_file($file)
	{
		$extensions = array('jpg', 'jpeg', 'png', 'gif');
		
		if( in_array(extension($file), $extensions))
		{
			return true;	
		}
		else
		{
			return false;	
		}
	}
	
	// Dosya uzantısına göre oluşturulucak image dosyası.
	// Aynı zamanda uzantılara göre kalite parametresi ayarlanıyor.
	private static function create_file_type($files, $paths, $quality = 0)
	{
		// JPG İÇİN KALİTE AYARI
		if( extension(self::$file) === 'jpg' )
		{
			if( $quality === 0 ) 
			{
				$quality = 80;
			}
			
			return imagejpeg($files, $paths, $quality);
		}
		// JPEG İÇİN KALİTE AYARI
		elseif( extension(self::$file) === 'jpeg' )
		{
			if( $quality === 0 ) 
			{
				$quality = 80;
			}
			
			return imagejpeg($files, $paths, $quality);
		}
		// PNG İÇİN KALİTE AYARI
		elseif( extension(self::$file) === 'png' )
		{
			if( $quality === 0 )
			{
				$quality = 8;
			}
			
			return imagepng($files, $paths, $quality);
		}
		// GIF İÇİN KALİTE AYARI
		elseif( extension(self::$file) === 'gif' )
		{
			return imagegif($files, $paths);
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* THUMB                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Resmi ölçeklendirip ölçeklenen yeni resmin yolunu verir.  	          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @fpath => Ölçeklendirilmek istenen resim.	  						      |
	| 2. array var @settings => Resim üzerinde değişiklik yapmayı sağlayan ayarlar.	          |
	|          																				  |
	| Örnek Kullanım: thumb('ornek/resim.jpg', array(Ayarlar));        	  		              |      
	|          																				  |
	| 2. Ayarlar Parametresinin Kullanılabilir Parametreleri.         						  |
	|																						  |
	| 1. x => Resmi yatay düzlemde kaçıncı pixelden kırpmaya başlayacağını ifade eder.        |
	| 2. y => Resmi dikey düzlemde kaçıncı pixelden kırpmaya başlayacağı ifade eder.          |
	| 3. width => Resmin kırpma genişliğini belirlemek için kullanılır.                       |
	| 4. height => Resmin kırpma yüksekliğini belirlemek için kullanılır.                     |
	| 5. rewidth => Resmin yeni genişlik değer ayarlanır.                                     |
	| 6. reheight => Resmin yeni yükseklik değer ayarlanır.                                   |
	| 7. prowidth  => Eğer genişlik fazla ise bu ayara göre resmin yükseklik değeri otomatik  |
	| olarak orantılı ayarlanır.                                  							  |
	| 8. proheight => Eğer yükseklik fazla ise bu ayara göre resmin genişlik değeri otomatik  |
	| olarak orantılı ayarlanır.                                   				              |
	| 9. quality  => Resmin kalitesini ayarlamak için kullanılır.                             |
	|          																				  |
	******************************************************************************************/	
	public static function thumb($fpath = '', $set = array())
	{
		// Parametre kontrolleri yapılıyor -------------------------------------------
		if( ! is_string($fpath) ) 
		{
			return false;
		}
		if( ! is_array($set) )
		{
			$set = array();
		}
		// ---------------------------------------------------------------------------
		
		$file_path = ( isset($fpath) ) 
					 ? trim($fpath) 
					 : '';
		
		// Yol bilgis url eki içeriyorsa 
		// bu ekin temizlenmesi sağlanıyor.
		if( strstr($file_path, base_url()) ) 
		{
			$file_path = str_replace(base_url(), '', $file_path);
		}
		
		// Geçersiz yol bilgisi girilmiş ise
		// Durumu rapor etmesi sağlanıyor.
		if( ! file_exists($file_path) )
		{
			self::$error = get_message('Image', 'not_found_error', $file_path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		
		// Dosyanın uzantısı belirlenen uzantılır dışında
		// ise durumu rapor etmesi sağlanıyor.
		if( ! self::is_image_file($file_path) )
		{
			self::$error = get_message('Image', 'not_image_file_error', $file_path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		
		// Ayarlar parametresinde tanımlayan ayarlara
		// varsayılan değerler atanıyor.
		list($current_width, $current_height) = getimagesize($file_path);
		
		// WIDTH Ayarı
		$width 			= ( isset($set["width"]) ) 		
						  ? $set["width"] 		
						  : $current_width;
		
		// HEIGHT Ayarı				  
		$height 		= ( isset($set["height"]) ) 		
					      ? $set["height"] 		
						  : $current_height;
		
		// REWIDTH Ayarı				  
		$rewidth 		= ( isset($set["rewidth"]) ) 		
						  ? $set["rewidth"] 		
						  : 0;
		
		// REHEIGHT Ayarı					  
		$reheight 		= ( isset($set["reheight"]) ) 	
						  ? $set["reheight"]		
						  : 0;
		
		// X Ayarı
		$x				= ( isset($set["x"]) ) 			
						  ? $set["x"] 			
						  : 0;
		
		// Y Ayarı				  
		$y				= ( isset($set["y"]) ) 			
						  ? $set["y"] 			
						  : 0;
		
		// QUALITY Ayarı				  
		$quality 		= ( isset($set["quality"]) ) 		
						  ? $set["quality"] 		
						  : 0;
		
		if( isset($set["proheight"]) )
		{
			if( $set["proheight"] < $current_height )
			{
				/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
				$height = $set["proheight"];
				 
				/* resmin yeni genişliği buluyoruz */
				$width = round(($current_width * $height) / $current_height);
			}
		}
		
		if( isset($set["prowidth"]) )
		{
			if( $set["prowidth"] < $current_width )
			{
				/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
				$width = $set["prowidth"];
				 
				/* resmin yeni genişliği buluyoruz */
				$height = round(($current_height * $width) / $current_width);
			}
		}
	
		$r_width = $width; $r_height = $height;
		
		// Yeni genişlik değerinin kontrolü yapılıyor.
		if( ! empty($rewidth) ) 
		{
			$width = $rewidth;
		}
		
		// Yeni yükseklik değerinin kontrolü yapılıyor.
		if( ! empty($reheight) ) 
		{
			$height = $reheight;
		}
		
		// Oluşturulacak yeni dosyanın isim bilgisi oluşturuluyor.
		// Bu isimlendirmede şu bilgiler yer alacak.
		// 1-Resmin Adı
		// 2-X değeri
		// 3-Y değeri
		// 4-Genişlik Değeri
		// 5-Yükseklik Değeri
		$prefix = "-".$x."x".$y."px-".$width."x".$height."size";
		
		self::new_path($file_path);
		
		// Dizin bilgisi kontrol ediliyor.
		// Eğer thumb isminde bir dizin
		// yoksa oluşturuluyor.
		if( ! is_dir(self::$thumb_path) ) 
		{ 
			folder::create(self::$thumb_path);		
		}
		
		// Dosya uzantısı temizleniyor.
		$exten_clean = str_replace(extension(self::$file, true), '', self::$file);
		
		$new_file = $exten_clean.$prefix.extension(self::$file, true);
		
		// Yeni oluşturulan dosya varsa yeni dosyanın 
		// yol ve isim bilgisi oluşturuluyor.
		// Ve geri dönüş değeri olarak kulllanılıyor.
		// Böyle bir dosya daha önce yoksa
		// İşlemler kaldığı yerden dosya oluşturulana
		// kadar devam ediyor.
		if( file_exists(self::$thumb_path.$new_file) ) 
		{
			return base_url(self::$thumb_path.$new_file);
		}
		
		$r_file   = self::from_file_type($file_path);
		
		$n_file   = imagecreatetruecolor($width, $height);
		
		if( isset($set["prowidth"]) || isset($set["proheight"]) )
		{
			$r_width = $current_width; $r_height = $current_height;
		}
	
		// Dosyanın .png uzantılı olması durumunda
		// Kırpma işlemlerinin transparant olması
		// sağlanıyor. Diğer uzantılarda transparantlık 
		// elde edilemeyeceğinden bu işlem sadece
		// PNG uzantılı dosyalar için gerçekleşecektir.
		if( extension($file_path) === "png" )
		{
			imagealphablending($n_file, false);
			imagesavealpha($n_file,true);
			$transparent = imagecolorallocatealpha($n_file, 255, 255, 255, 127);
			imagefilledrectangle($n_file, 0, 0, $width, $height, $transparent);
		}
		
		@imagecopyresampled($n_file, $r_file,  0, 0, $x, $y, $width, $height, $r_width, $r_height);
			
		self::create_file_type($n_file ,self::$thumb_path.$new_file, $quality);
		
		imagedestroy($r_file); imagedestroy($n_file);	
		
		return base_url(self::$thumb_path.$new_file);
		
	}
	
	/******************************************************************************************
	* SIZE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Yolu belirtilen dosyanın boyutunu verilen genişlik veya yükseklik 	  |
	| değerine göre orantılı şekilde almak için kullanılır.  	                              |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @fpath => Boyutu istenen resim dosyasının yolu.	  						  |
	| 2. numeric var @width => Resmin genişlik ölçüsünün belirlenmesi.	                      |
	| 3. numeric var @height => Resmin yükseklik ölçüsünün belirlenmesi.	                  |
	|          																				  |
	| Örnek Kullanım: size('ornek/resim.jpg', 10);        	  		                          |      
	|          																				  |
	| Not: Genişlik veya yükseklik parametrelerinden sadece bir tanesi kullanılmalıdır.       |
	|          																				  |
	******************************************************************************************/	
	public static function get_prosize($path = '', $width = 0, $height = 0)
	{
		// Parametre kontrolleri yapılıyor. ------------------------------------------
		if( ! is_string($path) ) 
		{
			return false;
		}
		if( ! is_numeric($width) )
		{
			$width = 0;
		}
		if( ! is_numeric($height) ) 
		{
			$height = 0;
		}
		if( empty($path) )
		{
			self::$error = get_message('Image', 'not_found_error', $path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		// ---------------------------------------------------------------------------
		
		// Yola göre resmin boyutları isteniyor.
		$g = @getimagesize($path);
		
		// Boyut bilgisi boş ise durumun raporlanması isteniyor.
		if( empty($g) )
		{
			self::$error = get_message('Image', 'not_found_error', $path);
			report('Error', self::$error, 'ImageLibrary');
			return false;	
		}
		
		$x = $g[0]; $y = $g[1];
		
		// Genişliğe göre yüksekliği orantılar.
		if( $width > 0 )
		{
			if($width <= $x)
			{
				$o = $x / $width;
				
				$x = $width;
				
				$y = $y / $o;
			}
			else
			{
				$o = $width / $x;
				
				$x = $width;
				
				$y = $y * $o;	
			}
		}
		
		// Yüksekliğe göre genişliği orantılar.
		if($height > 0)
		{
			if($height <= $y)
			{
				$o = $y / $height;
				
				$y = $height;
				
				$x = $x / $o;
			}
			else
			{
				$o = $height / $y;
				
				$y = $height;
				
				$x = $x * $o;	
			}
		}
		
		$array["width"] = round($x); $array["height"] = round($y);
		
		return (object)$array;
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Image işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
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