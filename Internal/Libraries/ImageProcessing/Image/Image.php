<?php
namespace ZN\ImageProcessing;

class InternalImage implements ImageInterface
{
	/***********************************************************************************/
	/* IMAGE LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Image
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: image::, $this->image, zn::$use->image, uselib('image')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Dir Name Değişkeni
	 *  
	 * Oluşturulan yeni resmin kaydedileceği dizin bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $dirName = 'thumbs';
	
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
	private $thumbPath;
	
	use \CallUndefinedMethodTrait;
	
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
	
	// Dosya yolu verisinde düzenleme yapılıyor.
	private function newPath($filePath)
	{
		$fileEx = explode("/", $filePath);
		
		$this->file = $fileEx[count($fileEx) - 1];
	
		$this->thumbPath = substr($filePath,0,strlen($filePath) - strlen($this->file)).$this->dirName;
	
		$this->thumbPath = suffix($this->thumbPath);	
		
		$this->thumbPath = str_replace(baseUrl(), "", $this->thumbPath);
	}
	
	// Uzantı kontrolü yapıyor.
	private function fromFileType($paths)
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
	private function isImageFile($file)
	{
		$extensions = ['jpg', 'jpeg', 'png', 'gif'];
		
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
	private function createFileType($files, $paths, $quality = 0)
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
	public function thumb($fpath = '', $set = [])
	{
		// Parametre kontrolleri yapılıyor -------------------------------------------
		if( ! is_string($fpath) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'fpath');
		}
		if( ! is_array($set) )
		{
			$set = [];
		}
		// ---------------------------------------------------------------------------
		
		$filePath = ( isset($fpath) ) 
					 ? trim($fpath) 
					 : '';
		
		// Yol bilgis url eki içeriyorsa 
		// bu ekin temizlenmesi sağlanıyor.
		if( strstr($filePath, baseUrl()) ) 
		{
			$filePath = str_replace(baseUrl(), '', $filePath);
		}
		
		// Geçersiz yol bilgisi girilmiş ise
		// Durumu rapor etmesi sağlanıyor.
		if( ! file_exists($filePath) )
		{
			return \Errors::set('Image', 'notFoundError', $filePath);	
		}
		
		// Dosyanın uzantısı belirlenen uzantılır dışında
		// ise durumu rapor etmesi sağlanıyor.
		if( ! $this->isImageFile($filePath) )
		{
			return \Errors::set('Image', 'notImageFileError', $filePath);	
		}
		
		// Ayarlar parametresinde tanımlayan ayarlara
		// varsayılan değerler atanıyor.
		list($currentWidth, $currentHeight) = getimagesize($filePath);
		
		// WIDTH Ayarı
		$width 			= ( isset($set["width"]) ) 		
						  ? $set["width"] 		
						  : $currentWidth;
		
		// HEIGHT Ayarı				  
		$height 		= ( isset($set["height"]) ) 		
					      ? $set["height"] 		
						  : $currentHeight;
		
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
			if( $set["proheight"] < $currentHeight )
			{
				/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
				$height = $set["proheight"];
				 
				/* resmin yeni genişliği buluyoruz */
				$width = round(($currentWidth * $height) / $currentHeight);
			}
		}
		
		if( isset($set["prowidth"]) )
		{
			if( $set["prowidth"] < $currentWidth )
			{
				/* resmi ölçeklemek istediğimiz yükseklik ve genişlik */
				$width = $set["prowidth"];
				 
				/* resmin yeni genişliği buluyoruz */
				$height = round(($currentHeight * $width) / $currentWidth);
			}
		}
	
		$rWidth = $width; $rHeight = $height;
		
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
		
		$this->newPath($filePath);
		
		// Dizin bilgisi kontrol ediliyor.
		// Eğer thumb isminde bir dizin
		// yoksa oluşturuluyor.
		if( ! is_dir($this->thumbPath) ) 
		{ 
			\Folder::create($this->thumbPath);		
		}
		
		// Dosya uzantısı temizleniyor.
		$newFile = removeExtension($this->file).$prefix.extension($this->file, true);
		
		// Yeni oluşturulan dosya varsa yeni dosyanın 
		// yol ve isim bilgisi oluşturuluyor.
		// Ve geri dönüş değeri olarak kulllanılıyor.
		// Böyle bir dosya daha önce yoksa
		// İşlemler kaldığı yerden dosya oluşturulana
		// kadar devam ediyor.
		if( file_exists($this->thumbPath.$newFile) ) 
		{
			return baseUrl($this->thumbPath.$newFile);
		}
				
		$rFile   = $this->fromFileType($filePath);
		
		$nFile   = imagecreatetruecolor($width, $height);
		
		if( isset($set["prowidth"]) || isset($set["proheight"]) )
		{
			$rWidth = $currentWidth; $rHeight = $currentHeight;
		}
	
		// Dosyanın .png uzantılı olması durumunda
		// Kırpma işlemlerinin transparant olması
		// sağlanıyor. Diğer uzantılarda transparantlık 
		// elde edilemeyeceğinden bu işlem sadece
		// PNG uzantılı dosyalar için gerçekleşecektir.
		if( extension($filePath) === "png" )
		{
			imagealphablending($nFile, false);
			imagesavealpha($nFile,true);
			$transparent = imagecolorallocatealpha($nFile, 255, 255, 255, 127);
			imagefilledrectangle($nFile, 0, 0, $width, $height, $transparent);
		}
		
		@imagecopyresampled($nFile, $rFile,  0, 0, $x, $y, $width, $height, $rWidth, $rHeight);
			
		$this->createFileType($nFile ,$this->thumbPath.$newFile, $quality);
		
		imagedestroy($rFile); imagedestroy($nFile);	
		
		return baseUrl($this->thumbPath.$newFile);
		
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
	public function getProsize($path = '', $width = 0, $height = 0)
	{
		// Parametre kontrolleri yapılıyor. ------------------------------------------
		if( ! is_string($path) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'path');
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
			return \Errors::set('Image', 'notFoundError', $path);	
		}
		// ---------------------------------------------------------------------------
		
		// Yola göre resmin boyutları isteniyor.
		$g = @getimagesize($path);
		
		// Boyut bilgisi boş ise durumun raporlanması isteniyor.
		if( empty($g) )
		{
			return \Errors::set('Image', 'notFoundError', $path);	
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
}