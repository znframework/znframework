<?php
class __USE_STATIC_ACCESS__Validation implements ValidationInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Errors Değişkeni
	 *  
	 * Validasyon işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $errors 	= array();
	
	/* Error Değişkeni
	 *  
	 * Validasyon işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $error  	= array();
	
	/* New Value Değişkeni
	 *  
	 * Validasyon işlemleri sonrasında oluşan
	 * yeni değere ait bilgileri
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $nval 	= array();
	
	/* Settings Değişkeni
	 *  
	 * Ayarlar bilgisini tutar.
	 *
	 */
	protected $settings = array();
	
	/* Messages Değişkeni
	 *  
	 * Mesajlar bilgisini tutar.
	 *
	 */
	protected $messages = array();
	
	/* Index Değişkeni
	 *  
	 * Sıra bilgisini tutar.
	 *
	 */
	protected $index = 0;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Control Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function identity($no = '')
	{
		if( ! is_numeric($no) ) 
		{
			return Errors::set('Error', 'numericParameter', 'no');
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
	public function email($data = '')
	{
		if( ! is_string($data) ) 
		{
			return Errors::set('Error', 'stringParameter', 'data');
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
	public function url($data = '')
	{
		if( ! is_string($data) ) 
		{
			return Errors::set('Error', 'stringParameter', 'data');
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
	public function specialChar($data = '')
	{
		if( ! is_scalar($data) ) 
		{
			return Errors::set('Error', 'stringParameter', 'data');
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
	public function maxchar($data = '', $char = '')
	{
		if( ! is_scalar($data) ) 
		{
			return Errors::set('Error', 'stringParameter', 'data');
		}
		
		if( ! is_numeric($char) ) 
		{
			return Errors::set('Error', 'numericParameter', 'char');
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
	public function minchar($data = '', $char = '')
	{
		if( ! is_scalar($data) ) 
		{
			return Errors::set('Error', 'stringParameter', 'data');
		}
		if( ! is_numeric($char) ) 
		{
			return Errors::set('Error', 'numericParameter', 'char');
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
	
	//----------------------------------------------------------------------------------------------------
	// Control Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Rules Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// name()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	//
	//----------------------------------------------------------------------------------------------------
	public function name($name = '')
	{
		$this->settings['name'] = $name;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// method()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $method
	//
	//----------------------------------------------------------------------------------------------------
	public function method($method = 'post')
	{
		$this->settings['method'] = $method;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// value()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $value
	//
	//----------------------------------------------------------------------------------------------------
	public function value($value = '')
	{
		$this->settings['value'] = $value;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// required()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function required()
	{
		$this->settings['config'][] = 'required';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// numeric()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function numeric()
	{
		$this->settings['config'][] = 'numeric';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// match()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $match
	//
	//----------------------------------------------------------------------------------------------------
	public function match($match = '')
	{
		$this->settings['config']['match'] = $match;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// matchPassword()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $match
	//
	//----------------------------------------------------------------------------------------------------
	public function matchPassword($match = '')
	{
		$this->settings['config']['matchPassword'] = $match;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// oldPassword()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $oldPassword
	//
	//----------------------------------------------------------------------------------------------------
	public function oldPassword($oldPassword = '')
	{
		$this->settings['config']['oldPassword'] = $oldPassword;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// compare()
	//----------------------------------------------------------------------------------------------------
	//
	// @param numeric $min
	// @param numeric $max
	//
	//----------------------------------------------------------------------------------------------------
	public function compare($min = '', $max = '')
	{
		$this->settings['config']['minchar'] = $min;
		$this->settings['config']['maxchar'] = $max;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// validate()
	//----------------------------------------------------------------------------------------------------
	//
	// @param args
	//
	//----------------------------------------------------------------------------------------------------
	public function validate()
	{
		$this->settings['validate'] = func_get_args();
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// secure()
	//----------------------------------------------------------------------------------------------------
	//
	// @param args
	//
	//----------------------------------------------------------------------------------------------------
	public function secure()
	{
		$this->settings['secure'] = func_get_args();
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// pattern()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $pattern
	// @param string $char
	//
	//----------------------------------------------------------------------------------------------------
	public function pattern($pattern = '', $char = '')
	{
		$this->settings['config']['pattern'] = presuffix($pattern).$char;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// phone()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $design
	//
	//----------------------------------------------------------------------------------------------------
	public function phone($design = '')
	{
		if( empty($design) )
		{
			$this->settings['config'][] = 'phone';
		}
		else
		{
			$this->settings['config']['phone'] = $design;
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// alpha()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function alpha()
	{
		$this->settings['config'][] = 'alpha';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// alnum()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function alnum()
	{
		$this->settings['config'][] = 'alnum';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// captcha()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $captcha
	//
	//----------------------------------------------------------------------------------------------------
	public function captcha($captcha = '')
	{
		$this->settings['config']['captcha'] = $captcha;
		
		return $this;
	}

	//----------------------------------------------------------------------------------------------------
	// _messages()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $type
	// @param string $name
	// @param string $viewName
	//
	//----------------------------------------------------------------------------------------------------
	protected function _messages($type, $name, $viewName)
	{
		$message = lang('Validation', $type, $viewName);
		$this->messages[$this->index] = $message.'<br>'; $this->index++;
		$this->error[$name] = $message;
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
	public function rules($name = '', $config = array(), $viewName = '', $met = 'post')
	{
		if( ! empty($this->settings['name']) )
		{
			$name = $this->settings['name'];
		}
		
		if( ! empty($this->settings['method']) )
		{
			$met = $this->settings['method'];
		}
		
		if( ! empty($this->settings['value']) )
		{
			$viewName = $this->settings['value'];
		}
		
		if( ! empty($this->settings['config']) )
		{
			$config = array_merge($config, $this->settings['config']);
		}
		
		if( ! empty($this->settings['validate']) )
		{
			$config = array_merge($config, $this->settings['validate']);
		}
		
		if( ! empty($this->settings['secure']) )
		{
			$config = array_merge($config, $this->settings['secure']);
		}
		
		if( ! empty($this->settings['pattern']) )
		{
			$config = array_merge($config, $this->settings['pattern']);
		}
		
		$this->settings = array();

		// sistemte validation için oluşturulmuş dil dosyası yükleniyor.

		$viewName = ( empty($viewName) ) 
					? $name 
					: $viewName;

		$edit = $this->_methodType($name, $met);
		
		if( ! isset($edit) ) 
		{
			return false;	
		}
		
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
		$this->nval[$name] = $edit;
		
		// Süzgeç sonrası yeni değer
		$this->_methodNval($name, $edit, $met);
		
		// required boş geçilemez yapar.
		if( in_array('required', $config) )
		{ 
			if( empty($edit) )
			{ 	
				$this->_messages('required', $name, $viewName);	
			} 
		}
		
		// security_code güvenlik kodunun uygulanması için kullanılır, bu saydece güvenlik kodu ile 
		// bu kural eşleşirse işleve devam edilecektir.
		
		if( in_array('captcha', $config) )
		{ 
			Session::start();
			
			if( $edit != Session::select(md5('SystemCaptchaCodeData')) )
			{ 
				$this->_messages('captchaCode', $name, $viewName);	
			} 
		}
		
		// register işlemlerinde iki şifre kutusunun eşleştirilmesi için kullanılmaktadır.
		if( isset($config['matchPassword']) )
		{ 
			$pm = $this->_methodType($config['matchPassword'], $met);
			
			if( $edit != $pm )
			{ 
				$this->_messages('passwordMatch', $name, $viewName);
			} 
		}
		
		if( isset($config['match']) )
		{ 
			$pm = $this->_methodType($config['match'], $met);
			
			if( $edit != $pm )
			{ 
				$this->_messages('dataMatch', $name, $viewName);
			} 
		}
		
		if( isset($config['oldPassword']) )
		{ 
			$pm = "";
			$pm = $config['oldPassword'];
	
			if( Encode::super($edit) != $pm )
			{ 
				$this->_messages('oldPasswordMatch', $name, $viewName);
			} 
		}
		
		// numeric form aracının sayısal değer olması gerektiğini belirtir.
		if( in_array('numeric', $config) )
		{ 
			if( ! is_numeric($edit) )
			{ 
				$this->_messages('numeric', $name, $viewName);
			} 
		}
		
		// verinin telefon bilgisi olup olmadığı kontrol edilir.
		if( in_array('phone', $config) )
		{ 
			if( ! preg_match('/\+*[0-9]{10,14}$/', $edit) )
			{ 
				$this->_messages('phone', $name, $viewName);
			} 
		}
		// verinin belirtilen desende telefon bilgisi olup olmadığı kontrol edilir.
		if( isset($config['phone']) )
		{ 
			$phoneData = $config['phone'];		
			$phoneData = preg_replace('/([^\*])/', 'key:$1', $phoneData);			
			$phoneData = '/'.str_replace(array('*', 'key:'), array('[0-9]', '\\'), $phoneData).'/';
			
			if( ! preg_match($phoneData, $edit) )
			{ 
				$this->_messages('phone', $name, $viewName);
			} 
		
		
		}
		
		// verinin alfabetik karakter bilgisi olup olmadığı kontrol edilir.
		if( in_array('alpha', $config) )
		{ 
			if( ! ctype_alpha($edit) )
			{ 
				$this->_messages('alpha', $name, $viewName);
			} 
		}
		
		// verinin alfabetik ve sayısal veri olup olmadığı kontrol edilir.
		if( in_array('alnum', $config) )
		{ 
			if( ! preg_match('/\w+/',$edit) )
			{ 
				$this->_messages('alnum', $name, $viewName);
			} 
		}
		
		// email form aracının email olması gerektiğini belirtir.
		if( in_array('email', $config) )
		{ 
			if( ! $this->email($edit) )
			{ 
				$this->_messages('email', $name, $viewName);
			} 
		}
		
		if( in_array('url' ,$config) )
		{ 
			if( ! $this->url($edit) )
			{ 
				$this->_messages('url', $name, $viewName);
			} 
		}
		
		if( in_array('identity', $config) )
		{ 
			if( ! $this->identity($edit) )
			{ 
				$this->_messages('identity', $name, $viewName);
			} 
		}
		
		// no special char, özel karakterlerin kullanımını engeller.
		if( in_array('specialChar', $config) )
		{
			if( $this->specialChar($edit) )
			{ 
				$this->_messages('noSpecialChar', $name, $viewName);
			} 
		}
		
		// maxchar form aracının maximum alacağı karakter sayısını belirtir.	
		if( isset($config['maxchar']) )
		{ 
			if( ! $this->maxchar($edit, $config['maxchar']) )
			{ 
				$this->_messages('maxchar', $name, array("%"=>$viewName, "#" => $config['maxchar']));
			} 
		}
		
		// minchar from aracının minimum alacağı karakter sayısını belirtir.
		if( isset($config['minchar']) )
		{	
			if( ! $this->minchar($edit, $config['minchar']) )
			{ 
				$this->_messages('minchar', $name, array("%"=>$viewName, "#" => $config['minchar']));
			} 
		}
		
		if( isset($config['pattern']) )
		{ 
			if( ! preg_match($config['pattern'], $edit) )
			{ 
				$this->_messages('pattern', $name, $viewName);
			} 
		}
		
		// kurala uymayan seçenekler varsa hata mesajı dizisine eklenir.
		array_push($this->errors, $this->messages);	
		
		$this->_defaultVariables();
	}
	
	/* PROTECTED Default Variables Fonksiyonu
	 *  
	 * Değişkenlerin sıfırlanması
	 * için oluşturulmuştur.
	 *
	 */
	protected function _defaultVariables()
	{
		$this->messages = array();
		$this->index    = 0;
	}
	
	/* PROTECTED Method Type Fonksiyonu
	 *  
	 * Method kontrolü yapması
	 * için oluşturulmuştur.
	 *
	 */
	protected function _methodType($name = '', $met = '')
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
	protected function _methodNval($name = '', $val = '', $met = '')
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
	
	//----------------------------------------------------------------------------------------------------
	// Rules Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function nval($name = "")
	{
		if( ! is_scalar($name) ) 
		{
			return Errors::set('Error', 'scalarParameter', 'name');
		}
		
		if( isset($this->nval[$name]) )
		{ 
			return $this->nval[$name];
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
	public function error($name = "array")
	{
		if( ! is_string($name) ) 
		{
			$name = "array";
		}
		
		if( $name === "string" || $name === "array" || $name === "echo" )
		{
			if( count($this->errors) > 0 )
			{
				$result = '';
				$resultArray = array();
				
				foreach( $this->errors as $key => $value )
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
			if( isset($this->error[$name]) ) 
			{
				return $this->error[$name]; 
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
	public function postBack($name = '', $met = "post")
	{
		if( ! is_scalar($name) || empty($name) )
		{
			return Errors::set('Error', 'scalarParameter', 'name');
		}

		if( ! is_string($met) ) 
		{
			$met = "post";
		}	
		
		$method = $this->_methodType($name, $met);
		
		if( ! isset($method) ) 
		{
			return false;
		}
		
		return $method;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
}