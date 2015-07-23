<?php
class __USE_STATIC_ACCESS__User
{
	/***********************************************************************************/
	/* USER LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: User
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: user::, $this->user, zn::$use->user, uselib('user')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Username Değişkeni
	 *  
	 * Kullanıcı adı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $username;
	
	/* Password Değişkeni
	 *  
	 * Kullanıcı şifre bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $password;
	
	/* Error Değişkeni
	 *  
	 * Kullanıcı işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $error;
	
	/* Success Değişkeni
	 *  
	 * Kullanıcı işlemlerin bilgilerini
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	protected $success;
	
	/* Config Değişkeni
	 *  
	 * User ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	public function __construct()
	{
		$this->config = Config::get('User');	
	}
	
	/******************************************************************************************
	* REGISTER                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcıyı kaydetmek için kullanılır.		        		          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. array var @data => Kaydedilecek üye bilgileri anahtar değer çifti içeren bir dizi    |
	| içeriği ile kaydedilir. Dizideki anahtar ifadeler sütun isimlerini değer ifadeleri ise  |
	| bu sütuna kaydedilecek veriyi belirtir.											 	  |
	| 2. string/boolean var @autoLogin => Kayıttan sonra otomatik giriş olsun mu?		      |
	| True: Otomatik giriş olsun															  |
	| False: Otomatik giriş olmasın															  |
	| String Yol: Otomatik giriş olmasın ve belirtilen yola yönlendirilsin.					  |
	| 3. [ string var @activation_return_link ] => Aktivasyon yapılacaksa kayıt yapılırken    |
	| kullanıcıya gönderilen aktivasyon mailinin içerisindeki linke tıkladığında gidilecek	  |
	| sayfa belirtilir. Bu parametre isteğe bağlıdır.                                         |
	|          																				  |
	| Örnek Kullanım: register(array('user' => 'zntr', 'pass' => '1234'));       		      |
	|          																				  |
	******************************************************************************************/
	public function register($data = array(), $autoLogin = false, $activationReturnLink = '')
	{
		if( ! is_array($data) ) 
		{
			return Error::set('User', 'register', lang('Error', 'arrayParameter', 'data'));
		}
		if( ! is_string($activationReturnLink) ) 
		{
			$activationReturnLink = '';
		}
		
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$userConfig			= $this->config;	
		$joinTables  		= $userConfig['joinTables'];
		$joinColumn  		= $userConfig['joinColumn'];	
		$usernameColumn  	= $userConfig['usernameColumn'];
		$passwordColumn  	= $userConfig['passwordColumn'];
		$emailColumn  	    = $userConfig['emailColumn'];
		$tableName 			= $userConfig['tableName'];
		$activeColumn 		= $userConfig['activeColumn'];
		$activationColumn 	= $userConfig['activationColumn'];
		// ------------------------------------------------------------------------------
		
		// Kullanıcı adı veya şifre sütunu belirtilmemişse 
		// İşlemleri sonlandır.
		if( ! empty($joinTables) )
		{
			$joinData = $data;
			$data 	  = isset($data[$tableName])
				  	  ? $data[$tableName]
			      	  : array($tableName);
		}
		
		if( ! isset($data[$usernameColumn]) ||  ! isset($data[$passwordColumn]) ) 
		{
			$this->error = lang('User', 'registerUsernameError');	
			return Error::set('User', 'register', $this->error);
		}
		
		$loginUsername  = $data[$usernameColumn];
		$loginPassword  = $data[$passwordColumn];	
		$encodePassword = Encode::super($loginPassword);	
		
		$db = uselib('DB');
		
		$usernameControl = $db->where($usernameColumn.' =', $loginUsername)
							  ->get($tableName)
							  ->totalRows();
		
		// Daha önce böyle bir kullanıcı
		// yoksa kullanıcı kaydetme işlemini başlat.
		if( empty($usernameControl) )
		{
			$data[$passwordColumn] = $encodePassword;
			
			if( ! $db->insert($tableName , $data) )
			{
				$this->error = lang('User', 'registerUnknownError');	
				return Error::set('User', 'register', $this->error);
			}	

			if( ! empty($joinTables) )
			{	
				$joinCol = $db->where($usernameColumn.' =', $loginUsername)->get($tableName)->row()->$joinColumn;
				
				foreach( $joinTables as $table => $joinColumn )
				{
					$joinData[$table][$joinTables[$table]] = $joinCol;
					
					$db->insert($table, $joinData[$table]);	
				}	
			}
		
			$this->error   = false;
			$this->success = lang('User', 'registerSuccess');
			
			if( ! empty($activationColumn) )
			{
				if( ! isEmail($loginUsername) )
				{
					$email = $data[$emailColumn];
				}
				else
				{ 
					$email = '';
				}
				
				$this->_activation($loginUsername, $encodePassword, $activationReturnLink, $email);				
			}
			else
			{
				if( $autoLogin === true )
				{
					$this->login($loginUsername, $loginPassword);
				}
				elseif( is_string($autoLogin) )
				{
					redirect($autoLogin);	
				}
			}
			
			return true;
		}
		else
		{
			$this->error = lang('User', 'registerError');
			return Error::set('User', 'register', $this->error);
		}
	}
	
	/******************************************************************************************
	* UPDATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcı bilgilerinin güncellenmesi için kullanılır.		        	  |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @old => Kullanıcının eski şifresi.                   					  |
	| 2. string var @new => Kullanıcının yeni şifresi.                   					  |
	| 3. [ string var @new_again ] => Kullanıcının eski şifresi tekrar. Zorunlu değildir.     |
	| 4. array var @data => Kullanıcının güncellenecek bilgileri.                             |
	|          																				  |
	| Örnek Kullanım: update('eski1234', 'yeni1234', NULL, array('telefon' => 'xxxxx'));      |
	|          																				  |
	******************************************************************************************/	
	public function update($old = '', $new = '', $newAgain = '', $data = array())
	{
		// Bu işlem için kullanıcının
		// oturum açmıl olması gerelidir.
		if( $this->isLogin() )
		{
			// Parametreler kontrol ediliyor.--------------------------------------------------
			if( ! is_string($old) || ! is_string($new) || ! is_array($data) ) 
			{
				Error::set('User', 'update', lang('Error', 'stringParameter', 'old'));
				Error::set('User', 'update', lang('Error', 'stringParameter', 'new'));
				Error::set('User', 'update', lang('Error', 'arrayParameter', 'data'));
				
				return false;
			}
				
			if( empty($old) || empty($new) || empty($data) ) 
			{
				Error::set('User', 'update', lang('Error', 'emptyParameter', 'old'));
				Error::set('User', 'update', lang('Error', 'emptyParameter', 'new'));
				Error::set('User', 'update', lang('Error', 'emptyParameter', 'data'));
				
				return false;
			}
	
			if( ! is_string($newAgain) ) 
			{
				$newAgain = '';
			}
			// --------------------------------------------------------------------------------
		
			// Şifre tekrar parametresi boş ise
			// Şifre tekrar parametresini doğru kabul et.
			if( empty($newAgain) ) 
			{
				$newAgain = $new;
			}
					
			$userConfig = $this->config;	
			$joinTables = $userConfig['joinTables'];
			$jc 		= $userConfig['joinColumn'];
			$pc 		= $userConfig['passwordColumn'];
			$uc 		= $userConfig['usernameColumn'];	
			$tn 		= $userConfig['tableName'];
			
			$oldPassword = Encode::super($old);
			$newPassword = Encode::super($new);
			$newPasswordAgain = Encode::super($newAgain);
			
			if( ! empty($joinTables) )
			{
				$joinData = $data;
				$data     = isset($data[$tn])
					      ? $data[$tn]
					      : array($tn);	
			}
		
			$username = $this->data($tn)->$uc;
			$password = $this->data($tn)->$pc;
		
			$row 	  = "";
		
			if( $oldPassword != $password )
			{
				$this->error = lang('User', 'oldPasswordError');
				return Error::set('User', 'update', $this->error);	
			}
			elseif( $newPassword != $newPasswordAgain )
			{
				$this->error = lang('User', 'passwordNotMatchError');
				return Error::set('User', 'update', $this->error);
			}
			else
			{
				$data[$pc] = $newPassword;
				$data[$uc] = $username;
				
				$db = uselib('DB');
				
				if( ! empty($joinTables) )
				{
					$joinCol = $db->where($uc.' =', $username)->get($tn)->row()->$jc;
					
					foreach( $joinTables as $table => $joinColumn )
					{
						if( isset($joinData[$table]) )
						{
							$db->where($joinColumn.' =', $joinCol)->update($table, $joinData[$table]);	
						}
					}	
				}
				else
				{
					if( ! $db->where($uc.' =', $username)->update($tn, $data) )
					{
						$this->error = lang('User', 'registerUnknownError');	
						return Error::set('User', 'update', $this->error);
					}	
				}
				
				$this->success = lang('User', 'updateProcessSuccess');	
				return true;	
			}
		}
		else 
		{
			return false;		
		}
	}
	
	/******************************************************************************************
	* ACTIVATION COMPLETE                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Register() yönteminde belirtilen dönüş linkinin gösterdiği sayfada      |
	| kullanarak aktrivasyon işleminin tamamlanmasını sağlar.		        		          |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: activationComplete(); 									              |
	| NOT: Aktivasyon dönüş linkinin belirtiği sayfada kullanılmalıdır                        |
	|          																				  |
	******************************************************************************************/
	public function activationComplete()
	{
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$userConfig			= $this->config;	
		$tableName 			= $userConfig['tableName'];
		$usernameColumn  	= $userConfig['usernameColumn'];
		$passwordColumn  	= $userConfig['passwordColumn'];
		$activationColumn 	= $userConfig['activationColumn'];
		// ------------------------------------------------------------------------------
		
		// Aktivasyon dönüş linkinde yer alan segmentler -------------------------------
		$user = Uri::get('user');
		$pass = Uri::get('pass');
		// ------------------------------------------------------------------------------
		
		if( ! empty($user) && ! empty($pass) )	
		{
			$db = uselib('DB');
			
			$row = $db->where($usernameColumn.' =', $user, 'and')
			          ->where($passwordColumn.' =', $pass)		
			          ->get($tableName)
					  ->row();	
				
			if( ! empty($row) )
			{
				$db->where($usernameColumn.' =', $user)
				   ->update($tableName, array($activationColumn => '1'));
				
				$this->success = lang('User', 'activationComplete');
				
				return true;
			}	
			else
			{
				$this->error = lang('User', 'activationCompleteError');
				return Error::set('User', 'activationComplete', $this->error);
			}				
		}
		else
		{
			$this->error = lang('User', 'activationCompleteError');
			return Error::set('User', 'activationComplete', $this->error);
		}
	}
	
	// Aktivasyon işlemi için
	protected function _activation($user = "", $pass = "", $activationReturnLink = '', $email = '')
	{
		if( ! isUrl($activationReturnLink) )
		{
			$url = baseUrl(suffix($activationReturnLink));
		}
		else
		{
			$url = suffix($activationReturnLink);
		}
		
		$message = "<a href='".$url."user/".$user."/pass/".$pass."'>".lang('User', 'activation')."</a>";	
		
		$user = ( ! empty($email) ) 
				? $email 
				: $user;
				
		$sendEmail = uselib('Email');
		
		$sendEmail->receiver($user, $user);
		$sendEmail->subject(lang('User', 'activationProcess'));
		$sendEmail->content($message);
		
		if( $sendEmail->send() )
		{
			$this->success = lang('User', 'activationEmail');
			return true;
		}
		else
		{	
			$this->success = false;
			$this->error = lang('User', 'emailError');
			return false;
		}
	}
	
	/******************************************************************************************
	* TOTAL ACTIVE USERS                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcılardan aktif olanların sayısını verir.		        		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: totalActiveUsers(); 									              |
	|          																				  |
	******************************************************************************************/
	public function totalActiveUsers()
	{
		$activeColumn 	= $this->config['activeColumn'];	
		$tableName 		= $this->config['tableName'];
		
		if( ! empty($activeColumn) )
		{
			$db = uselib('DB');
			
			$totalRows = $db->where($activeColumn.' =', 1)
							 ->get($tableName)
							 ->totalRows();
			
			if( ! empty($totalRows) )
			{
				return $totalRows;
			}
			else
			{
				return 0;		
			}
		}
		
		return false;
	}
	
	/******************************************************************************************
	* TOTAL BANNED USERS                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcılardan yasaklı olanların sayısını verir.		        		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: totalBannedUsers(); 									              |
	|          																				  |
	******************************************************************************************/
	public function totalBannedUsers()
	{
		$bannedColumn 	= $this->config['bannedColumn'];	
		$tableName 		= $this->config['tableName'];
		
		if( ! empty($bannedColumn) )
		{	
			$db = uselib('DB');
			
			$totalRows = $db->where($bannedColumn.' =', 1)
							 ->get($tableName)
						 	 ->totalRows();
			
			if( ! empty($totalRows) )
			{
				return $totalRows;
			}
			else
			{
				return 0;		
			}
		}
		
		return false;
	}
	
	/******************************************************************************************
	* TOTAL USERS                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcıların toplam sayısını verir.		        		              |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: totalBannedUsers(); 									              |
	|          																				  |
	******************************************************************************************/
	public function totalUsers()
	{
		$tableName = $this->config['tableName'];
		
		$db = uselib('DB');
		
		$totalRows = $db->get($tableName)->totalRows();
		
		if( ! empty($totalRows) )
		{
			return $totalRows;
		}
		else
		{
			return 0;		
		}
	}
	
	/******************************************************************************************
	* LOGIN                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcı girişi yapmak için kullanılır.		        		          |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @username => Kullanıcı adı parametresi.								      |
	| 2. string var @password => Kullanıcı şifre parametresi.								  |
	| 3. boolean var @remember_me => Kullanıcı adı ve şifresi hatırlansın mı?.				  |
	|          																				  |
	| Örnek Kullanım: login('zntr', '1234', true);       		                              |
	|          																				  |
	******************************************************************************************/	
	public function login($un = 'username', $pw = 'password', $rememberMe = false)
	{
		if( ! is_string($un) ) 
		{
			return Error::set('User', 'login', lang('Error', 'stringParameter', 'un'));
		}
		
		if( ! is_string($pw) ) 
		{
			return Error::set('User', 'login', lang('Error', 'stringParameter', 'pw'));
		}
		
		if( ! isValue($rememberMe) ) 
		{
			$rememberMe = false;
		}

		$username = $un;
		$password = Encode::super($pw);
		
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$userConfig			= $this->config;	
		$passwordColumn  	= $userConfig['passwordColumn'];
		$usernameColumn  	= $userConfig['usernameColumn'];
		$emailColumn  		= $userConfig['emailColumn'];
		$tableName 			= $userConfig['tableName'];
		$bannedColumn 		= $userConfig['bannedColumn'];
		$activeColumn 		= $userConfig['activeColumn'];
		$activationColumn 	= $userConfig['activationColumn'];
		// ------------------------------------------------------------------------------
		
		$db = uselib('DB');
		
		$r = $db->where($usernameColumn.' =', $username)
			    ->get($tableName)
				->row();
		
		if( empty($r) )
		{
			$this->error = lang('User', 'loginError');	
			return Error::set('User', 'login', $this->error);
		}
		
		if( ! isset($r->$passwordColumn) )
		{
			$this->error = lang('User', 'loginError');	
			return Error::set('User', 'login', $this->error);
		}
				
		$passwordControl   = $r->$passwordColumn;
		$bannedControl     = '';
		$activationControl = '';
		
		if( ! empty($bannedColumn) )
		{
			$banned = $bannedColumn ;
			$bannedControl = $r->$banned ;
		}
		
		if( ! empty($activationColumn) )
		{
			$activationControl = $r->$activationColumn ;			
		}
		
		if( ! empty($r->$usernameColumn) && $passwordControl == $password )
		{
			if( ! empty($bannedColumn) && ! empty($bannedControl) )
			{
				$this->error = lang('User', 'bannedError');	
				return Error::set('User', 'login', $this->error);
			}
			
			if( ! empty($activationColumn) && empty($activationControl) )
			{
				$this->error = lang('User', 'activationError');	
				return Error::set('User', 'login', $this->error);
			}
			
			if( ! isset($_SESSION) ) 
			{
				session_start();
			}
			
			$_SESSION[md5($usernameColumn)] = $username; 
			
			session_regenerate_id();
			
			if( Method::post($rememberMe) || ! empty($rememberMe) )
			{
				if( Cookie::select(md5($usernameColumn)) != $username )
				{					
					Cookie::insert(md5($usernameColumn), $username);
					Cookie::insert(md5($passwordColumn), $password);
				}
			}
			
			if( ! empty($activeColumn) )
			{		
				$db->where($usernameColumn.' =', $username)->update($tableName, array($activeColumn  => 1));
			}
			
			$this->error = false;
			$this->success = lang('User', 'loginSuccess');
			return true;
		}
		else
		{
			$this->error = lang('User', 'loginError');	
			return Error::set('User', 'login', $this->error);
		}
	}
	
	/******************************************************************************************
	* FORGOT PASSWORD                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Şifremi unuttum uygulamasıdır.		        		         		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @email => Kullanıcı e-posta adresi veya kullanıcı adı.					  |
	| 2. string var @return_link_path => e-postaya gönderilen linkin dönüş sayfası.			  |
	|          																				  |
	| Örnek Kullanım: forgotPassword('bilgi@zntr.net', 'kullanici/giris');       		      |
	|          																				  |
	******************************************************************************************/	
	public function forgotPassword($email = "", $returnLinkPath = "")
	{
		if( ! is_string($email) ) 
		{
			return Error::set('User', 'forgotPassword', lang('Error', 'stringParameter', 'email'));
		}
		
		if( ! is_string($returnLinkPath) ) 
		{
			$returnLinkPath = '';
		}

		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$userConfig		= $this->config;	
		$usernameColumn = $userConfig['usernameColumn'];
		$passwordColumn = $userConfig['passwordColumn'];				
		$emailColumn  	= $userConfig['emailColumn'];		
		$tableName 		= $userConfig['tableName'];	
		// ------------------------------------------------------------------------------
		
		$db = uselib('DB');
		
		if( ! empty($emailColumn) )
		{
			$db->where($emailColumn.' =', $email);
		}
		else
		{
			$db->where($usernameColumn.' =', $email);
		}
		
		$row = $db->get($tableName)->row();
		
		$result = "";
		
		if( isset($row->$usernameColumn) ) 
		{
			
			if( ! isUrl($returnLinkPath) ) 
			{
				$returnLinkPath = siteUrl($returnLinkPath);
			}
			
			$newPassword    = Encode::create(10);
			$encodePassword = Encode::super($newPassword);
			$message = "
			<pre>
				".lang('User', 'username').": ".$row->$usernameColumn."

				".lang('User', 'password').": ".$newPassword."
				
				<a href='".$returnLinkPath."'>".lang('User', 'learnNewPassword')."</a>
			</pre>
			";
			
			$sendEmail = uselib('Email');
			
			$sendEmail->receiver($email, $email);
			$sendEmail->subject(lang('User', 'newYourPassword'));
			$sendEmail->content($message);
			
			if( $sendEmail->send() )
			{
				if( ! empty($emailColumn) )
				{
					$db->where($emailColumn.' =', $email);
				}
				else
				{
					$db->where($usernameColumn.' =', $email);
				}
				
				$db->update($tableName, array($passwordColumn => $encodePassword));

				$this->error = true;	
				$this->success = lang('User', 'forgotPasswordSuccess');
				return false;
			}
			else
			{	
				$this->success = false;
				$this->error = lang('User', 'emailError');
				return Error::set('User', 'forgotPassword', $this->error);
			}
		}
		else
		{
			$this->success = false;
			$this->error = lang('User', 'forgotPasswordError');	
			return Error::set('User', 'forgotPassword', $this->error);
		}
	}
	
	/******************************************************************************************
	* IS LOGIN                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcının oturum açıp açmadığını kontrol etmek için kullanılır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: isLogin();      														  |
	|          																				  |
	******************************************************************************************/	
	public function isLogin()
	{
		$config    = $this->config;
		$username  = $config['usernameColumn'];
		$tableName = $config['tableName'];
		$password  = $config['passwordColumn']; 
		
		$cUsername = Cookie::select(md5($username));
		$cPassword = Cookie::select(md5($password));
		
		$result = '';
		
		if( ! empty($cUsername) && ! empty($cPassword) )
		{
			$db = uselib('DB');
			
			$result = $db->where($username.' =', $cUsername, 'and')
						 ->where($password.' =', $cPassword)
						 ->get($tableName)
						 ->totalRows();
		}
		
		
		if( isset($this->data($tableName)->$username) )
		{
			$isLogin = true;
		}
		elseif( ! empty($result) )
		{
			if( ! isset($_SESSION) ) 
			{
				session_start();
			}
			
			$_SESSION[md5($username)] = $cUsername;
			
			$isLogin = true;	
		}
		else
		{
			$isLogin = false;	
		}
				
		return $isLogin;
	}
	
	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Oturum açmış kullanıcın veritabanı bilgilerine erişimek için kullanılır.|
	| Çıktı olarak object türünde veri dizisi döndürür.										  |
	|          																				  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: $data = data();      													  |
	|          																				  |
	| $data->sutun_adi          															  |
	|          																				  |
	******************************************************************************************/	
	public function data($tbl = '')
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
		$config 		= $this->config;
		$usernameColumn = $config['usernameColumn'];
		
		if( isset($_SESSION[md5($usernameColumn)]) )
		{
			$joinTables		= $config['joinTables'];
			$usernameColumn = $config['usernameColumn'];
			$joinColumn 	= $config['joinColumn'];
			$tableName 		= $config['tableName'];
			
			$this->username = $_SESSION[md5($usernameColumn)];
			
			$db = uselib('DB');
		
			$r[$tbl] = $db->where($usernameColumn.' =',$this->username)
					->get($tableName)
					->row();
	
			if( ! empty($joinTables) )
			{
				$joinCol = $db->where($usernameColumn.' =',$this->username)
							  ->get($tableName)
							  ->row()
							  ->$joinColumn;
			
				foreach( $joinTables as $table => $joinColumn )	
				{
					$r[$table] = $db->where($joinColumn.' =', $joinCol)
									->get($table)
									->row();
				}
			}
			
			if( empty($joinTables) )
			{
				return (object)$r[$tbl];
			}
			else
			{
				if( ! empty($tbl) )
				{
					return (object)$r[$tbl];
				}
				else
				{
					return (object)$r;
				}
			}
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* LOGOUT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Oturumu sonlandırmak için kullanılır.									  |
	|          																				  |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @redirect_url => Çıkış sonrası yönlendirilecek sayfa.                     |
	| 1. numeric var @time => çıkış yapıldıktan sonra yönlendirme için bekleme süresi.        |
	|          																				  |
	| Örnek Kullanım: logout('kullanici/giris');      									      |
	|          																				  |
	******************************************************************************************/
	public function logout($redirectUrl = '', $time = 0)
	{	
		if( ! is_string($redirectUrl) ) 
		{
			$redirectUrl = '';
		}
		
		if( ! is_numeric($time) ) 
		{
			$time = 0;
		}

		$config    = $this->config;
		$username  = $config['usernameColumn'];
		$tableName = $config['tableName'];
		
		if( isset($this->data($tableName)->$username) )
		{
			if( ! isset($_SESSION) ) 
			{
				session_start();
			}
			
			if( $config['activeColumn'] )
			{	
				$db = uselib('DB');
				
				$db->where($config['usernameColumn'].' =', $this->data($tableName)->$username)
				   ->update($config['tableName'], array($config['activeColumn'] => 0));
			}
			
			Cookie::delete(md5($config['usernameColumn']));
			Cookie::delete(md5($config['passwordColumn']));	
			
			if( isset($_SESSION[md5($config['usernameColumn'])]) ) 
			{
				unset($_SESSION[md5($config['usernameColumn'])]);
			}
			
			redirect($redirectUrl, $time);
		}
		
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcı işlemlerinde oluşan hata bilgilerini tutması içindir.         |
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		if( ! empty($this->error) ) 
		{
			Error::set('User', 'error', $this->error);
			return $this->error; 
		}
		else 
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* SUCCESS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcı işlemlerinde başarı bilgilerini tutması içindir.              |
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function success()
	{
		if( ! empty($this->success) ) 
		{
			return $this->success; 
		}
		else 
		{
			return false;
		}
	}
}