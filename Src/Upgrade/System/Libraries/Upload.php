<?php
/************************************************************/
/*                       CLASS UPLOAD                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
config::iniset(config::get('Upload','settings'));
class Upload
{
	private static $settings = array();
	private static $file;
	private static $extension_control;
	private static $setting_status = false;
	private static $errors;
	private static $manuel_error;
	private static $encode_name;
	
	// Upload ayarlarını yapmak için kullanılır.
	// @params
	/*
		1-extensions -> Dosyanın uzantısı
		2-encode -> Dosyanın şifrelenmesi
		3-prefix -> Yüklenen dosyaların önüne ön ek koymak
		4-mazsize -> Yükselenecebilecek maksimum dosya boyutu
	*/
	
	public static function settings($set = array())
	{
		if( ! is_array($set)) $set = array();
		
		self::$setting_status = true;
		
		if(isset($set['extensions'])) 	self::$settings['extensions'] 	= $set['extensions'];
		if(isset($set['encode'])) 		self::$settings['encryption'] 	= $set['encode'];
		if(isset($set['prefix'])) 		self::$settings['prefix'] 		= $set['prefix'];
		if(isset($set['maxsize'])) 		self::$settings['maxsize'] 		= $set['maxsize'];
	}
	
	// Upload işlemini başlatır
	// @param filename => upload işlemini yapan form aracının adı
	// @param rootdir => upload edilecek yer
	
	public static function start($filename = 'upload', $rootdir = UPLOADS_DIR)
	{	
		if( ! is_string($filename)) return false;
		if( ! is_string($rootdir)) $rootdir = UPLOADS_DIR;
		
		if(self::$setting_status == false) self::settings();
		
		import::language('Upload');
		
		self::$file = $filename;

		$root = $rootdir;
		
		if( ! isset($_FILES[$filename]['name'])) { self::$manuel_error = 4; return false; }
		
		$name = $_FILES[$filename]['name'];		
		
		if(!isset(self::$settings['encryption'])) self::$settings['encryption'] = 1;
		if(self::$settings['encryption'] == 1) $encryption = substr(md5(uniqid(rand())),0,8).'-';
		else $encryption = '';
		
		if( isset(self::$settings['extensions']) ) $extensions = explode("|",self::$settings['extensions']);
		
		
		if(is_array($name))
		{

			if(empty($name[0])) {self::$manuel_error = 4; return false; }
			
			if(isset(self::$settings['prefix'])) $encryption = self::$settings['prefix']; 
			
			for($index = 0; $index < count($name); $index++)
			{	
				$source = $_FILES[$filename]['tmp_name'][$index];
				$target = $root.'/'.$encryption.$name[$index];

				if(isset(self::$settings['extensions']) && !in_array(extension($name[$index]),$extensions))
				{
					self::$extension_control = lang('upload_extension_error');	
				}
				elseif(isset(self::$settings['maxsize']) && self::$settings['maxsize'] < filesize($source))
				{
					self::$manuel_error = 10;
				}
				else
				{
					if( ! is_file($rootdir)) move_uploaded_file($source,$target); else self::$manuel_error = 9;
				}
			}
		}	
		else
		{
		
			if(empty($_FILES[$filename]['name'])) { self::$manuel_error = 4; return false;}
			
			$source = $_FILES[$filename]['tmp_name'];
			
			if(isset(self::$settings['maxsize']) && self::$settings['maxsize'] < filesize($source))
			{
				self::$manuel_error = 10; return false;
			}
			
			if(isset(self::$settings["prefix"])) { $encryption = self::$settings["prefix"];}
			$target = $root.'/'.$encryption.$name;
			
			self::$encode_name = $encryption.$name;
			
			if(isset(self::$settings['extensions']) && ! in_array(extension($name),$extensions))
			{
				self::$extension_control = lang('upload_extension_error');	
			}
			else
			{	
	
				if( ! is_file($rootdir)) move_uploaded_file($source,$target); else self::$manuel_error = 9;
				
				
			}
		}
	}
	
	// Upload edilen dosya bilgileri
	// $params
	/*
		1-name -> dosyanın adı
		2-type -> dosyanın tipi
		3-size -> dosyanın boyutu
		4-tmp_name -> dosyanın temp yolundaki adı
		5-error -> dosya yükleme sırasında hata var ise 1 değeri alır.
	*/
	
	public static function info()
	{
		if( ! empty($_FILES[self::$file]))
		{
			$datas = array
			(
				'name' 		=> $_FILES[self::$file]['name'],
				'type' 		=> $_FILES[self::$file]['type'],
				'size' 		=> $_FILES[self::$file]['size'],
				'tmp_name' 	=> $_FILES[self::$file]['tmp_name'],
				'error' 	=> $_FILES[self::$file]['error'],
				'encode_name' => self::$encode_name
			);
		
			$values = array();
			
			if( ! is_array($_FILES[self::$file]['name']))foreach($datas as $key => $val)
			{
				$values[$key] = $val;
			}
			else
			{
				foreach($datas as $key => $val)
				{
					if( ! empty($datas[$key]))
					foreach($datas[$key] as $v)
					{
						$values[$key][] = $v;
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
	
	// Dosya yüklenmesi sırasında herhangi bir hata var ise ekrana verir.
	// Dosya yüklenmesi sırasında sonucu çevirir.
	
	public static function error()
	{
		import::language('Upload');
		
		if( ! isset($_FILES[self::$file]['error'])) return lang('upload_unknown_error');
		
		$error_no = $_FILES[self::$file]['error'];
		//$error_no = self::$manuel_error;
		
		self::$errors = array
		(
			'0' => "scc", //Dosya başarı ile yüklendi. 
			'1' => lang('upload_1'), //Php.ini dosyasındaki maximum dosya boyutu aşıldı. 
			'2' => lang('upload_2'), //Formtaki max_file_size direktifindeki dosya boyutu limiti aşıldı. 
			'3' => lang('upload_3'), //Dosya yükleme işlemi tamamlanmadı. 
			'4' => lang('upload_4'), //Yüklenecek dosya yok. 
			'6' => lang('upload_6'), //Dosyaların geçici olarak yükleneceği dizin bulunamadı. 
			'7' => lang('upload_7'), //Dosya dik üzerine yazılamadı. 
			'8' => lang('upload_8'), //Dosya yükleme uzantı desteği yok. 
			'9' => lang("upload_9"),  //Dosya yükleme yolu geçerli değil.
			'10' => lang("upload_10")
		);
		if( ! empty(self::$manuel_error)) 			return self::$errors[self::$manuel_error];
		else if( ! empty(self::$extension_control)) if(self::$extension_control) 	return  self::$extension_control;
		else if( ! empty(self::$errors[$error_no])) if(self::$errors[$error_no] == "scc") return false;
		else if( ! empty(self::$errors[$error_no])) if(self::$errors[$error_no] != "") return self::$errors[$error_no];
		else return lang('upload_unknown_error');

	}
}

//---------------------------END CLASS--------------------------------------------------------------------------------------