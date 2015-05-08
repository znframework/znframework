<?php
/************************************************************/
/*                     CLASS  VALIDATION                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Val
{
	
	private static $errors 	= array();
	private static $error  	= array();
	private static $nval 	= array();
	
	public static function identity($no = '')
	{
		if( ! is_numeric($no)) return false;
		
		$numone 	= ($no[0] + $no[2] + $no[4] + $no[6]  + $no[8]) * 7;
		$numtwo 	= $no[1] + $no[3] + $no[5] + $no[7];
		$result 	= $numone - $numtwo;
		$tenth  	= $result%10;
		$total  	= ($no[0] + $no[1] + $no[2] + $no[3] + $no[4] + $no[5] + $no[6] + $no[7] + $no[8] + $no[9]);
		$elewenth 	= $total%10;
		
		if($no[0] == 0) 				return false;
		else if(strlen($no) != 11) 		return false;
		else if($no[9] != $tenth) 		return false;
		else if($no[10] != $elewenth) 	return false;
		else 							return true;
	}
	
	public static function email($data = '')
	{
		if( ! is_string($data)) return false;
		if( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $data)) return false; else return true;
	}
	
	public static function url($data = '')
	{
		if( ! is_string($data)) return false;
		if( ! preg_match('#^(\w+:)?//#i', $data)) return false; else return true;
	}
	
	public static function specialchar($data = '')
	{
		if( ! is_string($data)) return false;
		if( ! preg_match('#[!\'^\#\\\+\$%&\/\(\)\[\]\{\}=\|\-\?:\.\,;_ĞÜŞİÖÇğüşıöç]+#', $data) ) return false; else return true;
	}
	
	public static function maxchar($data = '', $char = '')
	{
		if( ! is_string($data)) return false;
		if( ! is_numeric($char)) return false;
		
		if(strlen($data) <= $char) return true; else return false;
	}
	
	public static function minchar($data = '', $char = '')
	{
		if( ! is_string($data)) return false;
		if( ! is_numeric($char)) return false;
		
		if(strlen($data) >= $char) return true; else return false;
	}
	
	// rules() form araçlarının hangi kurallardan oluşacağını belirlemek için kullanılan fonksiyondur.
	// birinci parametre form nesnesinin adı, ikinci parametre ise oluşacak kurallar dizisidir.
	
	public static function rules($name = '', $config = array(), $view_name = '', $met = 'post')
	{
		if( ! is_string($name)) return false;
		if( ! is_array($config)) $config = array();
		if( ! is_string($name)) $view_name = '';
		if( ! is_string($met)) $met = 'post';
		
		if(empty($name)) return false;
		if( empty($config) || ! is_array($config) ) return false;
		// sistemte validation için oluşturulmuş dil dosyası yükleniyor.
		
		// birinci parametre otomatik olarak post ile alınıyor
		import::library('Method','Security','Validation','Encode');
		import::language('Validation');
		
		$view_name = (empty($view_name)) ? $name : $view_name;

		$messages = array();

		if($met === "post") 	$edit = method::post($name);
		if($met === "get") 		$edit = method::get($name);
		if($met === "request") 	$edit = method::request($name);
	
		if( ! isset($edit)) return false;	
		
		
		$i=0;
		
		// kenar boşluklarını kaldırır.
		if(in_array('trim',$config)) {$edit = trim($edit);}		
			
		// nc_clean çirkin kodların kullanılmasını engellemek için kullanılır.
		if(in_array('nc_encode',$config)){
			$secnc = config::get("Security", "nc_encode");
			$edit = sec::nc_encode($edit, $secnc['bad_chars'], $secnc['change_bad_chars']);
		}	
		
		// xss_clean genel de xss ataklarını engellemek için kullanılır.
		if(in_array('html_encode',$config)){$edit = sec::html_encode($edit);}		
		
		// nail_clean tırnak işaretlerini temizlemek için kullanılır.
		if(in_array('nail_encode',$config)){$edit = sec::nail_encode($edit);}	
		
		// tırnak işaretleri ve injection saldırılarını engellemek için kullanılır.
		if(in_array('injection_encode',$config)){$edit = sec::injection_encode($edit);}	
		
		
		self::$nval[$name] = $edit;
		
		// required boş geçilemez yapar.
		if(in_array('required',$config))
		{ 
			if(empty($edit))
			{ 		
				$required 			= lang('validation_required',$view_name);
				$messages[$i] 		= $required.'<br>'; $i++;
				self::$error[$name] = $required;
			} 
		}
		
		// security_code güvenlik kodunun uygulanması için kullanılır, bu saydece güvenlik kodu ile 
		// bu kural eşleşirse işleve devam edilecektir.
		
		if(in_array('captcha_code',$config))
		{ 
			if(!isset($_SESSION)) session_start();
			
			if($edit != $_SESSION[md5('captcha_code')])
			{ 
				$security_code 		= lang('validation_security_code',$view_name);
				$messages[$i] 		= $security_code.'<br>'; $i++;
				self::$error[$name] = $security_code;
			} 
		}
		
		// register işlemlerinde iki şifre kutusunun eşleştirilmesi için kullanılmaktadır.
		if(isset($config['match_password']))
		{ 
			$pm = "";
			if($met === "post") 	$pm = method::post($config['match_password']);
			if($met === "get") 		$pm = method::post($config['match_password']);
			if($met === "request") 	$pm = method::post($config['match_password']);

			if($edit != $pm)
			{ 
				$password_match 	= lang('validation_password_match',$view_name);
				$messages[$i] 		= $password_match.'<br>'; $i++;
				self::$error[$name] = $password_match;
			} 
		}
		
		if(isset($config['match']))
		{ 
			$pm = "";
			if($met === "post") 		$pm = method::post($config['match']);
			if($met === "get") 		$pm = method::post($config['match']);
			if($met === "request") 	$pm = method::post($config['match']);

			if($edit != $pm)
			{ 
				$password_match 	= lang('validation_data_match',$view_name);
				$messages[$i] 		= $password_match.'<br>'; $i++;
				self::$error[$name] = $password_match;
			} 
		}
		
		if(isset($config['old_password']))
		{ 
			$pm = "";
			$pm = $config['old_password'];
	
			if(encode::super($edit) != $pm)
			{ 
				$old_password_match 	= lang('validation_old_password_match',$view_name);
				$messages[$i] 		= $old_password_match.'<br>'; $i++;
				self::$error[$name] = $old_password_match;
			} 
		}
		
		// numeric form aracının sayısal değer olması gerektiğini belirtir.
		if(in_array('numeric',$config))
		{ 
			if( ! is_numeric($edit))
			{ 
				$numeric 			= lang('validation_numeric',$view_name);
				$messages[$i] 		= $numeric.'<br>'; $i++;
				self::$error[$name] = $numeric;
			} 
		}
		
		// email form aracının email olması gerektiğini belirtir.
		if(in_array('email',$config))
		{ 
			if( ! self::email($edit))
			{ 
				$email 				= lang('validation_email',$view_name);
				$messages[$i] 		= $email.'<br>';  $i++;
				self::$error[$name] = $email;
			} 
		}
		
		if(in_array('url',$config))
		{ 
			if( ! self::url($edit))
			{ 
				$url 				= lang('validation_url',$view_name);
				$messages[$i] 		= $url.'<br>';  $i++;
				self::$error[$name] = $url;
			} 
		}
		
		if(in_array('identity',$config))
		{ 
			if( ! self::identity($edit))
			{ 
				$identity 			= lang('validation_identity',$view_name);
				$messages[$i] 		= $identity.'<br>';  $i++;
				self::$error[$name] = $identity;
			} 
		}
		
		// no special char, özel karakterlerin kullanımını engeller.
		if(in_array('specialchar',$config))
		{
			if(self::specialchar($edit))
			{ 
				$nospecial_char 	= lang('validation_nospecial_char',$view_name);
				$messages[$i] 		= $nospecial_char.'<br>';  $i++;
				self::$error[$name] = $nospecial_char;
			} 
		}
		
		// maxchar form aracının maximum alacağı karakter sayısını belirtir.	
		if(isset($config['maxchar']))
		{ 
			if( ! self::maxchar($edit, $config['maxchar']))
			{ 
				$maxchar 			= lang('validation_maxchar',array("%"=>$view_name, "#" => $config['maxchar']));
				$messages[$i] 		= $maxchar.'<br>';  $i++;
				self::$error[$name] = $maxchar;
			} 
		}
		
		// minchar from aracının minimum alacağı karakter sayısını belirtir.
		if(isset($config['minchar']))
		{	
			if( ! self::minchar($edit, $config['minchar']))
			{ 
				$minchar 			= lang('validation_minchar',array("%"=>$view_name, "#" => $config['minchar']));
				$messages[$i] 		= $minchar.'<br>'; $i++;
				self::$error[$name] = $minchar;
			} 
		}
		
		// kurala uymayan seçenekler varsa hata mesajı dizisine eklenir.
		array_push(self::$errors,$messages);
		
	}	
	
	// kontrolden geçirilmiş veriyi döndürür
	public static function nval($name = "")
	{
		if( ! is_string($name)) return false;
		if(isset(self::$nval[$name])) 
			return self::$nval[$name];
		else
			return false;
	}
	
	// bu fonksiyon kurala uymayan seçeneklerden kaynaklanan hatalrı buraya ekler, ve ekrana gelen hataları başar.
	public static function error($name = "array")
	{
		if( ! is_string($name)) $name = "array";
		
		if($name === "string" || $name === "array")
		{
			if(count(self::$errors) > 0)
			{
				$result = "";
				$result_array = array();
				foreach(self::$errors as $key => $value)
				{
					if($value)foreach($value as $k => $val)
					{
						$result .= $val;
						$result_array[] = str_replace("<br>","",$val);
					}
				}
				if($name === "string") return $result;
				if($name === "array") return $result_array;
			}
			else return false;
		}
		else
		{
			if(isset(self::$error[$name])) return self::$error[$name]; else return false;
		}
	}
	
	// sayfanın post edilmesin oluşan hatalardan dolayı tekrar aynı bilgilerin girilmesini engellemek yerine
	// bu fonksiyon aracılığı ile sayfa yenilendiğin ya da formun gönderilmesi srıasında
	
	// hata oluştuğunda ekrana girilen bilgileri yansıtır.
	public static function post_back($name = '', $met = "post")
	{
		if( ! is_string($name)) return false;
		if( ! is_string($met)) $met = "post";
		
		if(empty($name))
			return false;
		
		import::library('Method');

		if($met === "post") 	$method = method::post($name);
		if($met === "get") 		$method = method::get($name);
		if($met === "request") 	$method = method::request($name);

		if( ! isset($method)) return false;

		return $method;
	}
	
	
	
}