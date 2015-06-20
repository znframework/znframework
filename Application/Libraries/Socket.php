<?php
/************************************************************/
/*                    LIBRARY SOCKET                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SOCKET                                                                             	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	Socket::, $this->socket, zn::$use->socket, uselib('Socket')   |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Socket
{	
	/* Socket Create Değişkeni
	 *  
	 * Soket oluşturma bilgisini tutuması
	 * için oluşturulmuştur.
	 *
	 */
	protected static $socketCreate;
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Soket oluşturmak içindir.												  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @domain => Soket tarafından kullanılacak protokol ailesi.				  |
	| 1.1 AF_INET         																	  |
	| 1.2 AF_INET6        																	  |
	| 1.3 AF_UNIX	  																	      |
	| 2. numeric var @type => Soket tarafından kullanılacak iletişim türü.				      |
	| 2.1 SOCK_STREAM 																		  |
	| 2.3 SOCK_SEQPACKET     																  |
	| 2.4 SOCK_RAW 						      												  |
	| 2.5 SOCK_RDM         																	  |
	| 3. numeric var @protocol => Soketten dönen iletişimi kullanacak aileye özgü protokol.   |
	| 3.1 SOL_TCP          																	  |
	| 3.2 SOL_UDP         																	  |
	| 3.3 Farklı Bir Protokol        														  |
	|          																				  |
	| Örnek Kullanım: Socket::create(AF_INET, SOCK_RAW, 1)         							  |
	|          																				  |
	******************************************************************************************/
	public static function create($domain = 0, $type = 0, $protocol = 0)
	{
		if( ! is_numeric($domain) || ! is_numeric($type) || ! is_numeric($protocol) )
		{
			return false;	
		}
		
		self::$socketCreate = socket_create($domain, $type, $protocol);
		
		return self::$socketCreate;
	}	
	
	public static function connect($address = '', $port = 0)
	{
		if( ! is_string($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_connect(self::$socketCreate, $address, $port);
	}

	public static function write($buffer = '', $length = 0)
	{
		if( ! is_string($buffer) || ! is_numeric($length) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_write(self::$socketCreate, $buffer, $length);
	}
	
	public static function read($length = 0, $type = PHP_BINARY_READ)
	{
		if( ! is_numeric($type) || ! is_numeric($length) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_read(self::$socketCreate, $length, $type);
	}
	
	public static function bind($address = '', $port = 0)
	{
		if( ! is_string($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_bind(self::$socketCreate, $address, $port);	
	}
	
	public static function listen($backlog = 0)
	{
		if( ! is_numeric($backlog) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_listen(self::$socketCreate, $backlog);	
	}

	
	public static function error()
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_strerror(self::errno());
	}
	
	public static function errno()
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_last_error(self::$socketCreate);
	}
	
	public static function clearError()
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_clear_error(self::$socketCreate);
	}
	
	public static function createListen($port = 0, $backlog = 128)
	{
		if( ! is_numeric($port) || ! is_numeric($backlog) )
		{
			return false;
		}
		
		return socket_create_listen($port, $backlog);
	}
	
	public static function getOption($level = 0, $optName = 0)
	{
		if( ! is_numeric($level) || ! is_numeric($optName) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_get_option(self::$socketCreate, $level, $optName);
	}	
	
	public static function setOption($level = 0, $optName = 0, $optValue = 0)
	{
		if( ! is_numeric($level) || ! is_numeric($optName) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_set_option(self::$socketCreate, $level, $optName, $optValue);
	}
	
	public static function getPeerName($address = '', $port = 0)
	{
		if( ! is_string($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		$name = socket_getpeername(self::$socketCreate, $address, $port);
		
		return array
		(
			'address'  => $address,
			'port'	   => $port,
			'peerName' => $name
		);
	}
	
	public static function getSocketName($address = '', $port = 0)
	{
		if( ! is_string($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		$name = socket_getsockname(self::$socketCreate, $address, $port);
		
		return array
		(
			'address' 	 => $address,
			'port'	  	 => $port,
			'socketName' => $name
		);
	}
	
	public static function receives($buffer = '', $length = 0, $flags = 0)
	{
		if( ! is_string($buffer) || ! is_numeric($length) || ! is_numeric($flags) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		$receives = socket_recv(self::$socketCreate, $buffer, $length, $flags);
		
		return array
		(
			'receives' => $receives,
			'buffer'   => $buffer
		);
	}
	
	public static function receivesFrom($buffer = '', $length = 0, $flags = 0, $name = '', $port = 0)
	{
		if( ! is_string($buffer) || ! is_numeric($length) || ! is_numeric($flags) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		$receives = socket_recvfrom(self::$socketCreate, $buffer, $length, $flags, $name, $port);
		
		return array
		(
			'receives' => $receives,
			'buffer'   => $buffer,
			'name'	   => $name,
			'port'	   => $port
		);
	}
	
	public static function select($read = array(), $write = array(), $except = array(), $secondTimeout = 0, $microSecondTimeout = 0)
	{
		if( ! is_array($read) || ! is_array($write) || ! is_array($except) )
		{
			return false;
		}
		
		$select = socket_select($read, $write, $except, $secondTimeout, $microSecondTimeout);
		
		return array
		(
			'select' => $receives,
			'read'   => $read,
			'write'	 => $write,
			'except' => $except
		);
	}
	
	public static function send($buffer = '', $length = 0, $flags = 0)
	{
		if( ! is_resource(self::$socketCreate) || ! is_string($buffer) || ! is_numeric($length) || ! is_numeric($flags) )
		{
			return false;
		}
		
		return socket_send(self::$socketCreate, $buffer, $length, $flags);	
	}
	
	public static function sendTo($buffer = '', $length = 0, $flags = 0, $address = '', $port = 0)
	{
		if( ! is_resource(self::$socketCreate) || ! is_string($buffer) || ! is_numeric($length) || ! is_numeric($flags) || ! is_string($address) )
		{
			return false;
		}
		
		return socket_sendto(self::$socketCreate, $buffer, $length, $flags, $address, $port);	
	}
	
	public static function setBlock()
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_set_block(self::$socketCreate);	
	}
	
	public static function setNonBlock()
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_set_nonblock(self::$socketCreate);	
	}
	
	public static function accept()
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		return socket_accept(self::$socketCreate);	
	}
	
	public static function close()
	{
		if( ! isset(self::$socketCreate) )
		{
			return false;
		}
		
		$close = socket_close(self::$socketCreate);
			
		self::$socketCreate = NULL;
		
		return $close;	
	}
	
	public static function shutDown($how = 2)
	{
		if( ! isset(self::$socketCreate) || ! is_numeric($how) )
		{
			return false;
		}
		
		return socket_shutdown(self::$socketCreate, $how);
	}
}