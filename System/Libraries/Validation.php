<?php
/************************************************************/
/*                     CLASS  VALIDATION                    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* VALIDATION                                                                          	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	validation::, $this->validation, uselib('validation')   	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Validation
{
	/* Errors Değişkeni
	 *  
	 * Validasyon işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $errors 	= array();
	
	/* Error Değişkeni
	 *  
	 * Validasyon işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $error  	= array();
	
	/* New Value Değişkeni
	 *  
	 * Validasyon işlemleri sonrasında oluşan
	 * yeni değere ait bilgileri
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $nval 	= array();
	
	/* PROTECTED Method Type Fonksiyonu
	 *  
	 * Method kontrolü yapması
	 * için oluşturulmuştur.
	 *
	 */
	protected static function _methodType($name = '', $met = '')
	{
		if( $met === "post" ) 		
		{
			return Method::post($name);
		}
		
		if( $met === "get" ) 		
		{
			return Method::get($name);
		}
		
		if( $met === "request" ) 	
		{
			return Method::request($name);
		}	
	}
	
	/* PROTECTED Method New Value Fonksiyonu
	 *  
	 * Kontrol edilen yeni değeri bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected static function _methodNval($name = '', $val = '', $met = '')
	{
		if( $met === "post" ) 		
		{
			return Method::post($name, $val);
		}
		
		if( $met === "get" ) 		
		{
			return Method::get($name, $val);
		}
		
		if( $met === "request" ) 	
		{
			return Method::request($name, $val);
		}	
	}
	
	
	/******************************************************************************************
	* IDENDITY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Kimlik numarası kontrolü.		        		          				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @no => Kontrol edilecek kimlik numarası bilgisi.                         |
	|          																				  |
	| Örnek Kullanım: identity(123213); // Çıktı: true veya false      		      			  |
	|          																				  |
	******************************************************************************************/
	public static function identity($no = '')
	{
		if( ! is_numeric($no) ) 
		{
			return false;
		}
		
		$numone 	= ($no[0] + $no[2] + $no[4] + $no[6]  + $no[8]) * 7;
		$numtwo 	= $no[1] + $no[3] + $no[5] + $no[7];
		$result 	= $numone - $numtwo;
		$tenth  	= $result%10;
		$total  	= ($no[0] + $no[1] + $no[2] + $no[3] + $no[4] + $no[5] + $no[6] + $no[7] + $no[8] + $no[9]);
		$elewenth 	= $total%10;
		
		if($no[0] == 0)
		{
			return false;
		}
		elseif(strlen($no) != 11)
		{
			return false;
		}
		elseif($no[9] != $tenth)
		{
			return false;
		}
		elseif($no[10] != $elewenth)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* E-MAIL                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: E-posta kontrolü kontrolü.		        		          		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @data => Kontrol edilecek e-posta bilgisi.                               |
	|          																				  |
	| Örnek Kullanım: email('bilgi@zntr.net'); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public static function email($data = '')
	{
		if( ! is_string($data) ) 
		{
			return false;
		}
		if( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $data) ) 
		{
			return false; 
		}
		else 
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* URL                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: URL adres kontrolü kontrolü.		        		          		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @data => Kontrol edilecek url adres bilgisi.                             |
	|          																				  |
	| Örnek Kullanım: url('zntr.net'); // Çıktı: true veya false      		      	          |
	|          																				  |
	******************************************************************************************/
	public static function url($data = '')
	{
		if( ! is_string($data) ) 
		{
			return false;
		}
		if( ! preg_match('#^(\w+:)?//#i', $data) ) 
		{
			return false; 
		}
		else 
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* SPECIAL CHAR                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Özel karakter kontrolü kontrolü.		        		          		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @data => Kontrol edilecek metin bilgisi.                                 |
	|          																				  |
	| Örnek Kullanım: specialChar('zntr.net'); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public static function specialChar($data = '')
	{
		if( ! is_string($data) ) 
		{
			return false;
		}
		if( ! preg_match('#[!\'^\#\\\+\$%&\/\(\)\[\]\{\}=\|\-\?:\.\,;_ĞÜŞİÖÇğüşıöç]+#', $data) ) 
		{
			return false; 
		}
		else 
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* MAXCHAR                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Maksimum karakter kontrolü kontrolü.		        		          	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @data => Kontrol edilecek metin bilgisi.                                 |
	| 2. numeric var @char => Maksimum karakter sayısı.                                       |
	|          																				  |
	| Örnek Kullanım: maxchar('zntr.net', 10); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public static function maxchar($data = '', $char = '')
	{
		if( ! is_string($data) ) 
		{
			return false;
		}
		if( ! is_numeric($char) ) 
		{
			return false;
		}
		
		if( strlen($data) <= $char ) 
		{
			return true; 
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* MINCHAR                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Minimum karakter kontrolü kontrolü.		        		          	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @data => Kontrol edilecek metin bilgisi.                                 |
	| 2. numeric var @char => Minimum karakter sayısı.                                        |
	|          																				  |
	| Örnek Kullanım: minchar('zntr.net', 5); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public static function minchar($data = '', $char = '')
	{
		if( ! is_string($data) ) 
		{
			return false;
		}
		if( ! is_numeric($char) ) 
		{
			return false;
		}
		
		if( strlen($data) >= $char ) 
		{
			return true; 
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* RULES                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: form araçlarının hangi kurallardan oluşacağını belirlemek için 		  |
	| kullanılan fonksiyondur. Birinci parametre form nesnesinin adı, ikinci parametre ise    |
	| oluşacak kurallar dizisidir		        		          	  						  |			
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @name => Kontrol edilecek form verisi.                                    |
	| 2. array var @config => Kontrol parametreleri dizisi.                                   |
	| 3. string var @view_name => Kontrollerde görünmesini istediğiniz form verisinin ismi.   |
	| 4. [ string var @method ] => Formdan hangi methodla verinin gönderildiğidir. Varsayılan:|
	| post ayarlıdır.																	      |
	|          																				  |
	| Örnek Kullanım: rules('kullanici', array('required', 'email'), 'E-posta');              |
	|          																				  |
	| 2. Parametre => Kontrol Parametreleri         										  |
	|          																				  |
	| 1-required => Bu veri boş geçilemez.         											  |
	| 2-idendity => Bu bir kimlik numarası olmalıdır.         								  |
	| 3-url => Bu bir url veri tipi olmalıdır.         										  |
	| 4-email => Bu bir e-posta veri tipi olmalıdır.         								  |
	| 5-minchar => 5 => Bu verinin minimun karakter sayısı 5 olmalıdır.         			  |
	| 6-maxchar => 5 => Bu verinin maksimum karakter sayısı 5 olmalıdır.         			  |
	| .																						  |
	| .																						  |
	| .																						  |
	|  >>>>>>>>>>>>>>>>>>>>>>>>>>>Detaylı bilgi için ZNTR.NET<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<   |    																				  |
	******************************************************************************************/
	public static function rules($name = '', $config = array(), $viewName = '', $met = 'post')
	{
		if( ! is_string($name) ) 
		{
			return false;
		}
		if( ! is_array($config) ) 
		{
			$config = array();
		}
		if( ! is_string($name) ) 
		{
			$viewName = '';
		}
		if( ! is_string($met) ) 
		{
			$met = 'post';
		}
		
		if( empty($name) ) 
		{
			return false;
		}
		
		if( empty($config) || ! is_array($config) ) 
		{
			return false;
		}
		
		// sistemte validation için oluşturulmuş dil dosyası yükleniyor.

		$viewName = ( empty($viewName) ) 
					 ? $name 
					 : $viewName;

		$messages = array();
		
		$edit = self::_methodType($name, $met);
		
		if( ! isset($edit) ) 
		{
			return false;	
		}
		
		$i = 0;
		
		// kenar boşluklarını kaldırır.
		if( in_array('trim',$config) ) 
		{
			$edit = trim($edit);		
		}
		
		// nc_clean çirkin kodların kullanılmasını engellemek için kullanılır.
		if( in_array('nc', $config) )
		{
			$secnc = Config::get("Security", 'ncEncode');
			$edit  = Security::ncEncode($edit, $secnc['bad_chars'], $secnc['change_bad_chars']);
		}	
		
		// xss_clean genel de xss ataklarını engellemek için kullanılır.
		if( in_array('html' ,$config) )
		{
			$edit = Security::htmlEncode($edit);		
		}
		
		// nail_clean tırnak işaretlerini temizlemek için kullanılır.
		if( in_array('xss', $config) )
		{
			$edit = Security::xssEncode($edit);	
		}
		
		// tırnak işaretleri ve injection saldırılarını engellemek için kullanılır.
		if( in_array('injection', $config) )
		{
			$edit = Security::injectionEncode($edit);
		}
		
		// Süzgeç sonrası validation::nval() yönteminin yeni değeri
		self::$nval[$name] = $edit;
		
		// Süzgeç sonrası yeni değer
		self::_methodNval($name, $edit, $met);
		
		// required boş geçilemez yapar.
		if( in_array('required', $config) )
		{ 
			if( empty($edit) )
			{ 		
				$required 			= lang('Validation', 'required',$viewName);
				$messages[$i] 		= $required.'<br>'; $i++;
				self::$error[$name] = $required;
			} 
		}
		
		// security_code güvenlik kodunun uygulanması için kullanılır, bu saydece güvenlik kodu ile 
		// bu kural eşleşirse işleve devam edilecektir.
		
		if( in_array('captcha', $config) )
		{ 
			if( ! isset($_SESSION) ) 
			{
				session_start();
			}
			
			if( $edit != $_SESSION[md5('captchaCode')] )
			{ 
				$securityCode 		= lang('Validation', 'captchaCode',$viewName);
				$messages[$i] 		= $securityCode.'<br>'; $i++;
				self::$error[$name] = $securityCode;
			} 
		}
		
		// register işlemlerinde iki şifre kutusunun eşleştirilmesi için kullanılmaktadır.
		if( isset($config['matchPassword']) )
		{ 
			$pm = self::_methodType($config['matchPassword'], $met);
			
			if( $edit != $pm )
			{ 
				$passwordMatch 	= lang('Validation', 'passwordMatch',$viewName);
				$messages[$i] 		= $passwordMatch.'<br>'; $i++;
				self::$error[$name] = $passwordMatch;
			} 
		}
		
		if( isset($config['match']) )
		{ 
			$pm = self::_methodType($config['match'], $met);
			
			if( $edit != $pm )
			{ 
				$passwordMatch 	= lang('Validation', 'dataMatch',$viewName);
				$messages[$i] 		= $passwordMatch.'<br>'; $i++;
				self::$error[$name] = $passwordMatch;
			} 
		}
		
		if( isset($config['oldPassword']) )
		{ 
			$pm = "";
			$pm = $config['oldPassword'];
	
			if( Encode::super($edit) != $pm )
			{ 
				$oldPasswordMatch = lang('Validation', 'oldPasswordMatch',$viewName);
				$messages[$i] 		= $oldPasswordMatch.'<br>'; $i++;
				self::$error[$name] = $oldPasswordMatch;
			} 
		}
		
		// numeric form aracının sayısal değer olması gerektiğini belirtir.
		if( in_array('numeric', $config) )
		{ 
			if( ! is_numeric($edit) )
			{ 
				$numeric 			= lang('Validation', 'numeric',$viewName);
				$messages[$i] 		= $numeric.'<br>'; $i++;
				self::$error[$name] = $numeric;
			} 
		}
		
		// email form aracının email olması gerektiğini belirtir.
		if( in_array('email', $config) )
		{ 
			if( ! self::email($edit) )
			{ 
				$email 				= lang('Validation', 'email',$viewName);
				$messages[$i] 		= $email.'<br>';  $i++;
				self::$error[$name] = $email;
			} 
		}
		
		if( in_array('url' ,$config) )
		{ 
			if( ! self::url($edit) )
			{ 
				$url 				= lang('Validation', 'url',$viewName);
				$messages[$i] 		= $url.'<br>';  $i++;
				self::$error[$name] = $url;
			} 
		}
		
		if( in_array('identity', $config) )
		{ 
			if( ! self::identity($edit) )
			{ 
				$identity 			= lang('Validation', 'identity',$viewName);
				$messages[$i] 		= $identity.'<br>';  $i++;
				self::$error[$name] = $identity;
			} 
		}
		
		// no special char, özel karakterlerin kullanımını engeller.
		if( in_array('specialChar', $config) )
		{
			if( self::specialChar($edit) )
			{ 
				$noSpecialChar 	= lang('Validation', 'noSpecialChar',$viewName);
				$messages[$i] 		= $noSpecialChar.'<br>';  $i++;
				self::$error[$name] = $noSpecialChar;
			} 
		}
		
		// maxchar form aracının maximum alacağı karakter sayısını belirtir.	
		if( isset($config['maxchar']) )
		{ 
			if( ! self::maxchar($edit, $config['maxchar']) )
			{ 
				$maxchar 			= lang('Validation', 'maxchar',array("%"=>$viewName, "#" => $config['maxchar']));
				$messages[$i] 		= $maxchar.'<br>';  $i++;
				self::$error[$name] = $maxchar;
			} 
		}
		
		// minchar from aracının minimum alacağı karakter sayısını belirtir.
		if( isset($config['minchar']) )
		{	
			if( ! self::minchar($edit, $config['minchar']) )
			{ 
				$minchar 			= lang('Validation', 'minchar',array("%"=>$viewName, "#" => $config['minchar']));
				$messages[$i] 		= $minchar.'<br>'; $i++;
				self::$error[$name] = $minchar;
			} 
		}
		
		// kurala uymayan seçenekler varsa hata mesajı dizisine eklenir.
		array_push(self::$errors, $messages);
		
	}	
	
	/******************************************************************************************
	* NEW VALUE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Validasyon kontrollerinden geçirilen yeni veri.	        		      |			
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Kontroleri sağlanan form verisi.                                 |
	|          																				  |
	| Örnek Kullanım: nval('kullanici');              										  |
	|          																				  |
	******************************************************************************************/
	public static function nval($name = "")
	{
		if( ! is_string($name) ) 
		{
			return false;
		}
		if( isset(self::$nval[$name]) )
		{ 
			return self::$nval[$name];
		}
		else
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Validasyon işlemlerinde kurala ayrıkı veri girişlerini öğrenmek içindir.|			
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Hata bilgilerini hangi formatta alınacağının belirtilmesidir.    |
	|          																				  |
	| Parametreye 3 farklı veri girişi yapılabilir.          								  |
	|          																				  |
	| 1- array  => Hatalar dizi türünde döndürülür.         								  |
	| 2- string/echo => Hatalar metinsel türde döndürülür.         							  |
	| 3- forum nesnesinin ismi => Hatanın oluştuğu forum nesnesinin adı.         			  |
	|          																				  |
	| Örnek Kullanım: error('array'); // Çıktı: array              							  |
	| Örnek Kullanım: error('string'); // Çıktı: string              						  |
	| Örnek Kullanım: error('echo'); // Çıktı: string              							  |
	| Örnek Kullanım: error('kullanici'); // Çıktı: kullanici nesnesine ait string            |
	|          																				  |
	******************************************************************************************/
	public static function error($name = "array")
	{
		if( ! is_string($name) ) 
		{
			$name = "array";
		}
		
		if( $name === "string" || $name === "array" || $name === "echo" )
		{
			if( count(self::$errors) > 0 )
			{
				$result = '';
				$resultArray = array();
				
				foreach(self::$errors as $key => $value)
				{
					if( is_array($value) )foreach($value as $k => $val)
					{
						$result .= $val;
						$resultArray[] = str_replace("<br>", '', $val);
					}
				}
				
				if( $name === "string" || $name === "echo" ) 
				{
					return $result;
				}
				
				if( $name === "array") 
				{
					return $resultArray;
				}
			}
			else 
			{
				return false;
			}
		}
		else
		{
			if( isset(self::$error[$name]) ) 
			{
				return self::$error[$name]; 
			}
			else 
			{
				return false;
			}
		}
	}
	
	// sayfanın post edilmesin oluşan hatalardan dolayı tekrar aynı bilgilerin girilmesini engellemek yerine
	// bu fonksiyon aracılığı ile sayfa yenilendiğin ya da formun gönderilmesi srıasında
	
	// hata oluştuğunda ekrana girilen bilgileri yansıtır.
	public static function postBack($name = '', $met = "post")
	{
		if( empty($name) )
		{
			return false;
		}
		
		if( ! is_string($name) ) 
		{
			return false;
		}
		
		if( ! is_string($met) ) 
		{
			$met = "post";
		}	
		
		$method = self::_methodType($name, $met);
		
		if( ! isset($method) ) 
		{
			return false;
		}
		
		return $method;
	}
}