<?php
/************************************************************/
/*                       CLASS SESSION                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* Config/Session.php dosyasından Ini ayarlarını yapılandır.                               *
******************************************************************************************/
config::iniSet(config::get('Session','settings'));
/******************************************************************************************
* Herhangi bir oturum başlatılmamışsa oturumu başlat.                                     *
******************************************************************************************/
if( ! isset($_SESSION) ) session_start();
/******************************************************************************************
* SESSION                                                                            	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	session:: , $this->session , uselib('session')			      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class Session
{

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
		
		$sess_config = config::get('Session');
		
		if( is_array($name) )
		{
			foreach($name as $key => $value)
			{
				if( isHash($sess_config['encode']) )
				{
					$_SESSION[hash($sess_config['encode'], $key)] = $value;
				}
				else
				{
					$_SESSION[$key] = $value;
				}
			}
		}
		else
		{
			if( isHash($sess_config['encode']) )
			{
				$_SESSION[hash($sess_config['encode'], $name)] = $values;
			}
			else
			{
				$_SESSION[$name] = $values;
			}
		}
		
		if( $sess_config['regenerate'] === true )
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
		
		$sess_config = config::get('Session','encode');
		
		if( is_array($name) )
		{
			foreach($name as $key)
			{
				if( isHash($sess_config) )
				{
					$session[$key] = $_SESSION[hash($sess_config, $key)];
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
			if( isHash($sess_config) )
			{
				if( isset($_SESSION[hash($sess_config, $name)]) ) 
				{
					return $_SESSION[hash($sess_config, $name)]; 
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
		
		$sess_config = config::get('Session','encode');
		
		if( is_array($name) )
		{
			foreach($name as $value)
			{
				$val = $value;
				
				if( isHash($sess_config) )
				{
					if( isset($_SESSION[hash($sess_config, $val)]) ) 
					{
						unset($_SESSION[hash($sess_config, $val)]);
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
		if( isHash($sess_config) )
		{
			if( isset($_SESSION[hash($sess_config, $val)]) )
			{
				unset($_SESSION[hash($sess_config, $val)]);
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