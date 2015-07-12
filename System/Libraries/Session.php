<?php
Config::iniSet(Config::get('Session','settings'));
if( ! isset($_SESSION) ) session_start();
class Session
{
	/***********************************************************************************/
	/* SESSION LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Session
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: session::, $this->session, zn::$use->session, uselib('session')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* INSERT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Oturum oluşturmak için kullanılır.								      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Oluşturulacak oturumun adı.		    					      |
	| 2. mixed var @value => Oluşturulacak oturumun tutacağı değer.         			      |
	|          																				  |
	| Örnek Kullanım: insert('isim', 'Değer');       										  |
	| Not: Application/Config/Session.php dosyası üzerinden ayarlarını yapılandırabilirsiniz. |
	|          																				  |
	******************************************************************************************/
	public static function insert($name = '', $values = '')
	{
		if( empty($name) ) 
		{
			return false;
		}
		
		$sessConfig = Config::get('Session');
		
		if( is_array($name) )
		{
			foreach($name as $key => $value)
			{
				if( isHash($sessConfig['encode']) )
				{
					$_SESSION[hash($sessConfig['encode'], $key)] = $value;
				}
				else
				{
					$_SESSION[$key] = $value;
				}
			}
		}
		else
		{
			if( isHash($sessConfig['encode']) )
			{
				$_SESSION[hash($sessConfig['encode'], $name)] = $values;
			}
			else
			{
				$_SESSION[$name] = $values;
			}
		}
		
		if( $sessConfig['regenerate'] === true )
		{
			session_regenerate_id();
		}
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulan oturumu seçmek için kullanılır.							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Seçilecek oturumun ismi.		    					          |
	|          																				  |
	| Örnek Kullanım: select('isim');       										          |
	|          																				  |
	******************************************************************************************/
	public static function select($name = '')
	{
		if( empty($name) ) 
		{
			return false;
		}
		
		$sessConfig = Config::get('Session','encode');
		
		if( is_array($name) )
		{
			foreach($name as $key)
			{
				if( isHash($sessConfig) )
				{
					$session[$key] = $_SESSION[hash($sessConfig, $key)];
				}
				else
				{
					$session[$key] = $_SESSION[$key];
				}
			}
			return $session;
		}
		else
		{
			if( isHash($sessConfig) )
			{
				if( isset($_SESSION[hash($sessConfig, $name)]) ) 
				{
					return $_SESSION[hash($sessConfig, $name)]; 
				}
				else 
				{
					return false;
				}
			}
			else
			{
				if( isset($_SESSION[$name]) )
				{
					return $_SESSION[$name]; 
				}
				else 
				{
					return false;
				}
			}
		}
		
	}
	
	/******************************************************************************************
	* SELECT ALL                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulmuş tüm oturumlara erişmek için kullanılır.				      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: selectAll();       										              |
	|          																				  |
	******************************************************************************************/
	public static function selectAll()
	{
		return $_SESSION;	
	}

	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulan oturumu silmek için kullanılır.							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Silinecek oturumun ismi.		    					          |
	|          																				  |
	| Örnek Kullanım: delete('isim');       										          |
	|          																				  |
	******************************************************************************************/
	public static function delete($name = '')
	{
		if( empty($name) ) 
		{
			return false;
		}
		
		$sessConfig = Config::get('Session','encode');
		
		if( is_array($name) )
		{
			foreach($name as $value)
			{
				$val = $value;
				
				if( isHash($sessConfig) )
				{
					if( isset($_SESSION[hash($sessConfig, $val)]) ) 
					{
						unset($_SESSION[hash($sessConfig, $val)]);
					}
				}
				else
				{
					if( isset($_SESSION[$val]) )
					{
						unset($_SESSION[$val]);
					}
				}
			}	
		}
		else
		{
			$val = $name;
		}
		if( isHash($sessConfig) )
		{
			if( isset($_SESSION[hash($sessConfig, $val)]) )
			{
				unset($_SESSION[hash($sessConfig, $val)]);
			}
		}
		else
		{
			if( isset($_SESSION[$val]) )
			{
				unset($_SESSION[$val]);
			}
		}
	}
	
	/******************************************************************************************
	* DELETE ALL                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulmuş tüm oturumları silmek için kullanılır.				      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: deleteAll();       										              |
	|          																				  |
	******************************************************************************************/
	public static function deleteAll()
	{
		session_destroy();
	}
}