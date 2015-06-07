<?php
/************************************************************/
/*                        CLASS  USER                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* USER                                                                              	  *
*******************************************************************************************
| Dahil(Import) Edilirken : User   								                          |
| Sınıfı Kullanırken      :	user::   												      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class User
{
	
	/* Username Değişkeni
	 *  
	 * Kullanıcı adı bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $username;
	
	/* Password Değişkeni
	 *  
	 * Kullanıcı şifre bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $password;
	
	/* Error Değişkeni
	 *  
	 * Kullanıcı işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $error;
	
	/* Success Değişkeni
	 *  
	 * Kullanıcı işlemlerin bilgilerini
	 * bilgisini tutması için oluşturulmuştur.
	 *
	 */
	private static $success;
	
	/******************************************************************************************
	* REGISTER                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcıyı kaydetmek için kullanılır.		        		          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. array var @data => Kaydedilecek üye bilgileri anahtar değer çifti içeren bir dizi    |
	| içeriği ile kaydedilir. Dizideki anahtar ifadeler sütun isimlerini değer ifadeleri ise  |
	| bu sütuna kaydedilecek veriyi belirtir.											 	  |
	| 2. [ string var @activation_return_link ] => Aktivasyon yapılacaksa kayıt yapılırken    |
	| kullanıcıya gönderilen aktivasyon mailinin içerisindeki linke tıkladığında gidilecek	  |
	| sayfa belirtilir. Bu parametre isteğe bağlıdır.                                         |
	|          																				  |
	| Örnek Kullanım: register(array('user' => 'zntr', 'pass' => '1234'));       		      |
	|          																				  |
	******************************************************************************************/
	public static function register($data = array(), $activation_return_link = '')
	{
		if( ! is_array($data) ) 
		{
			return false;
		}
		if( ! is_string($activation_return_link) ) 
		{
			$activation_return_link = '';
		}
		
		// ------------------------------------------------------------------------------
		// USER DİL DOSYASINI YÜKLE
		// ------------------------------------------------------------------------------
		import::language("User");
		// ------------------------------------------------------------------------------
		
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$user_config		= config::get("User");		
		$username_column  	= $user_config["username_column"];
		$password_column  	= $user_config["password_column"];
		$email_column  	    = $user_config["email_column"];
		$table_name 		= $user_config["table_name"];
		$active_column 		= $user_config["active_column"];
		$activation_column 	= $user_config["activation_column"];
		// ------------------------------------------------------------------------------
		
		// Kullanıcı adı veya şifre sütunu belirtilmemişse 
		// İşlemleri sonlandır.
		if( ! isset($data[$username_column]) ||  ! isset($data[$password_column]) ) 
		{
			return false;
		}
		
		$login_username  = $data[$username_column];
		$login_password  = $data[$password_column];	
		$encode_password = encode::super($login_password);	
		
		$db = new Db;
		
		$username_control = $db->where($username_column.' =',$login_username)
							   ->get($table_name)
							   ->total_rows();
		
		// Daha önce böyle bir kullanıcı
		// yoksa kullanıcı kaydetme işlemini başlat.
		if( empty($username_control) )
		{
			$data[$password_column] = $encode_password;
			
			if( $db->insert($table_name , $data) )
			{
				self::$error = false;
				self::$success = lang('user_register_success');
				
				if( ! empty($activation_column) )
				{
					if( ! is_email($login_username) )
					{
						$email = $data[$email_column];
					}
					else
					{ 
						$email = '';
					}
					
					self::_activation($login_username, $encode_password, $activation_return_link, $email);				
				}
				else
				{
					self::login($login_username, $login_password);
				}
				
				return true;
			}
			else
			{
				self::$error = lang('user_register_unknown_error');	
				return false;
			}
		}
		else
		{
			self::$error = lang('user_register_error');
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
	| Örnek Kullanım: activation_complete(); 									              |
	| NOT: Aktivasyon dönüş linkinin belirtiği sayfada kullanılmalıdır                        |
	|          																				  |
	******************************************************************************************/
	public static function activation_complete()
	{
		import::language("User");
		
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$user_config		= config::get("User");	
		$table_name 		= $user_config["table_name"];
		$username_column  	= $user_config["username_column"];
		$password_column  	= $user_config["password_column"];
		$activation_column 	= $user_config["activation_column"];
		// ------------------------------------------------------------------------------
		
		// Aktivasyon dönüş linkinde yer alan segmentler -------------------------------
		$user = uri::get('user');
		$pass = uri::get('pass');
		// ------------------------------------------------------------------------------
		
		if( ! empty($user) && ! empty($pass) )	
		{
			$db = new Db;
			
			$row = $db->where($username_column.' =', $user, 'and')
			          ->where($password_column.' =', $pass)		
			          ->get($table_name)
					  ->row();	
				
			if( ! empty($row) )
			{
				$db->where($username_column.' =', $user)
				   ->update($table_name, array($activation_column => '1'));
				
				self::$success = lang("user_activation_complete");
				
				return true;
			}	
			else
			{
				self::$error = lang("user_activation_complete_error");
				return false;
			}				
		}
		else
		{
			self::$error = lang("user_activation_complete_error");
			return false;
		}
	}
	
	// Aktivasyon işlemi için
	private static function _activation($user = "", $pass = "", $activation_return_link = '', $email = '')
	{
		import::language("User");
		
		if( ! is_url($activation_return_link) )
		{
			$url = base_url(suffix($activation_return_link));
		}
		else
		{
			$url = suffix($activation_return_link);
		}
		
		$message = "<a href='".$url."user/".$user."/pass/".$pass."'>".lang("user_activation")."</a>";	
		
		$user = ( ! empty($email) ) 
				? $email 
				: $user;
		
		email::open();
		email::receiver($user, $user);
		
		if( email::send(lang("user_activation_process"), $message) )
		{
			self::$success = lang("user_activation_email");
			return true;
		}
		else
		{	
			self::$success = false;
			self::$error = lang("user_email_error");
			return false;
		}
		
		email::close();	
	}
	
	/******************************************************************************************
	* TOTAL ACTIVE USERS                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcılardan aktif olanların sayısını verir.		        		  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: total_active_users(); 									              |
	|          																				  |
	******************************************************************************************/
	public static function total_active_users()
	{
		$active_column 	= config::get("User","active_column");	
		$table_name 	= config::get("User","table_name");
		
		if( ! empty($active_column) )
		{
			$db = new Db;
			
			$total_rows = $db->where($active_column.' =', 1)
							 ->get($table_name)
							 ->total_rows();
			
			if( ! empty($total_rows) )
			{
				return $total_rows;
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
	| Örnek Kullanım: total_banned_users(); 									              |
	|          																				  |
	******************************************************************************************/
	public static function total_banned_users()
	{
		$banned_column 	= config::get("User","banned_column");	
		$table_name 	= config::get("User","table_name");
		
		if( ! empty($banned_column) )
		{	
			$db = new Db;
			
			$total_rows = $db->where($banned_column.' =', 1)
							 ->get($table_name)
						 	 ->total_rows();
			
			if( ! empty($total_rows) )
			{
				return $total_rows;
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
	| Örnek Kullanım: total_banned_users(); 									              |
	|          																				  |
	******************************************************************************************/
	public static function total_users()
	{
		$table_name = config::get("User","table_name");
		
		$db = new Db;
		
		$total_rows = $db->get($table_name)->total_rows();
		
		if( ! empty($total_rows) )
		{
			return $total_rows;
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
	public static function login($un = "username", $pw = "password", $remember_me = false)
	{
		if( ! is_string($un) ) 
		{
			return false;
		}
		if( ! is_string($pw) ) 
		{
			return false;
		}
		if( ! is_value($remember_me) ) 
		{
			$remember_me = false;
		}
		
		import::language("User");
		
		$username = $un;
		$password = encode::super($pw);
		
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$user_config		= config::get("User");	
		$password_column  	= $user_config["password_column"];
		$username_column  	= $user_config["username_column"];
		$email_column  		= $user_config["email_column"];
		$table_name 		= $user_config["table_name"];
		$banned_column 		= $user_config["banned_column"];
		$active_column 		= $user_config["active_column"];
		$activation_column 	= $user_config["activation_column"];
		// ------------------------------------------------------------------------------
		
		$db = new Db;
		
		$r = $db->where($username_column.' =',$username)
			    ->get($table_name)
				->row();
			
		$password_control   = $r->$password_column;
		$banned_control     = '';
		$activation_control = '';
		
		if( ! empty($banned_column) )
		{
			$banned = $banned_column ;
			$banned_control = $r->$banned ;
		}
		
		if( ! empty($activation_column) )
		{
			$activation_control = $r->$activation_column ;			
		}
		
		if( ! empty($r->$username_column) && $password_control == $password )
		{
			if( ! empty($banned_column) && ! empty($banned_control) )
			{
				self::$error = lang('user_banned_error');	
				return false;
			}
			
			if( ! empty($activation_column) && empty($activation_control) )
			{
				self::$error = lang('user_activation_error');	
				return false;
			}
			
			if( ! isset($_SESSION) ) 
			{
				session_start();
			}
			
			$_SESSION[md5($username_column)] = $username; 
			
			session_regenerate_id();
			
			if( method::post($remember_me) || ! empty($remember_me) )
			{
				if( cookie::select(md5($username_column)) != $username )
				{					
					cookie::insert(md5($username_column),$username);
					cookie::insert(md5($password_column),$password);
				}
			}
			
			if( ! empty($active_column) )
			{		
				$db->where($username_column.' =', $username)->update($table_name, array($active_column  => 1));
			}
			
			self::$error = false;
			self::$success = lang('user_login_success');
			return true;
		}
		else
		{
			self::$error = lang('user_login_error');	
			return false;
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
	| Örnek Kullanım: forgot_password('bilgi@zntr.net', 'kullanici/giris');       		      |
	|          																				  |
	******************************************************************************************/	
	public static function forgot_password($email = "", $return_link_path = "")
	{
		if( ! is_string($email) ) 
		{
			return false;
		}
		
		if( ! is_string($return_link_path) ) 
		{
			$return_link_path = '';
		}
		
		import::language("User");
		
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$user_config		= config::get("User");	
		$username_column  	= $user_config["username_column"];
		$password_column  	= $user_config["password_column"];				
		$email_column  		= $user_config["email_column"];		
		$table_name 		= $user_config["table_name"];	
		// ------------------------------------------------------------------------------
		
		$db = new Db;
		
		if( ! empty($email_column) )
		{
			$db->where($email_column.' =', $email);
		}
		else
		{
			$db->where($username_column.' =', $email);
		}
		
		$row = $db->get($table_name)->row();
		
		$result = "";
		
		if( isset($row->$username_column) ) 
		{
			
			if( ! is_url($return_link_path) ) 
			{
				$return_link_path = site_url($return_link_path);
			}
			
			$new_password    = encode::create(10);
			$encode_password = encode::super($new_password);
			$message = "
			<pre>
				".lang("user_username").": ".$row->$username_column."

				".lang("user_password").": ".$new_password."
				
				<a href='".$return_link_path."'>".lang("user_learn_new_password")."</a>
			</pre>
			";
			
			email::open();
			email::receiver($email, $email);
			
			if( email::send(lang("user_new_your_password"), $message) )
			{
				if( ! empty($email_column) )
				{
					$db->where($email_column.' =', $email);
				}
				else
				{
					$db->where($username_column.' =', $email);
				}
				
				$db->update($table_name, array($password_column => $encode_password));

				self::$error = true;	
				self::$success = lang("user_forgot_password_success");
				return false;
			}
			else
			{	
				self::$success = false;
				self::$error = lang("user_email_error");
				return false;
			}
			email::close();
		}
		else
		{
			self::$success = false;
			self::$error = lang("user_forgot_password_error");	
			return false;
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
	public static function update($old = '', $new = '', $new_again = '', $data = array())
	{
		// Bu işlem için kullanıcının
		// oturum açmıl olması gerelidir.
		if( self::is_login() )
		{
			// Parametreler kontrol ediliyor.--------------------------------------------------
			if( ! is_string($old) ) 
			{
				return false;
			}
			if( ! is_string($new) ) 
			{
				return false;	
			}
			if( ! is_string($new_again) ) 
			{
				$new_again = '';
			}
			if( ! is_array($data) ) 
			{
				return false;
			}
			// --------------------------------------------------------------------------------
			
			if( ! ( empty($old) || empty($new) || empty($data) ) ) 
			{
				return false;
			}
				
			// Şifre tekrar parametresi boş ise
			// Şifre tekrar parametresini doğru kabul et.
			if( empty($new_again) ) 
			{
				$new_again = $new;
			}
			
			import::language("User");
			
			$user_config = config::get("User");	
			$pc = $user_config["password_column"];
			$uc = $user_config["username_column"];	
			$tn = $user_config["table_name"];
			
			$old_password = encode::super($old);
			$new_password = encode::super($new);
			$new_password_again = encode::super($new_again);
			
			$username 	  = user::data()->$uc;
			$password 	  = user::data()->$pc;
			$row = "";
					
			if( $old_password != $password )
			{
				self::$error = lang("user_old_password_error");
				return false;	
			}
			elseif( $new_password != $new_password_again )
			{
				self::$error = lang("user_password_not_match_error");
				return false;
			}
			else
			{
				$data[$pc] = $new_password;
				$data[$uc] = $username;
				
				$db = new Db;
				
				$db->where($uc.' =', $username);
				
				if( $db->update($tn, $data) )
				{
					self::$error = false;
					self::$success = lang('update_process_success');
					return true;
				}
				else
				{
					self::$error = lang('user_register_unknown_error');	
					return false;
				}		
			}
			
		}
		else 
		{
			return false;		
		}
	}
	
	/******************************************************************************************
	* IS LOGIN                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Kullanıcının oturum açıp açmadığını kontrol etmek için kullanılır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: is_login();      														  |
	|          																				  |
	******************************************************************************************/	
	public static function is_login()
	{
		$c_username = cookie::select(md5(config::get("User","username_column")));
		$c_password = cookie::select(md5(config::get("User","password_column")));
		
		$result = '';
		
		if( ! empty($c_username) && ! empty($c_password) )
		{
			$db = new Db;
			$result = $db->where(config::get("User","username_column").' =',$c_username, 'and')
						 ->where(config::get("User","password_column").' =',$c_password)
						 ->get(config::get("User","table_name"))
						 ->total_rows();
		}
		
		$username = config::get("User","username_column");
		
		if( isset(self::data()->$username) )
		{
			$is_login = true;
		}
		elseif( ! empty($result) )
		{
			if( ! isset($_SESSION) ) 
			{
				session_start();
			}
			
			$_SESSION[md5(config::get("User","username_column"))] = $c_username;
			$is_login = true;	
		}
		else
		{
			$is_login = false;	
		}
				
		return $is_login;
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
	public static function data()
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}

		if( isset($_SESSION[md5(config::get("User","username_column"))]) )
		{
			$data = array();
			self::$username = $_SESSION[md5(config::get("User","username_column"))];
			
			$db = new Db;
			
			$r = $db->where(config::get("User","username_column").' =',self::$username)
				    ->get(config::get("User","table_name"))
					->row();
			
			return (object)$r;
		}
		else return false;
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
	public static function logout($redirect_url = '', $time = 0)
	{	
		if( ! is_string($redirect_url) ) 
		{
			$redirect_url = '';
		}
		
		if( ! is_numeric($time) ) 
		{
			$time = 0;
		}

		$username = config::get("User","username_column");
		
		if( isset(self::data()->$username) )
		{
			if( ! isset($_SESSION) ) 
			{
				session_start();
			}
			
			if( config::get("User","active_column") )
			{	
				$db = new Db;
				
				$db->where(config::get("User","username_column").' =', self::data()->$username)
				   ->update(config::get("User","table_name"), array(config::get("User","active_column") => 0));
			}
			
			cookie::delete(md5(config::get("User","username_column")));
			cookie::delete(md5(config::get("User","password_column")));	
			
			if( isset($_SESSION[md5(config::get("User","username_column"))]) ) 
			{
				unset($_SESSION[md5(config::get("User","username_column"))]);
			}
			
			redirect($redirect_url, $time);
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
	public static function error()
	{
		if( ! empty(self::$error) ) 
		{
			return self::$error; 
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
	public static function success()
	{
		if( ! empty(self::$success) ) 
		{
			return self::$success; 
		}
		else 
		{
			return false;
		}
	}
}