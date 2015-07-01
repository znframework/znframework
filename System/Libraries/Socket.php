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
	/******************************************************************************************
	* CREATE                                                                          	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function create($domain = 0, $type = 0, $protocol = 0)
	{
		if
		( 
			! is_numeric($domain) || 
			! is_numeric($type) || 
			! is_numeric($protocol) 
		)
		{
			return false;	
		}
		
		return socket_create($domain, $type, $protocol);
	}	
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function connect($socket = NULL, $address = '', $port = 0)
	{
		if
		( 
			! isValue($address) || 
			! is_numeric($port) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		return @socket_connect($socket, $address, $port);
	}
	
	/******************************************************************************************
	* WRITE                                                                                   *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function write($socket = NULL, $data = '', $length = 0)
	{
		if
		( 
			! isValue($data) || 
			! is_numeric($length) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		if( empty($length) )
		{
			$length = strlen($data);	
		}
		
		return socket_write($socket, $data, $length);
	}
	
	/******************************************************************************************
	* READ                                                                                    *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function read($socket = NULL, $length = 0, $type = PHP_BINARY_READ)
	{
		if
		( 
			! is_numeric($type) || 
			! isValue($length) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		if( empty($type) )
		{
			$type = PHP_BINARY_READ;	
		}
		
		return socket_read($socket, $length, $type);
	}
	
	/******************************************************************************************
	* BIND                                                                                    *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function bind($socket = NULL, $address = '', $port = 0)
	{
		if
		( 
			! isValue($address) || 
			! is_numeric($port) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		return socket_bind($socket, $address, $port);	
	}
	
	/******************************************************************************************
	* LISTEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function listen($socket = NULL, $backlog = 0)
	{
		if( ! is_numeric($backlog) || ! is_resource($socket) )
		{
			return false;
		}
	
		return socket_listen($socket, $backlog);	
	}
	
	/******************************************************************************************
	* CREATE LISTEN                                                                           *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function createListen($port = 0, $backlog = 128)
	{
		if( ! is_numeric($port) || ! is_numeric($backlog) )
		{
			return false;
		}
		
		return socket_create_listen($port, $backlog);
	}
		
	/******************************************************************************************
	* GET OPTION                                                                              *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getOption($socket = NULL, $level = 0, $optName = 0)
	{
		if
		( 
			! is_numeric($level) || 
			! is_numeric($optName) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		return socket_get_option($socket, $level, $optName);
	}
	
	/******************************************************************************************
	* SET OPTION                                                                              *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setOption($socket = NULL, $level = 0, $optName = 0, $optValue = 0)
	{
		if
		( 
			! is_numeric($level) || 
			! is_numeric($optName) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		return socket_set_option($socket, $level, $optName, $optValue);
	}
	
	/******************************************************************************************
	* GET PEER NAME                                                                           *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getPeerName($socket = NULL, $address = '', $port = 0)
	{
		if
		( 
			! isValue($address) || 
			! is_numeric($port) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		return socket_getpeername($socket, $address, $port);
	}
	
	/******************************************************************************************
	* GET SOCKET NAME                                                                         *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getName($socket = NULL, $address = '', $port = 0)
	{
		if
		( 
			! isValue($address) || 
			! is_numeric($port) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		return socket_getsockname($socket, $address, $port);
	}
	
	/******************************************************************************************
	* RECEIVE                                                                                 *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function receive($socket = NULL, $buffer = '', $length = 0, $options = 0)
	{
		if
		( 
			! isValue($buffer) || 
			! is_numeric($length) || 
			! is_numeric($options) || 
			! is_resource($socket) 
		)
		{
			return false;
		}
		
		return socket_recv($socket, $buffer, $length, $options);
	}
	
	/******************************************************************************************
	* RECEIVE FROM                                                                            *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function receiveFrom($socket = NULL, $buffer = '', $length = 0, $options = 0, $name = '', $port = 0)
	{
		if
		( 
			! isValue($buffer) || 
			! is_numeric($length) || 
			! is_numeric($options) || 
			! is_resource($socket) 
		)
		{
			return false;
		}

		return socket_recvfrom($socket, $buffer, $length, $options, $name, $port);
	}
	
	/******************************************************************************************
	* SELECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function select($read = array(), $write = array(), $except = array(), $secondTimeout = 0, $microSecondTimeout = 0)
	{
		if
		( 
			! is_array($read) || 
			! is_array($write) || 
			! is_array($except) 
		)
		{
			return false;
		}
		
		return socket_select($read, $write, $except, $secondTimeout, $microSecondTimeout);
	}
	
	/******************************************************************************************
	* SEND                                                                                    *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function send($socket = NULL, $buffer = '', $length = 0, $options = 0)
	{
		if
		( 
			! is_resource($socket) || 
			! isValue($buffer) || 
			! is_numeric($length) || 
			! is_numeric($options) 
		)
		{
			return false;
		}
		
		return socket_send($socket, $buffer, $length, $options);	
	}
	
	/******************************************************************************************
	* SEND TO                                                                                 *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function sendTo($socket = NULL, $buffer = '', $length = 0, $options = 0, $address = '', $port = 0)
	{
		if
		( 
			! is_resource($socket) || 
			! isValue($buffer) || 
			! is_numeric($length) || 
			! is_numeric($options) || 
			! isValue($address) 
		)
		{
			return false;
		}
		
		return socket_sendto($socket, $buffer, $length, $options, $address, $port);	
	}
	
	/******************************************************************************************
	* SET BLOCK                                                                               *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setBlock($socket = NULL)
	{
		if( ! is_resource($socket) )
		{
			return false;
		}
		
		return socket_set_block($socket);	
	}
	
	/******************************************************************************************
	* SET NON BLOCK                                                                           *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setNonBlock($socket = NULL)
	{
		if( ! is_resource($socket) )
		{
			return false;
		}
		
		return socket_set_nonblock($socket);	
	}
	
	/******************************************************************************************
	* ACCEPT	                                                                              *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function accept($socket = NULL)
	{
		if( ! is_resource($socket) )
		{
			return false;
		}
		
		return socket_accept($socket);	
	}
	
	/******************************************************************************************
	* ERROR  	                                                                              *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function error($socket = NULL)
	{
		if( ! is_resource($socket) )
		{
			return false;
		}
		
		return socket_strerror(self::errno($socket));
	}
	
	/******************************************************************************************
	* ERRNO 	                                                                              *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function errno($socket = NULL)
	{
		if( ! is_resource($socket) )
		{
			return false;
		}
		
		return socket_last_error($socket);
	}
	
	/******************************************************************************************
	* CLEAR ERROR                                                                             *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function clearError($socket = NULL)
	{
		if( ! is_resource($socket) )
		{
			return false;
		}
		
		return socket_clear_error($socket);
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function close($socket = NULL)
	{
		if( ! is_resource($socket) )
		{
			return false;
		}
		
		return socket_close($socket);	
	}
	
	/******************************************************************************************
	* SHUT DOWN                                                                               *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için SOCKET ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function shutDown($socket = NULL, $how = 2)
	{
		if( ! is_resource($socket) || ! is_numeric($how) )
		{
			return false;
		}
		
		return socket_shutdown($socket, $how);
	}
}