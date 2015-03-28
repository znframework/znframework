<?php
/************************************************************/
/*                        CLASS  USER                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class User
{
	
	// TABLE
	// data table -> user
	
	// COLUMN
	// password column -> password
	// username column -> username
	
	// DATA
	// id, role_id, username, email, ip, activation
	
	private static $username;
	private static $password;
	private static $error;
	private static $success;

	public static function register($data = array(), $activation_return_link = '')
	{
		if( ! is_array($data)) return false;
		if( ! is_string($activation_return_link)) $activation_return_link = '';
		
		import::language("User");
		
		$username_column  	= config::get("User","username_column");
		$password_column  	= config::get("User","password_column");
		$email_column  	= config::get("User","email_column");
		$table_name 		= config::get("User","table_name");
		$active_column 		= config::get("User","active_column");
		$activation_column 		= config::get("User","activation_column");
		if( ! isset($data[$username_column]) ||  ! isset($data[$password_column]) ) return false;
		
		import::library('Database','Method',"Encode");
		
		$login_username = $data[$username_column];
		$login_password = $data[$password_column];	
		$encode_password = encode::super($login_password);	
		
		db::where($username_column,'=',$login_username);	
		$get = db::get($table_name);
		
		$username_control = $get->total_rows;
		
		if( empty($username_control) )
		{
			$data[$password_column] = $encode_password;
			
			if(db::insert($table_name , $data))
			{
				self::$error = false;
				self::$success = lang('user_register_success');
				if($activation_column)
				{
					if( ! is_email($login_username))
						$email = $data[$email_column];
					else 
						$email = '';
						
					self::_activation($login_username, $encode_password, $activation_return_link, $email);				
				}
				else
					self::login($login_username, $login_password);
					
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
	
	public static function activation_complete()
	{
		import::library('Uri', 'Database');
		import::language("User");
		
		$table_name 		= config::get("User","table_name");
		$username_column  	= config::get("User","username_column");
		$password_column  	= config::get("User","password_column");
		$activation_column 	= config::get("User","activation_column");
		
		if( ! empty(uri::get('user')) && ! empty(uri::get('pass')))	
		{
			db::where($username_column, '=', uri::get('user'));
			db::where($password_column, '=', uri::get('pass'));		
			$get = db::get($table_name);			
			$row = $get->row;		
			if( ! empty($row))
			{
				db::where($username_column, '=', uri::get('user'));
				db::update($table_name, array($activation_column => '1'));
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
	
	private static function _activation($user = "", $pass = "", $activation_return_link = '', $email = '')
	{
		import::library("Email");
		import::language("User");
		
		if( ! is_url($activation_return_link))
			$url = base_url(suffix($activation_return_link));
		else
			$url = suffix($activation_return_link);
		
		$message = "<a href='".$url."user/".$user."/pass/".$pass."'>".lang("user_activation")."</a>";	
		
		$user = ( ! empty($email)) ? $email : $user;
		
		email::open();
		email::receiver($user, $user);
		if(email::send(lang("user_activation_process"), $message))
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
	
	public static function total_active_users()
	{
		$active_column 	= config::get("User","active_column");	
		$table_name 	= config::get("User","table_name");
		if( ! empty($active_column))
		{
			import::library('Database');
			
			db::where($active_column, '=', 1);
			$get = db::get($table_name);
		
			$total_rows = $get->total_rows;
			
			if( $total_rows )
				return $total_rows;
			else
				return false;		
		}
		
		return false;
	}
	
	public static function total_banned_users()
	{
		$banned_column 	= config::get("User","banned_column");	
		$table_name 	= config::get("User","table_name");
		if( ! empty($banned_column))
		{
			import::library('Database');
			
			db::where($banned_column, '=', 1);
			$get = db::get($table_name);
		
			$total_rows = $get->total_rows;
			
			if( ! empty($total_rows))
				return $total_rows;
			else
				return false;		
		}
		
		return false;
	}
	
	public static function total_users()
	{
		$table_name = config::get("User","table_name");
		
		import::library('Database');
		
		db::get($table_name);	
		$get = db::get($table_name);
		
		$total_rows = $get->total_rows;
		
		if( ! empty($total_rows))
			return $total_rows;
		else
			return false;		
	
	}
		
	public static function login($un = "username", $pw = "password", $remember_me = false)
	{
		if( ! is_string($un)) return false;
		if( ! is_string($pw)) return false;
		if( ! (is_bool($remember_me) || is_string($remember_me) || is_numeric($remember_me))) $remember_me = false;
		
		import::language("User");
		import::library('Database','Method','Encode', 'Cookie');
		
		$username = $un;
		$password = encode::super($pw);
		
		$password_column  	= config::get("User","password_column");
		$username_column  	= config::get("User","username_column");
		$email_column  		= config::get("User","email_column");
		$table_name 		= config::get("User","table_name");
		$banned_column 		= config::get("User","banned_column");
		$active_column 		= config::get("User","active_column");
		$activation_column 	= config::get("User","activation_column");
		
		db::where($username_column,'=',$username);
		$get = db::get($table_name);
		$r = $get->row;
		
		
		
		$password_control = $r->$password_column;
		$banned_control = "";
		$activation_control = "";
		
		if( ! empty($banned_column))
		{
			$banned = $banned_column ;
			$banned_control = $r->$banned ;
			
		}
		
		if( ! empty($activation_column))
		{
			$activation_control = $r->$activation_column ;			
		}
		
	
		if( ! empty($r->$username_column) && $password_control == $password)
		{
			if($banned_column && $banned_control)
			{
				self::$error = lang('user_banned_error');	
				return false;
			}
			
			if( $activation_column && ! $activation_control )
			{
				self::$error = lang('user_activation_error');	
				return false;
			}
			
			if( ! isset($_SESSION)) session_start();
			
			$_SESSION[md5($username_column)] = $username; 
			
			if(method::post($remember_me) || $remember_me)
			{
				if(cook::select(md5($username_column)) != $username)
				{					
					cook::insert(md5($username_column),$username);
					cook::insert(md5($password_column),$password);
				}
			}
			
			if( ! empty($active_column))
			{
			
				db::where($username_column, "=", $username);
				db::update($table_name, array($active_column  => 1));
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
	
	public static function forgot_password($email = "", $return_link_path = "")
	{
		if( ! is_string($email)) return false;
		if( ! is_string($return_link_path)) $return_link_path = "";

		import::language("User");
		import::library("Database","Encode","Email");
		
		$username_column  	= config::get("User","username_column");
	
		$password_column  	= config::get("User","password_column");		
		
		$email_column  		= config::get("User","email_column");
			
		$table_name 		= config::get("User","table_name");	
		
		if( ! empty($email_column))
		{
			db::where($email_column ,"=", $email);
		}
		else
		{
			db::where($username_column ,"=", $email);
		}
		
		$get = db::get($table_name); $row = $get->row;
		
		$result = "";
		
		if(isset($row->$username_column)) 
		{
			
			if( ! is_url($return_link_path)) $return_link_path = site_url($return_link_path);
			
			$new_password = encode::create(10);
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
			if(email::send(lang("user_new_your_password"), $message))
			{
				if( ! empty($email_column))
				{
					db::where($email_column ,"=", $email);
				}
				else
				{
					db::where($username_column ,"=", $email);
				}
				db::update($table_name, array($password_column => $encode_password));

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
	
	public static function update($old = '', $new = '', $new_again = '', $data = array())
	{
		if(self::is_login())
		{
			if( ! is_string($old)) return false;
			if( ! is_string($new)) return false;	
			if( ! is_string($new_again)) $new_again = '';
			if( ! is_array($data)) return false;
			
			if(empty($old)) return false;
			if(empty($new)) return false;
			if(empty($data)) return false;
			
			import::library("Database", "Encode");
			import::language("User");
			
			if(empty($new_again)) $new_again = $new;
			
			$pc = config::get("User","password_column");
			$uc = config::get("User","username_column");	
			$tn = config::get("User","table_name");
			
			$old_password = encode::super($old);
			$new_password = encode::super($new);
			$new_password_again = encode::super($new_again);
			
			$username 	  = user::data()->$uc;
			$password 	  = user::data()->$pc;
			$row = "";
					
			if($old_password != $password)
			{
				self::$error = lang("user_old_password_error");
				return false;	
			}
			else if($new_password != $new_password_again)
			{
				self::$error = lang("user_password_not_match_error");
				return false;
			}
			else
			{
				$data[$pc] = $new_password;
				$data[$uc] = $username;
				db::where($uc,"=",$username);
				if(db::update($tn, $data))
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
		else return false;		
	}
	
	public static function is_login()
	{
		import::library('Cookie');
		
		$c_username = cook::select(md5(config::get("User","username_column")));
		$c_password = cook::select(md5(config::get("User","password_column")));
		$result = "";
		if( ! empty($c_username) && ! empty($c_password))
		{
			db::where(config::get("User","username_column"),'=',$c_username);
			db::where(config::get("User","password_column"),'=',$c_password);
			$get = db::get(config::get("User","table_name"));
			$result = $get->total_rows;
		}
		
		$username = config::get("User","username_column");
		
		if(isset(self::data()->$username))
		{
			$is_login = true;
		}
		else if( ! empty($result))
		{
			if( ! isset($_SESSION)) session_start();
			$_SESSION[md5(config::get("User","username_column"))] = $c_username;
			$is_login = true;	
		}
		else
		{
			$is_login = false;	
		}
				
		return $is_login;
	}
	
	public static function data()
	{
		if( ! isset($_SESSION)) session_start();
		
		import::library('Database');
		
		if(isset($_SESSION[md5(config::get("User","username_column"))]))
		{
			$data = array();
			self::$username = $_SESSION[md5(config::get("User","username_column"))];
			db::where(config::get("User","username_column"),'=',self::$username);
			$get = db::get(config::get("User","table_name"));
			$r = $get->row;
			
			return (object)$r;
		}
		else return false;
	}
	
	public static function logout($redirect_url = '', $time = 0)
	{	
		if( ! is_string($redirect_url)) $redirect_url = '';
		if( ! is_numeric($time)) $time = 0;
		
		import::library('Cookie');
		
		$username = config::get("User","username_column");
		
		if(isset(self::data()->$username))
		{
			if( ! isset($_SESSION)) session_start();
			
			if(config::get("User","active_column") != "")
			{	
				db::where(config::get("User","username_column"), "=", self::data()->$username);
				db::update(config::get("User","table_name"), array(config::get("User","active_column") => 0));
			}
			
			cook::delete(md5(config::get("User","username_column")));
			cook::delete(md5(config::get("User","password_column")));	
			
			if(isset($_SESSION[md5(config::get("User","username_column"))])) unset($_SESSION[md5(config::get("User","username_column"))]);
				
			redirect($redirect_url, $time);
		}
		
	}
	
	public static function error()
	{
		if(self::$error) return self::$error; else return false;	
	}
	
	public static function success()
	{
		if(self::$success) return self::$success; else return false;
	}

}