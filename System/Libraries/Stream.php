<?php
/************************************************************/
/*                    LIBRARY STREAM                        */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* STREAM                                                                             	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	Stream::, $this->Stream, zn::$use->Stream, uselib('Stream')   |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Stream
{	
	/******************************************************************************************
	* CREATE                                                                          	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function create($options = array(), $params = array())
	{
		if( ! is_array($options) || ! is_array($params) )
		{
			return false;	
		}
		
		return stream_context_create($options, $params);
	}
	
	/******************************************************************************************
	* GET DEFAULT                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getDefault($options = array())
	{
		if( ! is_array($options) )
		{
			return false;	
		}
		
		return stream_context_get_default($options);
	}
	
	/******************************************************************************************
	* SET DEFAULT                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setDefault($options = array())
	{
		if( ! is_array($options) )
		{
			return false;	
		}
		
		return stream_context_set_default($options);
	}
	
	/******************************************************************************************
	* GET OPTIONS                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getOptions($stream = NULL)
	{
		if( ! is_resource($stream) )
		{
			return $stream;	
		}
		
		return stream_context_get_options($stream);
	}
	
	/******************************************************************************************
	* SET OPTIONS                                                                      	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setOptions($stream = '', $wrapper = '', $options = '')
	{
		if( ! is_resource($stream) )
		{
			return $stream;	
		}
		
		return stream_context_set_options($stream, $wrapper, $options);
	}
	
	/******************************************************************************************
	* GET PARAMETERS                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getParams($stream = '')
	{
		if( ! is_resource($stream) )
		{
			return $stream;	
		}
		
		return stream_context_get_params($stream);
	}
	
	/******************************************************************************************
	* SET PARAMETERS                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setParams($stream = '', $params = array())
	{
		if( ! is_array($params) || ! is_resource($stream) )
		{
			return false;	
		}
		
		return stream_context_set_params($stream, $params);
	}
	
	/******************************************************************************************
	* COPY TO STREAM                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function copyTo($source = '', $target = '', $length = -1, $start = 0)
	{
		if
		( 
			! is_resource($params) || 
			! is_resource($target) || 
			! is_numeric($length) || 
			! is_numeric($start) 
		)
		{
			return false;	
		}
		
		return stream_copy_to_stream($source, $target, $length, $start);
	}
	
	/******************************************************************************************
	* FILTER APPEND                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function filterAppend($stream = '', $filter = '', $writeRead = 0, $params = array())
	{
		if
		( 
			! is_numeric($writeRead) || 
			! is_string($filter) || 
			! is_resource($stream) 
		)
		{
			return false;	
		}
		
		return stream_filter_append($stream, $filter, $writeRead, $params);
	}
	
	/******************************************************************************************
	* FILTER PREPEND                                                                          *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function filterPrepend($stream = '', $filter = '', $writeRead = 0, $params = array())
	{
		if
		( 
			! is_numeric($writeRead) || 
			! is_string($filter) || 
			! is_resource($stream) 
		)
		{
			return false;	
		}
		
		return stream_filter_prepend($stream, $filter, $writeRead, $params);
	}
	
	/******************************************************************************************
	* FILTER REGISTER                                                                 	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function filterRegister($filter = '', $class = '')
	{
		if( ! is_string($class) || ! is_string($filter) )
		{
			return false;	
		}
		
		return stream_filter_register($filter, $class);
	}
	
	/******************************************************************************************
	* FILTER REMOVE                                                                  	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function filterRemove($filter = '')
	{
		if( ! is_resource($filter) )
		{
			return false;	
		}
		
		return stream_filter_remove($filter);
	}
	
	/******************************************************************************************
	* GET CONTENTS                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getContents($stream = '', $length = -1, $start = 0)
	{
		if
		( 
			! is_numeric($length) || 
			! is_numeric($start) || 
			! is_resource($stream) 
		)
		{
			return false;	
		}
		
		return stream_get_contents($stream, $length, $start);
	}
	
	/******************************************************************************************
	* GET FILTERS                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getFilters()
	{
		return stream_get_filters();
	}
	
	/******************************************************************************************
	* GET LINE                                                                        	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getLine($stream = '', $length = -1, $eol = '')
	{
		if
		( 
			! is_numeric($length) || 
			! is_string($eol) || 
			! is_resource($stream) 
		)
		{
			return false;	
		}
		
		return stream_get_line($stream, $length, $eol);
	}
	
	/******************************************************************************************
	* GET META DATA                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getMetaData($stream = '')
	{
		if( ! is_resource($stream) )
		{
			return false;	
		}
		
		return stream_get_meta_data($stream);
	}
	
	/******************************************************************************************
	* GET TRANSPORTS                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getTransports()
	{
		return stream_get_transports();
	}
	
	/******************************************************************************************
	* GET WRAPPERS                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function getWrappers()
	{
		return stream_get_wrappers();
	}
	
	/******************************************************************************************
	* IS LOCAL                                                                       	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function isLocal($stream = '')
	{
		return stream_is_local($stream);
	}
	
	/******************************************************************************************
	* NOTIFICATION CALLBACK                                                            	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function notificationCallback($notificationCode = 0, $severity = 0, $message = '', $messageCode = 0, $bytesTransferred = 0, $bytesMax = 0)
	{
		if
		( 
			! is_numeric($notificationCode) || 
			! is_string($message) || 
			! is_numeric($severity) ||
			! is_numeric($messageCode) ||
			! is_numeric($bytesTransferred) ||
			! is_numeric($bytesMax)
		)
		{
			return false;	
		}
		
		return stream_notification_callback($notificationCode, $severity, $message, $messageCode, $bytesTransferred, $bytesMax);
	}
	
	/******************************************************************************************
	* WRAPPER REGISTER                                                                 	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function wrapperRegister($protocol = '', $class = '', $options = 0)
	{
		if
		( 
			! is_string($protocol) || 
			! is_string($class) || 
			! is_numeric($options)
		)
		{
			return false;	
		}
		
		return stream_wrapper_register($protocol, $class, $options);
	}
	
	/******************************************************************************************
	* WRAPPER RESTORE                                                                  	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function wrapperRestore($protocol = '')
	{
		if( ! is_string($protocol) )
		{
			return false;	
		}
		
		return stream_wrapper_restore($protocol);
	}
	
	/******************************************************************************************
	* WRAPPER UNREGISTER                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function wrapperUnregister($protocol = '')
	{
		if( ! is_string($protocol) )
		{
			return false;	
		}
		
		return stream_wrapper_unregister($protocol);
	}
	
	/******************************************************************************************
	* SELECT                                                                          	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function select($read = array(), $write = array(), $except = array(), $secondTimeout = 0, $microSecondTimeout = 0)
	{
		if
		( 
			! is_array($read) || 
			! is_array($write) || 
			! is_array($except) ||
			! is_numeric($secondTimeout) ||
			! is_numeric($microSecondTimeout)
		)
		{
			return false;	
		}
		
		$return = stream_select($read, $write, $except, $secondTimeout, $microSecondTimeout);
	}
	
	/******************************************************************************************
	* SET BLOCK                                                                      	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setBlock($stream = '', $mode = 0)
	{
		if( ! is_numeric($mode) || ! is_resource($stream) )
		{
			return false;	
		}
		
		return stream_set_blocking($stream, $mode);
	}
	
	/******************************************************************************************
	* SET CHUNK SIZE                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setChunkSize($fileOpen = '', $size = 0)
	{
		if( ! is_numeric($size) || ! is_resource($fileOpen) )
		{
			return false;	
		}
		
		return stream_set_chunk_size($fileOpen, $size);
	}
	
	/******************************************************************************************
	* SET READ BUFFER                                                                  	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setReadBuffer($stream = '', $buffer = 0)
	{
		if( ! is_numeric($buffer) || ! is_resource($stream) )
		{
			return false;	
		}
		
		return stream_set_read_buffer($stream, $buffer);
	}
	
	/******************************************************************************************
	* SET TIMEOUT                                                                     	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setTimeout($stream = '', $secondTimeout = 0, $microSecondTimeout = 0)
	{
		if
		( 
			! is_resource($stream) || 
			! is_numeric($secondTimeout) ||
			! is_numeric($microSecondTimeout)
		)
		{
			return false;	
		}
		
		return stream_set_timeout($stream, $secondTimeout, $microSecondTimeout);
	}
	
	/******************************************************************************************
	* SET WRITE BUFFER                                                                 	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function setWriteBuffer($stream = '', $buffer = 0)
	{
		if( ! is_numeric($buffer) || ! is_resource($stream) )
		{
			return false;	
		}
		
		return stream_set_write_buffer($stream, $buffer);
	}
	
	/******************************************************************************************
	* SOCKET ACCEPT                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketAccept($socket = '', $timeout = 0, $peerName = '')
	{
		if
		( 
			! is_numeric($timeout) || 
			! is_string($peerName) || 
			! is_resource($socket) 
		)
		{
			return false;	
		}
		
		if( $timeout === 0 )
		{
			$timeout = ini_get('default_socket_timeout');
		}
		
		return stream_socket_accept($socket, $timetout, $peerName);
	}
	
	/******************************************************************************************
	* SOCKET CLIENT                                                                   	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketClient($socket = '', $errno = 0, $errstr = '', $timeout = 0, $flags = STREAM_CLIENT_CONNECT, $context = NULL)
	{
		if
		( 
			! is_resource($socket) || 
			! is_numeric($errno) || 
			! is_string($errstr) ||
			! is_numeric($timeout) ||
			! is_numeric($flags)
		)
		{
			return false;	
		}
		
		if( $timeout === 0 )
		{
			$timeout = ini_get('default_socket_timeout');
		}
		
		return stream_socket_client($socket, $errno, $errstr, $timeout, $flags, $context);
	}
	
	/******************************************************************************************
	* SOCKET ENABLE ENCODE                                                             	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketEnableEncode($stream = '', $enable = true, $encodeType = STREAM_CRYPTO_METHOD_TLS_CLIENT)
	{
		if
		( 
			! is_resource($stream) || 
			! is_bool($enable) || 
			! is_numeric($encodeType)
		)
		{
			return false;	
		}
		
		return stream_socket_enable_crypto($stream, $enable, $encodeType);
	}
	
	/******************************************************************************************
	* SOCKET GET NAME                                                                         *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketGetName($socket = '', $wantPeer = true)
	{
		if( ! is_resource($socket) || ! is_bool($wantPeer) )
		{
			return false;	
		}
		
		return stream_socket_get_name($socket, $wantPeer);
	}
	
	/******************************************************************************************
	* SOCKET PAIR                                                                      	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketPair($domain = 0, $type = 0, $protocol = 0)
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
		
		return stream_socket_pair($domain, $type, $protocol);
	}
	
	/******************************************************************************************
	* SOCKET RECEIVE FROM                                                              	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketReceiveFrom($socket = NULL, $length = 0, $options = 0, $address = '')
	{
		if
		( 
			! is_resource($socket) || 
			! is_numeric($length) || 
			! is_numeric($options) || 
			! is_string($address) 
		)
		{
			return false;
		}

		return socket_recvfrom($socket, $length, $options, $address);
	}
	
	/******************************************************************************************
	* SOCKET SEND TO                                                                  	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketSendTo($socket = NULL, $data = '', $options = 0, $address = '')
	{
		if
		( 
			! is_resource($socket) || 
			! is_string($data) || 
			! is_numeric($options) || 
			! is_string($address) 
		)
		{
			return false;
		}

		return stream_socket_sendto($socket, $data, $options, $address);
	}
	
	/******************************************************************************************
	* SOCKET SERVER                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketServer($socket = '', $errno = 0, $errstr = '', $flags = STREAM_SERVER_LISTEN, $context = NULL)
	{
		if
		( 
			! is_resource($socket) || 
			! is_numeric($errno) || 
			! is_string($errstr) ||
			! is_numeric($flags)
		)
		{
			return false;	
		}
		
	
		return stream_socket_server($socket, $errno, $errstr, $flags, $context);
	}
	
	/******************************************************************************************
	* SOCKET SHUT DOWN                                                                 	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function socketShutDown($stream = '', $how = 0)
	{
		if( ! is_resource($stream) || ! is_numeric($how) )
		{
			return false;	
		}	
	
		return stream_socket_shutdown($stream, $how);
	}
	
	/******************************************************************************************
	* SUPPORTS LOCK                                                                    	  	  *
	*******************************************************************************************
	| Genel Kullanımı :	Detaylı kullanım için STREAM ile ilgili kaynakları inceleyiniz.       |
	******************************************************************************************/
	public static function supportsLock($stream = '')
	{
		if( ! is_resource($stream) )
		{
			return false;	
		}
		
		return stream_supports_lock($stream);
	}
}