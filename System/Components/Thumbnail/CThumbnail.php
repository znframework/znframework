<?php
/************************************************************/
/*                   THUMBNAIL COMPONENT                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Thumbnail;

use Folder;
/******************************************************************************************
* THUMBNAIL                                                                               *
*******************************************************************************************
| Dahil(Import) Edilirken : CThumbnail            							     		  |
| Sınıfı Kullanırken      :	$this->cthumbnail->     					     				  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class CThumbnail
{
	/* Dir Name Değişkeni
	 *  
	 * Oluşturulan yeni resmin kaydedileceği dizin bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $dir_name = 'thumbs';
	
	/* Fıle Değişkeni
	 *  
	 * Dosyanın yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $file;
	
	/* Thumb Path Değişkeni
	 *  
	 * Thumb dosyası için yol bilgini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $thumb_path;
	
	/* Setingss Değişkeni
	 *  
	 * Resim işlemeleri ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	 private $sets;
	
	/* Error Değişkeni
	 *  
	 * Ftp işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $error;
	
	// Dosya yolu verisinde düzenleme yapılıyor.
	private function new_path($file_path)
	{
		$file_ex = explode("/", $file_path);
		
		$this->file = $file_ex[count($file_ex) - 1];
	
		$this->thumb_path = substr($file_path,0,strlen($file_path) - strlen($this->file)).$this->dir_name;
	
		$this->thumb_path = suffix($this->thumb_path);	
		
		$this->thumb_path = str_replace(base_url(), "", $this->thumb_path);
	}
	
	// Uzantı kontrolü yapıyor.
	private function from_file_type($paths)
	{
		
		// UZANTI JPG
		if( extension($this->file) === 'jpg' )
		{ 
			return imagecreatefromjpeg($paths);
		}
		// UZANTI JPEG
		elseif( extension($this->file) === 'jpeg' ) 
		{
			return imagecreatefromjpeg($paths);
		}
		// UZANTI PNG
		elseif( extension($this->file) === 'png' )
		{
			return imagecreatefrompng($paths);
		}
		// UZANTI GIF
		elseif( extension($this->file) === 'gif' )  
		{
			return imagecreatefromgif($paths);
		}
		else 
		{
			return false;
		}
	}
	
	// Dosya uzantısı kontrol ediliyor.
	private function is_image_file($file)
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
	private function create_file_type($files, $paths, $quality = 0)
	{
		// JPG İÇİN KALİTE AYARI
		if( extension($this->file) === 'jpg' )
		{
			if( $quality === 0 ) 
			{
				$quality = 80;
			}
			
			return imagejpeg($files, $paths, $quality);
		}
		// JPEG İÇİN KALİTE AYARI
		elseif( extension($this->file) === 'jpeg' )
		{
			if( $quality === 0 ) 
			{
				$quality = 80;
			}
			
			return imagejpeg($files, $paths, $quality);
		}
		// PNG İÇİN KALİTE AYARI
		elseif( extension($this->file) === 'png' )
		{
			if( $quality === 0 )
			{
				$quality = 8;
			}
			
			return imagepng($files, $paths, $quality);
		}
		// GIF İÇİN KALİTE AYARI
		elseif( extension($this->file) === 'gif' )
		{
			return imagegif($files, $paths);
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* PATH                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: İşlem görecek resim dosyasının yolu.	      							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Resmin yolu.  			  									  	  |
	|          																				  |
	| Örnek Kullanım: ->path(UPLOADS_DIR.'ornek.jpg')            							  |
	|          																				  |
	******************************************************************************************/
	public function path($file = '')
	{
		if( ! is_string($file) )
		{
			return $this;	
		}
	
		if( ! empty($file) )
		{
			$this->sets['filepath'] = $file;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* QUALITY                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Resmin kalitesini ayarlamak için kullanılır.	        				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @quality => Resmin yolu.  			  									  |
	|          																				  |
	| Örnek Kullanım: ->quality(80)            							  					  |
	|          																				  |
	******************************************************************************************/
	public function quality($quality = 0)
	{
		if( ! is_numeric($quality) )
		{
			return $this;	
		}
	
		if( ! empty($quality) )
		{
			$this->sets['quality'] = $quality;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* CROP                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Kırpılacak resimde x ve ye değerlerini belirtmek için kullanılır.	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @x => Yatay düzlemde kırpmaya kaçıncı pikselden başlanacağı.  			  |
	| 2. numeric var @y => Dikey düzlemde kırpmaya kaçıncı pikselden başlanacağı.  			  |
	|          																				  |
	| Örnek Kullanım: ->crop(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function crop($x = 0, $y = 0)
	{
		if( ! ( is_numeric($x) && is_numeric($y) ) )
		{
			return $this;	
		}
	
		if( ! empty($x) )
		{
			$this->sets['x'] = $x;
		}
		
		if( ! empty($y) )
		{
			$this->sets['y'] = $y;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SIZE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Resmin boyutunu ayarlamak için kullanılır.     						  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Resmin genişlik değeri.  			  						  |
	| 2. numeric var @height => Resmin yükseklik değeri.  			  						  |
	|          																				  |
	| Örnek Kullanım: ->size(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function size($width = 0, $height = 0)
	{
		if( ! ( is_numeric($width) && is_numeric($height) ) )
		{
			return $this;	
		}
	
		if( ! empty($width) )
		{
			$this->sets['width'] = $width;
		}
		
		if( ! empty($height) )
		{
			$this->sets['height'] = $height;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* RESIZE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Yeniden boyutlandırılacak resmin genişlik ve yükseklik değelerini 	  |
	| ayarlamak için kullanılır.	      													  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Resmin genişlik değeri.  			  						  |
	| 2. numeric var @height => Resmin yükseklik değeri.  			  						  |
	|          																				  |
	| Örnek Kullanım: ->resize(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function resize($width = 0, $height = 0)
	{
		if( ! ( is_numeric($width) && is_numeric($height) ) )
		{
			return $this;	
		}
	
		if( ! empty($width) )
		{
			$this->sets['rewidth'] = $width;
		}
		
		if( ! empty($height) )
		{
			$this->sets['reheight'] = $height;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* PROSIZE                                                                           	  *
	*******************************************************************************************
	| Genel Kullanım: Orantılı boyutlandırılacak resmin genişlik ve yükseklik değelerini 	  |
	| ayarlamak için kullanılır.	      													  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @width => Resmin genişlik değeri.  			  						  |
	| 2. numeric var @height => Resmin yükseklik değeri.  			  						  |
	|          																				  |
	| Örnek Kullanım: ->prosize(60, 10)            								      		  |
	|          																				  |
	******************************************************************************************/
	public function prosize($width = 0, $height = 0)
	{
		if( ! ( is_numeric($width) && is_numeric($height) ) )
		{
			return $this;	
		}
	
		if( ! empty($width) )
		{
			$this->sets['prowidth'] = $width;
		}
		
		if( ! empty($height) )
		{
			$this->sets['proheight'] = $height;
		}
		
		return $this;
	}
	
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Resmi ölçeklendirip ölçeklenen yeni resmin yolunu verir.  	          |
	|															                              |
	| Parametreler: tek parametresi vardır.                                              	  |
	| 1. string var @fpath => Ölçeklendirilmek istenen resim.	  						      |
	|          																				  |
	******************************************************************************************/	
	public function create($fpath = '')
	{
		
		// Parametre kontrolleri yapılıyor -------------------------------------------
		$fpath = ( isset($this->sets['filepath']) )
				 ? $this->sets['filepath']
				 : $fpath;
		// ---------------------------------------------------------------------------
		
		$file_path = ( isset($fpath) ) 
					 ? trim($fpath) 
					 : '';
		
		// Yol bilgisi url eki içeriyorsa 
		// bu ekin temizlenmesi sağlanıyor.
		if( strstr($file_path, base_url()) ) 
		{
			$file_path = str_replace(base_url(), '', $file_path);
		}
		
		// Geçersiz yol bilgisi girilmiş ise
		// Durumu rapor etmesi sağlanıyor.
		if( ! file_exists($file_path) )
		{
			$this->error = get_message('Image', 'not_found_error', $file_path);
			report('Error', $this->error, 'ImageLibrary');
			return false;	
		}
		
		// Dosyanın uzantısı belirlenen uzantılır dışında
		// ise durumu rapor etmesi sağlanıyor.
		if( ! $this->is_image_file($file_path) )
		{
			$this->error = get_message('Image', 'not_image_file_error', $file_path);
			report('Error', $this->error, 'ImageLibrary');
			return false;	
		}
		
		// Ayarlar parametresinde tanımlayan ayarlara
		// varsayılan değerler atanıyor.
		list($current_width, $current_height) = getimagesize($file_path);
		
		// WIDTH Ayarı
		$width 			= ( isset($this->sets["width"]) ) 		
						  ? $this->sets["width"] 		
						  : $current_width;
		
		// HEIGHT Ayarı				  
		$height 		= ( isset($this->sets["height"]) ) 		
					      ? $this->sets["height"] 		
						  : $current_height;
		
		// REWIDTH Ayarı				  
		$rewidth 		= ( isset($this->sets["rewidth"]) ) 		
						  ? $this->sets["rewidth"] 		
						  : 0;
		
		// REHEIGHT Ayarı					  
		$reheight 		= ( isset($this->sets["reheight"]) ) 	
						  ? $this->sets["reheight"]		
						  : 0;
		
		// X Ayarı
		$x				= ( isset($this->sets["x"]) ) 			
						  ? $this->sets["x"] 			
						  : 0;
		
		// Y Ayarı				  
		$y				= ( isset($this->sets["y"]) ) 			
						  ? $this->sets["y"] 			
						  : 0;
		
		// QUALITY Ayarı				  
		$quality 		= ( isset($this->sets["quality"]) ) 		
						  ? $this->sets["quality"] 		
						  : 0;
		
		if( isset($this->sets["proheight"]) )
		{
			if( $this->sets["proheight"] < $current_height )
			{
				/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
				$height = $this->sets["proheight"];
				 
				/* resmin yeni genişliği buluyoruz */
				$width = round(($current_width * $height) / $current_height);
			}
		}
		
		if( isset($this->sets["prowidth"]) )
		{
			if( $this->sets["prowidth"] < $current_width )
			{
				/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
				$width = $this->sets["prowidth"];
				 
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
		
		$this->new_path($file_path);
		
		// Dizin bilgisi kontrol ediliyor.
		// Eğer thumb isminde bir dizin
		// yoksa oluşturuluyor.
		if( ! is_dir($this->thumb_path) ) 
		{ 
			folder::create($this->thumb_path);		
		}
		
		// Dosya uzantısı temizleniyor.
		$exten_clean = str_replace(extension($this->file, true), '', $this->file);
		
		$new_file = $exten_clean.$prefix.extension($this->file, true);
		
		// Yeni oluşturulan dosya varsa yeni dosyanın 
		// yol ve isim bilgisi oluşturuluyor.
		// Ve geri dönüş değeri olarak kulllanılıyor.
		// Böyle bir dosya daha önce yoksa
		// İşlemler kaldığı yerden dosya oluşturulana
		// kadar devam ediyor.
		if( file_exists($this->thumb_path.$new_file) ) 
		{
			return base_url($this->thumb_path.$new_file);
		}
		
		$r_file   = $this->from_file_type($file_path);
		
		$n_file   = imagecreatetruecolor($width, $height);
		
		if( isset($this->sets["prowidth"]) || isset($this->sets["proheight"]) )
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
			
		$this->create_file_type($n_file ,$this->thumb_path.$new_file, $quality);
		
		imagedestroy($r_file); imagedestroy($n_file);	
		
		$this->sets = NULL;
		
		return base_url($this->thumb_path.$new_file);
		
	}
	
	/******************************************************************************************
	* GET PROSIZE                                                                             *
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
	public function get_prosize($width = 0, $height = 0)
	{
		// Parametre kontrolleri yapılıyor. ------------------------------------------
	
		if( ! is_numeric($width) )
		{
			$width = 0;
		}
		if( ! is_numeric($height) ) 
		{
			$height = 0;
		}
		
		if( isset($this->sets['filepath']) )
		{
			$path = $this->sets['filepath'];
			
			$this->sets['filepath'] = NULL;
		}
		else
		{
			$path = '';	
		}
				 
		if( empty($path) )
		{
			$this->error = get_message('Image', 'not_found_error', $path);
			report('Error', $this->error, 'ImageLibrary');
			return false;	
		}
		// ---------------------------------------------------------------------------	
		
		// Yola göre resmin boyutları isteniyor.
		$g = @getimagesize($path);
		
		// Boyut bilgisi boş ise durumun raporlanması isteniyor.
		if( empty($g) )
		{
			$this->error = get_message('Image', 'not_found_error', $path);
			report('Error', $this->error, 'ImageLibrary');
			return false;	
		}
		
		$x = $g[0]; $y = $g[1];
		
		// Genişliğe göre yüksekliği orantılar.
		if( $width > 0 )
		{
			if( $width <= $x )
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
		if( $height > 0 )
		{
			if( $height <= $y )
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