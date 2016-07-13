<?php
namespace ZN\Services;

class InternalSession implements SessionInterface
{
	/***********************************************************************************/
	/* SESSION COMPONENT	   	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Session
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Session:: $this->Session, zn::$use->Session, uselib('Session')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	//----------------------------------------------------------------------------------------------------
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Services:session';
	
	//----------------------------------------------------------------------------------------------------
	// Session Cookie Common
	//----------------------------------------------------------------------------------------------------
	// 
	// ErrorControlTrait
	// CallUndefinedMethodTrait
	//
	// $config
	// $name
	// $value
	// $regenerate
	// $encode
	//
	// name()
	// encode()
	// decode()
	// regenerate()
	// value()
	// defaultVariable()
	//
	//----------------------------------------------------------------------------------------------------
	use SessionTrait;
	
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
		
		\Config::iniSet(\Config::get('Htaccess', 'session')['settings']);
		
		$this->start();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Insert Method Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function insert($name = '', $value = '')
	{
		if( ! empty($name) ) 
		{
			if( ! isChar($name) )
			{
				\Errors::set('Error', 'valueParameter', 'name');
				return false;
			}
			
			$this->name($name);
		}
		
		if( ! empty($value) )
		{
			$this->value($value);	
		}
		
		if( ! empty($this->encode) )
		{
			if( isset($this->encode['name']) )
			{
				if( isHash($this->encode['name']) )
				{
					$this->name = hash($this->encode['name'], $this->name);		
				}		
			}
			
			if( isset($this->encode['value']) )
			{
				if( isHash($this->encode['value']) )
				{
					$this->value = hash($this->encode['value'], $this->value);	
				}
			}
		}
		
		$sessionConfig = $this->config;
	
		if( ! isset($this->encode['name']))
		{
			$encode = $sessionConfig["encode"];
			
			if( $encode === true )
			{
				$this->name = md5($this->name);
			}
			elseif( is_string($encode) )
			{
				if( isHash($encode) )
				{
					$this->name = hash($encode, $this->name);		
				}	
			}
		}
		
		$_SESSION[$this->name] = $this->value;
		
		if( $_SESSION[$this->name] )
		{
			if( $this->regenerate === true )
			{
				session_regenerate_id();	
			}
			
			$this->defaultVariable();
			
			return true;	
		}
		else
		{
			return false;
		}
	} 
	
	//----------------------------------------------------------------------------------------------------
	// Insert Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Select Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	public function select($name = '')
	{
		if( ! is_scalar($name) || empty($name) )
		{
			return \Errors::set('Error', 'valueParameter', 'name');	
		}
		
		if( isset($this->encode['name']) )
		{
			if( isHash($this->encode['name']) )
			{
				$name = hash($this->encode['name'], $name);		
				$this->encode = [];	
			}		
		}
		else
		{
			$encode = $this->config['encode'];
			
			if( $encode === true )
			{
				$name = md5($name);
			}
			elseif( is_string($encode) )
			{
				if( isHash($encode) )
				{
					$name = hash($encode, $name);		
				}	
			}
		}
		
		if( isset($_SESSION[$name]) )
		{
			return $_SESSION[$name];
		}
		else
		{
			return false;	
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
	public function selectAll()
	{
		return $_SESSION;	
	}
	
	/******************************************************************************************
	* START                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Session oturumu başlatmak için kullanılır        .				      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: start();       										              |
	|          																				  |
	******************************************************************************************/
	public function start()
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Select Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Delete Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	public function delete($name = '')
	{
		if( ! is_scalar($name) || empty($name) )
		{
			return \Errors::set('Error', 'valueParameter', 'name');	
		}	
		
		$sessionConfig = $this->config;
		
		if( isset($this->encode['name']) )
		{
			if( isHash($this->encode['name']) )
			{
				$name = hash($this->encode['name'], $name);	
				$this->encode = [];	
			}		
		}
		else
		{
			$encode = $sessionConfig["encode"];
			
			if( $encode === true )
			{
				$name = md5($name);
			}
			elseif( is_string($encode) )
			{
				if( isHash($encode) )
				{
					$name = hash($encode, $name);		
				}	
			}
		}
		
		if( isset($_SESSION[$name]) )
		{ 	
			unset($_SESSION[$name]);
		}
		else
		{ 
			return false;		
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
	public function deleteAll()
	{
		session_destroy();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}