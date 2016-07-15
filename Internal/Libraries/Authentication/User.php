<?php
namespace ZN\Authentication;

class InternalUser implements UserInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Protected Username
	//----------------------------------------------------------------------------------------------------
	//
	// Kullanıcı adı bilgisi 
	//
	// @var  string
	//
	//----------------------------------------------------------------------------------------------------
	protected $username;
	
	//----------------------------------------------------------------------------------------------------
	// Protected Password
	//----------------------------------------------------------------------------------------------------
	//
	// Şifre sütun bilgisi 
	//
	// @var  string
	//
	//----------------------------------------------------------------------------------------------------
	protected $password;
	
	//----------------------------------------------------------------------------------------------------
	// Protected Parameters
	//----------------------------------------------------------------------------------------------------
	//
	// Parametreler bilgisi 
	//
	// @var  array
	//
	//----------------------------------------------------------------------------------------------------
	protected $parameters;
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->config();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
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
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Register Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Auto Login
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  mixed $autoLogin
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function autoLogin($autoLogin = true)
	{
		$this->parameters['autoLogin'] = $autoLogin;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Return Link
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $returnLink
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function returnLink($returnLink = '')
	{
		$this->parameters['returnLink'] = $returnLink;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Register
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  array 	   $data
	// @param  bool/string $autoLogin
	// @param  string      $activationReturnLink
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function register($data = [], $autoLogin = false, $activationReturnLink = '')
	{
		if( isset($this->parameters['column']) )
		{
			$data = $this->parameters['column'];
		}
		
		if( isset($this->parameters['autoLogin']) )
		{
			$autoLogin = $this->parameters['autoLogin'];
		}
		
		if( isset($this->parameters['returnLink']) )
		{
			$activationReturnLink = $this->parameters['returnLink'];
		}
			
		$this->parameters = [];
			
		if( ! is_array($data) ) 
		{
			return \Errors::set('Error', 'arrayParameter', '1.(data)');
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
		$getColumns 		= $userConfig['matching']['columns'];
		$getJoining 		= $userConfig['joining'];
		$tableName 			= $userConfig['matching']['table'];
		$joinTables  		= $getJoining['tables'];
		$joinColumn  		= $getJoining['column'];	
		$usernameColumn  	= $getColumns['username'];
		$passwordColumn  	= $getColumns['password'];
		$emailColumn  	    = $getColumns['email'];
		$activeColumn 		= $getColumns['active'];
		$activationColumn 	= $getColumns['activation'];
		// ------------------------------------------------------------------------------
		
		// Kullanıcı adı veya şifre sütunu belirtilmemişse 
		// İşlemleri sonlandır.
		if( ! empty($joinTables) )
		{
			$joinData = $data;
			$data 	  = isset($data[$tableName])
				  	  ? $data[$tableName]
			      	  : [$tableName];
		}
		
		if( ! isset($data[$usernameColumn]) ||  ! isset($data[$passwordColumn]) ) 
		{
			return ! $this->error = lang('User', 'registerUsernameError');
		}
		
		$loginUsername  = $data[$usernameColumn];
		$loginPassword  = $data[$passwordColumn];	
		$encodeType     = $userConfig['encode'];
		$encodePassword = ! empty($encodeType) ? \Encode::type($loginPassword, $encodeType) : $loginPassword;	
		
		$usernameControl = \DB::where($usernameColumn.' =', $loginUsername)
							  ->get($tableName)
							  ->totalRows();
		
		// Daha önce böyle bir kullanıcı
		// yoksa kullanıcı kaydetme işlemini başlat.
		if( empty($usernameControl) )
		{
			$data[$passwordColumn] = $encodePassword;
			
			if( ! \DB::insert($tableName , $data) )
			{
				return ! $this->error = lang('User', 'registerUnknownError');
			}	

			if( ! empty($joinTables) )
			{	
				$joinCol = \DB::where($usernameColumn.' =', $loginUsername)->get($tableName)->row()->$joinColumn;
				
				foreach( $joinTables as $table => $joinColumn )
				{
					$joinData[$table][$joinTables[$table]] = $joinCol;
					
					\DB::insert($table, $joinData[$table]);	
				}	
			}
		
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
			return ! $this->error = lang('User', 'registerError');
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Register Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Update Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Old Password
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $oldPassword
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function oldPassword($oldPassword = '')
	{
		$this->parameters['oldPassword'] = $oldPassword;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// New Password
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $Password
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function newPassword($newPassword = '')
	{
		$this->parameters['newPassword'] = $newPassword;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Password Again
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $passwordAgain
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function passwordAgain($passwordAgain = true)
	{
		$this->parameters['passwordAgain'] = $passwordAgain;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Password Again
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $passwordAgain
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function column($column = '', $value = '')
	{
		$this->parameters['column'][$column] = $value;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Update
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $old
	// @param  string $new
	// @param  string $newAgain
	// @param  array  $data
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function update($old = '', $new = '', $newAgain = '', $data = [])
	{
		// Bu işlem için kullanıcının
		// oturum açmıl olması gerelidir.
		if( $this->isLogin() )
		{
			if( isset($this->parameters['oldPassword']) )
			{
				$old = $this->parameters['oldPassword'];
			}
			
			if( isset($this->parameters['newPassword']) )
			{
				$new = $this->parameters['newPassword'];
			}
			
			if( isset($this->parameters['passwordAgain']) )
			{
				$newAgain = $this->parameters['passwordAgain'];
			}
			
			if( isset($this->parameters['column']) )
			{
				$data = $this->parameters['column'];
			}
			
			$this->parameters = [];
		
			// Parametreler kontrol ediliyor.--------------------------------------------------
			if( ! is_string($old) || ! is_string($new) || ! is_array($data) ) 
			{
				\Errors::set('Error', 'stringParameter', '1.(old)');
				\Errors::set('Error', 'stringParameter', '2.(new)');
				\Errors::set('Error', 'arrayParameter', '4.(data)');
				
				return false;
			}
				
			if( empty($old) || empty($new) ) 
			{
				\Errors::set('Error', 'emptyParameter', '1.(old)');
				\Errors::set('Error', 'emptyParameter', '2.(new)');
				
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
			$getColumns = $userConfig['matching']['columns'];
			$getJoining = $userConfig['joining'];
			$joinTables = $getJoining['tables'];
			$jc 		= $getJoining['column'];
			$pc 		= $getColumns['password'];
			$uc 		= $getColumns['username'];	
			$tn 		= $userConfig['matching']['table'];
			
			$encodeType   = $userConfig['encode'];
			
			$oldPassword      = ! empty($encodeType) ? \Encode::type($old, $encodeType)      : $old;
			$newPassword      = ! empty($encodeType) ? \Encode::type($new, $encodeType)      : $new;
			$newPasswordAgain = ! empty($encodeType) ? \Encode::type($newAgain, $encodeType) : $newAgain;
			
			if( ! empty($joinTables) )
			{
				$joinData = $data;
				$data     = isset($data[$tn])
					      ? $data[$tn]
					      : [$tn];	
			}
		
			$username = $this->data($tn)->$uc;
			$password = $this->data($tn)->$pc;
		
			$row 	  = "";
		
			if( $oldPassword != $password )
			{
				return ! $this->error = lang('User', 'oldPasswordError');	
			}
			elseif( $newPassword != $newPasswordAgain )
			{
				return ! $this->error = lang('User', 'passwordNotMatchError');
			}
			else
			{
				$data[$pc] = $newPassword;
				$data[$uc] = $username;
				
				if( ! empty($joinTables) )
				{
					$joinCol = \DB::where($uc.' =', $username)->get($tn)->row()->$jc;
					
					foreach( $joinTables as $table => $joinColumn )
					{
						if( isset($joinData[$table]) )
						{
							\DB::where($joinColumn.' =', $joinCol)->update($table, $joinData[$table]);	
						}
					}	
				}
				else
				{
					if( ! \DB::where($uc.' =', $username)->update($tn, $data) )
					{
						return ! $this->error = lang('User', 'registerUnknownError');
					}	
				}
				
				return $this->success = lang('User', 'updateProcessSuccess');		
			}
		}
		else 
		{
			return false;		
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Update Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Activation Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Activation Complete
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function activationComplete()
	{
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------
		$userConfig			= $this->config;	
		$getColumns         = $userConfig['matching']['columns'];
		$tableName 			= $userConfig['matching']['table'];
		$usernameColumn  	= $getColumns['username'];
		$passwordColumn  	= $getColumns['password'];
		$activationColumn 	= $getColumns['activation'];
		// ------------------------------------------------------------------------------
		
		// Aktivasyon dönüş linkinde yer alan segmentler -------------------------------
		$user = \Uri::get('user');
		$pass = \Uri::get('pass');
		// ------------------------------------------------------------------------------
		
		if( ! empty($user) && ! empty($pass) )	
		{
			$row = \DB::where($usernameColumn.' =', $user, 'and')
			          ->where($passwordColumn.' =', $pass)		
			          ->get($tableName)
					  ->row();	
				
			if( ! empty($row) )
			{
				\DB::where($usernameColumn.' =', $user)
				   ->update($tableName, [$activationColumn => '1']);
				
				return $this->success = lang('User', 'activationComplete');
			}	
			else
			{
				return ! $this->error = lang('User', 'activationCompleteError');
			}				
		}
		else
		{
			return ! $this->error = lang('User', 'activationCompleteError');
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Activation
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $user
	// @param  string $pass
	// @param  string $activationReturnLink
	// @param  string $email
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	protected function _activation($user = '', $pass = '', $activationReturnLink = '', $email = '')
	{
		if( ! isUrl($activationReturnLink) )
		{
			$url = baseUrl(suffix($activationReturnLink));
		}
		else
		{
			$url = suffix($activationReturnLink);
		}
		
		$senderInfo = $this->config['emailSenderInfo'];
		
		$templateData = array
		(
			'url'  => $url,
			'user' => $user,
			'pass' => $pass
		);
		
		$message = \Import::template('UserEmail/Activation', $templateData, true);	
		
		$user = ! empty($email) 
				? $email 
				: $user;
				
		\Email::sender($senderInfo['mail'], $senderInfo['name'])
		      ->receiver($user, $user)
		      ->subject(lang('User', 'activationProcess'))
		      ->content($message);
		
		if( \Email::send() )
		{
			return $this->success = lang('User', 'activationEmail');
		}
		else
		{	
			return ! $this->error = lang('User', 'emailError');
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Activation Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Info Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Data
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $tbl
	// @return object
	//
	//----------------------------------------------------------------------------------------------------
	public function data($tbl = '')
	{
		$config 		= $this->config;
		$usernameColumn = $config['matching']['columns']['username'];
		$passwordColumn = $config['matching']['columns']['password'];
		
		if( $sessionUserName = \Session::select($usernameColumn) )
		{
			$joinTables		= $config['joining']['tables'];
			$usernameColumn = $config['matching']['columns']['username'];
			$joinColumn 	= $config['joining']['column'];
			$tableName 		= $config['matching']['table'];
			
			$this->username  = $sessionUserName;
			$sessionPassword = \Session::select($passwordColumn);
			
			$r[$tbl] = \DB::where($usernameColumn.' = ', $this->username, 'and')
						  ->where($passwordColumn.' = ', $sessionPassword)
					      ->get($tableName)
					      ->row();
	
			if( ! empty($joinTables) )
			{
				$joinCol = \DB::where($usernameColumn.' = ', $this->username, 'and')
						      ->where($passwordColumn.' = ', $sessionPassword)
							  ->get($tableName)
							  ->row()
							  ->$joinColumn;
			
				foreach( $joinTables as $table => $joinColumn )	
				{
					$r[$table] = \DB::where($joinColumn.' =', $joinCol)
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
	
	//----------------------------------------------------------------------------------------------------
	// Active Count
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return numeric
	//
	//----------------------------------------------------------------------------------------------------
	public function activeCount()
	{
		$activeColumn 	= $this->config['matching']['columns']['active'];	
		$tableName 		= $this->config['matching']['table'];
		
		if( ! empty($activeColumn) )
		{
			$totalRows = \DB::where($activeColumn.' =', 1)
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
	
	//----------------------------------------------------------------------------------------------------
	// Banned Count
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return numeric
	//
	//----------------------------------------------------------------------------------------------------
	public function bannedCount()
	{
		$bannedColumn 	= $this->config['matching']['columns']['banned'];	
		$tableName 		= $this->config['matching']['table'];
		
		if( ! empty($bannedColumn) )
		{	
			$totalRows = \DB::where($bannedColumn.' =', 1)
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
	
	//----------------------------------------------------------------------------------------------------
	// Count
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return numeric
	//
	//----------------------------------------------------------------------------------------------------
	public function count()
	{
		$tableName = $this->config['matching']['table'];
		
		$totalRows = \DB::get($tableName)->totalRows();
		
		if( ! empty($totalRows) )
		{
			return $totalRows;
		}
		else
		{
			return 0;		
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Info Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Login Methods Başlangıç
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Username
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $username
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function username($username = '')
	{
		$this->parameters['username'] = $username;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Password
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $password
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function password($password = '')
	{
		$this->parameters['password'] = $password;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Remember
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  bool $remember
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function remember($remember = true)
	{
		$this->parameters['remember'] = $remember;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Login
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $un
	// @param  string $pw
	// @param  bool   $rememberMe
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function login($un = 'username', $pw = 'password', $rememberMe = false)
	{
		if( isset($this->parameters['username']) )
		{
			$un = $this->parameters['username'];
		}
		
		if( isset($this->parameters['password']) )
		{
			$pw = $this->parameters['password'];
		}
		
		if( isset($this->parameters['remember']) )
		{
			$rememberMe = $this->parameters['remember'];
		}
		
		$this->parameters = [];
		
		if( ! is_string($un) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(username)');
		}
		
		if( ! is_string($pw) ) 
		{
			return \Errors::set('Error', 'stringParameter', '2.(password)');
		}
		
		if( ! is_scalar($rememberMe) ) 
		{
			$rememberMe = false;
		}

		$username = $un;
		
		$userConfig	= $this->config;
		
		$encodeType = $userConfig['encode'];
		
		$password = ! empty($encodeType) ? \Encode::type($pw, $encodeType) : $pw;
		
		// ------------------------------------------------------------------------------
		// CONFIG/USER.PHP AYARLARI
		// Config/User.php dosyasında belirtilmiş ayarlar alınıyor.
		// ------------------------------------------------------------------------------	
		$tableName 			= $userConfig['matching']['table'];
		$getColumns         = $userConfig['matching']['columns'];
		$passwordColumn  	= $getColumns['password'];
		$usernameColumn  	= $getColumns['username'];
		$emailColumn  		= $getColumns['email'];
		$bannedColumn 		= $getColumns['banned'];
		$activeColumn 		= $getColumns['active'];
		$activationColumn 	= $getColumns['activation'];
		// ------------------------------------------------------------------------------
		
		$r = \DB::where($usernameColumn.' =', $username)
			    ->get($tableName)
			    ->row();
		
		if( ! isset($r->$passwordColumn) )
		{
			return ! $this->error = lang('User', 'loginError');
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
				return ! $this->error = lang('User', 'bannedError');
			}
			
			if( ! empty($activationColumn) && empty($activationControl) )
			{
				return ! $this->error = lang('User', 'activationError');
			}
			
			\Session::insert($usernameColumn, $username); 
			\Session::insert($passwordColumn, $password);
			
			if( \Method::post($rememberMe) || ! empty($rememberMe) )
			{
				if( \Cookie::select($usernameColumn) != $username )
				{					
					\Cookie::insert($usernameColumn, $username);
					\Cookie::insert($passwordColumn, $password);
				}
			}
			
			if( ! empty($activeColumn) )
			{		
				\DB::where($usernameColumn.' =', $username)->update($tableName, [$activeColumn  => 1]);
			}
			
			return $this->success = lang('User', 'loginSuccess');
		}
		else
		{
			return ! $this->error = lang('User', 'loginError');
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Logout
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $redirectUrl
	// @param  numeric $time
	// @return void
	//
	//----------------------------------------------------------------------------------------------------
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

		$config     = $this->config;
		$getColumns = $config['matching']['columns'];
		$tableName  = $config['matching']['table'];
		$username   = $getColumns['username'];
		$password   = $getColumns['password'];
		$active     = $getColumns['active'];
	
		if( isset($this->data($tableName)->$username) )
		{
			if( $active )
			{	
				\DB::where($username.' =', $this->data($tableName)->$username)
				   ->update($tableName, [$active => 0]);
			}
			
			\Cookie::delete($username);
			\Cookie::delete($password );			
			\Session::delete($username);
			
			redirect($redirectUrl, $time);
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Is Login
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function isLogin()
	{
		$config     = $this->config;
		$getColumns = $config['matching']['columns'];
		$tableName  = $config['matching']['table'];
		$username   = $getColumns['username'];
		$password   = $getColumns['password']; 
		
		$cUsername = \Cookie::select($username);
		$cPassword = \Cookie::select($password);
		
		$result = '';
		
		if( ! empty($cUsername) && ! empty($cPassword) )
		{	
			$result = \DB::where($username.' =', $cUsername, 'and')
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
			\Session::insert($username, $cUsername);
			
			$isLogin = true;	
		}
		else
		{
			$isLogin = false;	
		}
				
		return $isLogin;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Login Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Forgot Password Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Username
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $username
	// @return this
	//
	//----------------------------------------------------------------------------------------------------
	public function email($email = '')
	{
		$this->parameters['email'] = $email;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Forgot Password
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $email
	// @param  string $returnLinkPath
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function forgotPassword($email = '', $returnLinkPath = '')
	{
		if( isset($this->parameters['email']) )
		{
			$email = $this->parameters['email'];
		}
		
		if( isset($this->parameters['returnLink']) )
		{
			$returnLinkPath = $this->parameters['returnLink'];
		}
			
		$this->parameters = [];
		
		if( ! is_string($email) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(email)');
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
		$tableName 		= $userConfig['matching']['table'];	
		$senderInfo 	= $userConfig['emailSenderInfo'];
		$getColumns     = $userConfig['matching']['columns'];
		$usernameColumn = $getColumns['username'];
		$passwordColumn = $getColumns['password'];				
		$emailColumn  	= $getColumns['email'];		
		
		// ------------------------------------------------------------------------------
		
		if( ! empty($emailColumn) )
		{
			\DB::where($emailColumn.' =', $email);
		}
		else
		{
			\DB::where($usernameColumn.' =', $email);
		}
		
		$row = \DB::get($tableName)->row();
		
		$result = "";
		
		if( isset($row->$usernameColumn) ) 
		{
			if( ! isUrl($returnLinkPath) ) 
			{
				$returnLinkPath = siteUrl($returnLinkPath);
			}
			
			$encodeType     = $userConfig['encode'];
			
			$newPassword    = \Encode::create(10);
			$encodePassword = ! empty($encodeType) ? \Encode::type($newPassword, $encodeType) : $newPassword;
			
			$templateData = array
			(
				'usernameColumn' => $row->$usernameColumn,
				'newPassword'    => $newPassword,
				'returnLinkPath' => $returnLinkPath
			);

			$message   = \Import::template('UserEmail/ForgotPassword', $templateData, true);	
			
			\Email::sender($senderInfo['mail'], $senderInfo['name'])
			      ->receiver($email, $email)
			      ->subject(lang('User', 'newYourPassword'))
			      ->content($message);
			
			if( \Email::send() )
			{
				if( ! empty($emailColumn) )
				{
					\DB::where($emailColumn.' =', $email);
				}
				else
				{
					\DB::where($usernameColumn.' =', $email);
				}
				
				if( \DB::update($tableName, [$passwordColumn => $encodePassword]) )
				{
					return $this->success = lang('User', 'forgotPasswordSuccess');
				}
				
				return ! $this->error = lang('Database', 'updateError');
			}
			else
			{	
				return ! $this->error = lang('User', 'emailError');
			}
		}
		else
		{
			return ! $this->error = lang('User', 'forgotPasswordError');
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Forgot Password Method Bitiş
	//----------------------------------------------------------------------------------------------------
}