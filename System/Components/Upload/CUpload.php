<?php
/************************************************************/
/*                    UPLOAD COMPONENT                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Upload;

use Config;
use Import;
/******************************************************************************************
* Config/Upload.php dosyasından Ini ayarlarını yapılandır.                                *
******************************************************************************************/
config::iniSet(config::get('Upload','settings'));
/******************************************************************************************
* UPLOAD                                                                                  *
*******************************************************************************************
| Dahil(Import) Edilirken : CUpload            							     		      |
| Sınıfı Kullanırken      :	$this->cupload->     									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class CUpload
{
	/* Settings Değişkeni
	 *  
	 * Yükleme ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $settings = array();
	
	/* File Değişkeni
	 *  
	 * Yüklenecek dosyanın yol bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $file;
	
	/* Extension Control Değişkeni
	 *  
	 * Yüklenecek dosyanın uzantı bilgisini
	 * kontrol etmesi için oluşturulmuştur.
	 *
	 */
	private $extension_control;	
	
	/* Errors Değişkeni
	 *  
	 * Yükleme işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $errors;
	
	/* Manuel Error Değişkeni
	 *  
	 * Elle oluşturulan hata bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $manuel_error;
	
	/* Encode Name Değişkeni
	 *  
	 * Şifrelenmiş dosya isim bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private $encode_name;
	
	/******************************************************************************************
	* EXTENSIONS                                                                      		  *
	*******************************************************************************************
	| Genel Kullanım: Yüklenecek dosya uzantılarını ayarlamak için kullanılır.  			  |
	|															                              |
	| Parametreler: Argüment parametresi vardır.                                              |
	| 1. argumentts var @extensions => Belirtilecek uzantılar.  			  			      |
	|          																				  |
	| Örnek Kullanım: ->extension('exe', 'jpg', 'gif')            							  |
	|          																				  |
	******************************************************************************************/
	public function extensions()
	{
		
		$args = func_get_args();
		
		if( ! empty($args ) )
		{
			$this->settings['extensions'] = $args;
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* ENCODE                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya ismi şifrelenmesi için kullanılır.	      						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @hash => Şifreleme algoritmalarından biri. Varsayılan:md5    		  	  |
	|          																				  |
	| Örnek Kullanım: ->encode(UPLOADS_DIR.'ornek.jpg')            							  |
	|          																				  |
	******************************************************************************************/
	public function encode($hash = 'md5')
	{
		if( isHash($hash) )
		{
			$this->settings['encryption'] = $hash;	
		}
		else
		{
			$this->settings['encryption'] = 'md5';
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* PREFIX                                                                           		  *
	*******************************************************************************************
	| Genel Kullanım: Dosya isminin başına ön ek getirilmesi için kullanılır.   			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @prefix => Ön ek.									         		  	  |
	|          																				  |
	| Örnek Kullanım: ->prefix('onek_')				            							  |
	|          																				  |
	******************************************************************************************/
	public function prefix($prefix = 'md5')
	{
		if( isChar($prefix) )
		{
			$this->settings['prefix'] = $prefix;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* MAXSIZE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın yüklenebilir maksimum boyutunu ayarlamak için kullanılır.      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @maxsize => Byte cinsinden boyut değeri.			         		  	  |
	|          																				  |
	| Örnek Kullanım: ->maxsize(2048) // 2048 Bytes	            						      |    
	|          																				  |
	******************************************************************************************/
	public function maxsize($maxsize = 'md5')
	{
		if( is_numeric($maxsize) )
		{
			$this->settings['maxsize'] = $maxsize;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* TARGET                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyanın nereye yükleneceğini belirtmek için kullanılır.		          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @target => Dosyaların yükleneceği dizin. Varsayılan:UPLOADS_DIR	  	      |
	|          																				  |
	| Örnek Kullanım: ->target('Uploads/') // 2048 Bytes	            					  |    
	|          																				  |
	******************************************************************************************/
	public function target($target = UPLOADS_DIR)
	{
		if( is_string($target) )
		{
			$this->settings['target'] = $target;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* SOURCE                                                                         		  *
	*******************************************************************************************
	| Genel Kullanım: Dosyaların yükleneceği input file nesnesinin ismi.      				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @target => Dosyaların alınacağı input file nesnesinin ismi.			      |
	|          																				  |
	| Örnek Kullanım: ->source('FILEUPLOAD') // <input type="file" name="FILEUPLOAD">	      |    
	|          																				  |
	******************************************************************************************/
	public function source($source = 'upload')
	{
		if( is_string($source) )
		{
			$this->settings['source'] = $source;	
		}
		
		return $this;
	}
	
	/******************************************************************************************
	* START                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Dosya yükleme işlemini başlatmak için kullanılır.				          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @filename => Yükleme yapılacak <input="file"> nesnesinin name değeri.	  |
	| 2. [ string var @rootdir ] => Dosyanın kaydedileceği dizin. Varsayılan:Uploads/	      |
	|          																				  |
	| Örnek Kullanım: start('fileupload', 'Aplication/Uploads');       		                  |
	|          																				  |
	******************************************************************************************/
	public  function start($filename = 'upload', $rootdir = UPLOADS_DIR)
	{	
		if( isset($this->settings['source']) ) 
		{
			$filename = $this->settings['source'];
		}
		
		if( isset($this->settings['target']) ) 
		{
			$rootdir = $this->settings['target'];
		}
		
		$this->file = $filename;

		$root = $rootdir;
		
		if( ! isset($_FILES[$filename]['name']) ) 
		{ 
			$this->manuel_error = 4; 
			return false; 
		}
		
		$name = $_FILES[$filename]['name'];		
		
		if( ! isset($this->settings['encryption']) ) 
		{
			$this->settings['encryption'] = true;
		}
		
		if( $this->settings['encryption'] ) 
		{
			$encryption = substr( hash( $this->settings['encryption'], uniqid(rand()) ), 0, 8 ).'-';
		}
		else 
		{
			$encryption = '';
		}
		
		if( isset($this->settings['extensions']) ) 
		{
			$extensions = $this->settings['extensions'];
		}
		
		// Çoklu yükleme yapılıyorsa.
		if( is_array($name) )
		{

			if( empty($name[0]) ) 
			{
				$this->manuel_error = 4; 
				return false; 
			}
			
			if( isset($this->settings['prefix']) ) 
			{
				$encryption = $this->settings['prefix']; 
			}
			
			for($index = 0; $index < count($name); $index++)
			{	
				$source = $_FILES[$filename]['tmp_name'][$index];
				
				$target = $root.'/'.$encryption.$name[$index];

				if( isset($this->settings['extensions']) && ! in_array(extension($name[$index]), $extensions) )
				{
					$this->extension_control = lang('Upload', 'extension_error');	
				}
				elseif( isset($this->settings['maxsize']) && $this->settings['maxsize'] < filesize($source) )
				{
					$this->manuel_error = 10;
				}
				else
				{
					if( ! is_file($rootdir) ) 
					{
						move_uploaded_file($source, $target); 
					}
					else 
					{
						$this->manuel_error = 9;
					}
				}
			}
		}	
		else
		{	
			if( empty($_FILES[$filename]['name']) ) 
			{ 
				$this->manuel_error = 4; 
				return false;
			}
			
			$source = $_FILES[$filename]['tmp_name'];
			
			if( isset($this->settings['maxsize']) && $this->settings['maxsize'] < filesize($source) )
			{
				$this->manuel_error = 10; 
				return false;
			}
			
			if( isset($this->settings["prefix"]) ) 
			{ 
				$encryption = $this->settings["prefix"];
			}
			
			$target = $root.'/'.$encryption.$name;
			
			$this->encode_name = $encryption.$name;
			
			if( isset($this->settings['extensions']) && ! in_array(extension($name),$extensions) )
			{
				$this->extension_control = lang('Upload', 'extension_error');	
			}
			else
			{	
				if( ! is_file($rootdir) ) 
				{
					move_uploaded_file($source,$target); 
				}
				else 
				{
					$this->manuel_error = 9;
				}				
			}
		}
	}
	
	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dosya yükleme işlemleri hakkında bilgi almak için kullanılır.			  |
	| Object veri türünde çıktı üretir.												          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $info = info();       		                  						  |
	| $info->name -> dosyanın adı      														  |  
	| $info->type -> dosyanın tipi        													  |
	| $info->size -> dosyanın boyutu      													  |
	| $info->error -> dosya yükleme sırasında hata var ise 1 değeri alır.        			  |
	| $info->tmp_name -> dosyanın tmp dizinindeki ismi.        								  |
	| $info->encode_name -> şifrelenen ismi.      											  |
	|          																				  |
	******************************************************************************************/
	public function info()
	{
		if( ! empty($_FILES[$this->file]) )
		{
			$datas = array
			(
				'name' 		=> $_FILES[$this->file]['name'],
				'type' 		=> $_FILES[$this->file]['type'],
				'size' 		=> $_FILES[$this->file]['size'],
				'tmp_name' 	=> $_FILES[$this->file]['tmp_name'],
				'error' 	=> $_FILES[$this->file]['error'],
				'encode_name' => $this->encode_name
			);
		
			$values = array();
			
			if( ! is_array($_FILES[$this->file]['name']) )foreach($datas as $key => $val)
			{
				$values[$key] = $val;
			}
			else
			{
				foreach($datas as $key => $val)
				{
					if( ! empty($datas[$key]) )
					{
						foreach($datas[$key] as $v)
						{
							$values[$key][] = $v;
						}
					}
				}
			}	
		}
		else
		{
			return false;	
		}
		
		return (object)$values;	
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
		if( ! isset($_FILES[$this->file]['error']) ) 
		{
			return lang('Upload', 'unknown_error');
		}
		
		$error_no = $_FILES[$this->file]['error'];
		//$error_no = $this->manuel_error;
		
		$this->errors = array
		(
			'0'  => "scc", 			  // Dosya başarı ile yüklendi. 
			'1'  => lang('Upload', '1'), // Php.ini dosyasındaki maximum dosya boyutu aşıldı. 
			'2'  => lang('Upload', '2'), // Formtaki max_file_size direktifindeki dosya boyutu limiti aşıldı. 
			'3'  => lang('Upload', '3'), // Dosya yükleme işlemi tamamlanmadı. 
			'4'  => lang('Upload', '4'), // Yüklenecek dosya yok. 
			'6'  => lang('Upload', '6'), // Dosyaların geçici olarak yükleneceği dizin bulunamadı. 
			'7'  => lang('Upload', '7'), // Dosya dik üzerine yazılamadı. 
			'8'  => lang('Upload', '8'), // Dosya yükleme uzantı desteği yok. 
			'9'  => lang('Upload', '9'), // Dosya yükleme yolu geçerli değil.
			'10' => lang('Upload', '10') // Belirlenen maksimum dosya boyutu aşıldı!
		);
		// Manuel belirlenen hata oluşmuşsa
		if( ! empty($this->manuel_error) )
		{
			return $this->errors[$this->manuel_error];
		}
		// Uzantıdan kaynaklı hata oluşmussa
		elseif( ! empty($this->extension_control) ) 
		{
			return $this->extension_control;
		}
		// Hata numarasına göre hata bildir.
		elseif( ! empty($this->errors[$error_no]) ) 
		{
			if( $this->errors[$error_no] === "scc" ) 
			{
				return false;
			}
			// 0 Dışında herhangi bir hata numarası oluşmussa
			return $this->errors[$error_no];
		}
		// Bu kontroller dışında hata oluşmussa bilinmeyen
		// hata uyarısı ver.	
		else 
		{
			return lang('Upload', 'unknown_error');
		}
	}
}