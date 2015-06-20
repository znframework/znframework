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
	| 	1.1 AF_INET         																  |
	| 	1.2 AF_INET6        																  |
	| 	1.3 AF_UNIX	  																	      |
	| 2. numeric var @type => Soket tarafından kullanılacak iletişim türü.				      |
	| 	2.1 SOCK_STREAM 																	  |
	| 	2.3 SOCK_SEQPACKET     																  |
	| 	2.4 SOCK_RAW 						      										      |
	| 	2.5 SOCK_RDM         																  |
	| 3. numeric var @protocol => Soketten dönen iletişimi kullanacak aileye özgü protokol.   |
	| 	3.1 SOL_TCP          																  |
	| 	3.2 SOL_UDP         																  |
	| 	3.3 Farklı Bir Protokol        														  |
	|          																				  |
	| Örnek Kullanım: Socket::create(AF_INET, SOCK_RAW, 1)         							  |
	|          																				  |
	******************************************************************************************/
	public static function create($domain = 0, $type = 0, $protocol = 0)
	{
		self::$socketCreate = self::differentCreate($domain, $type, $protocol);
		
		return self::$socketCreate;
	}
	
	/******************************************************************************************
	* DIFFERENT CREATE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Farklı bir soket oluşturmak içindir.									  |
	|          																				  |
	******************************************************************************************/
	public static function differentCreate($domain = 0, $type = 0, $protocol = 0)
	{
		if( ! is_numeric($domain) || ! is_numeric($type) || ! is_numeric($protocol) )
		{
			return false;	
		}
		
		return socket_create($domain, $type, $protocol);
	}	
	
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Soket üzerinde bir bağlantıyı ilişkilendirir.							  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @address => Soket, AF_INET türündeyse noktalı dördül gösterimle           |
	| (127.0.0.1 gibi) geçerli bir IPv4 adresi, AF_INET6 türündeyse ve IPv6 desteği varsa     |
	| geçerli bir IPv6 adresi (::1 gibi) ya da AF_UNIX türündeyse Unix ailesinden bir soketin | 
	| dosya yolu (/var/run/daemon.sock gibi) olmalıdır.										  |
	| 2. numeric var @port => Bu değiştirge sadece ve zorunlu olarak bir AF_INET veya AF_INET6|
	| sokete bağlanırken gerekir ve bağlantının yapılacağı uzak konak üzerinde bir port       |
	| belirtir.          																	  |
	| 3. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::connect($_SERVER['REMOTE_ADDR'], $_REQUEST['port'])         	  |
	|          																				  |
	******************************************************************************************/
	public static function connect($address = '', $port = 0, $socket = NULL)
	{
		if( ! isValue($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{		
			$socket = self::$socketCreate;	
		}
		
		return @socket_connect($socket, $address, $port);
	}
	
	/******************************************************************************************
	* WRITE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Bir sokete yazar.							  							  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @data => Sokete yazılacak veri.           							      |
	| 2. numeric var @lenght => Belirtilmesi isteğe bağlı olup, sokete yazılacak bayt sayısını|
	| belirler. Tampon uzunluğundan büyükse tampon uzunluğundan fazlası yok sayılır.          |
	| 3. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::write('data', 3) // dat        	  							  |
	|          																				  |
	******************************************************************************************/
	public static function write($data = '', $length = 0, $socket = NULL)
	{
		if( ! isValue($data) || ! is_numeric($length) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( empty($length) )
		{
			$length = strlen($data);	
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_write($socket, $data, $length);
	}
	
	/******************************************************************************************
	* READ                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Bir soketten belli sayıda bayta kadar okuma yapar.					  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @length => Okunacak azami bayt sayısını belirler. Belirtilmediği takdirde|
	| okumayı bitirmek için tür değiştirgesine bağlı olarak \r, \n veya \0 kullanabilirsiniz. |
	| 2. numeric var @type => Belirtilmesi isteğe bağlı olup şu sabitlerden biri olabilir:    |
	| 	2.1 PHP_BINARY_READ 																  |
	| 	2.1 PHP_NORMAL_READ 																  |
	| 3. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::read(3) // dat        	  							  		  |
	|          																				  |
	******************************************************************************************/
	public static function read($length = 0, $type = PHP_BINARY_READ, $socket = NULL)
	{
		if( ! is_numeric($type) || ! isValue($length) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( empty($type) )
		{
			$type = PHP_BINARY_READ;	
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_read($socket, $length, $type);
	}
	
	/******************************************************************************************
	* BIND                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Soketi bir isimle ilişkilendirir.					  				      |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @address => Soket, AF_INET türündeyse noktalı dördül gösterimle           |
	| (127.0.0.1 gibi) geçerli bir IPv4 adresi, AF_INET6 türündeyse ve IPv6 desteği varsa     |
	| geçerli bir IPv6 adresi (::1 gibi) olmalıdır.          							      |
	| 2. numeric var @port => Bu değiştirge sadece ve zorunlu olarak bir AF_INET veya AF_INET6|
	| sokete bağlanırken gerekir ve bağlantının yapılacağı uzak konak üzerinde bir port 	  |
	| belirtir. 																	  		  |
	| 3. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::bind('127.0.0.2')			      	  							  |
	|          																				  |
	******************************************************************************************/
	public static function bind($address = '', $port = 0, $socket = NULL)
	{
		if( ! isValue($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_bind($socket, $address, $port);	
	}
	
	/******************************************************************************************
	* LISTEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir soketi bağlantı kabul etmek için dinler.					  		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @backlog => İşlem için kuyruğa alınacak azami gelen bağlantı sayısı. 	  |
	| Dolmuş bir kuyruğa gelen bir bağlantı ya ECONNREFUSED belirten bir hata alır ya da 	  |
	| ilgili protokol yeniden bağlanmayı destekliyorsa yineleme başarılı olacağından istek 	  |
	| yok sayılır.          																  |
	| 2. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::listen(SOMAXCONN)	        	  							      |
	|          																				  |
	******************************************************************************************/
	public static function listen($backlog = 0, $socket = NULL)
	{
		if( ! is_numeric($backlog) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_listen($socket, $backlog);	
	}
	
	/******************************************************************************************
	* CREATE LISTEN                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Bağlantı kabul etmek için port üzerinde bir soket açar.				  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @port => Tüm arabirimlerde dinlenecek port.          					  |
	| 2. numeric var @backlog => İşlem için kuyruğa alınacak azami gelen bağlantı sayısı. 	  |
	| Bu değiştirgeye SOMAXCONN atanabilir.  												  |
	|          																				  |
	| Örnek Kullanım: Socket::createListen(80, SOMAXCONN)	        	  					  |
	|          																				  |
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
	| Genel Kullanım: Soketle ilgili bir seçeneğin değerini döndürür.				          |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. numeric var @level => Seçeneğin geçerli olacağı protokol seviyesi. Örneğin soket 	  |
	| seviyesindeki seçenekleri almak için bu değiştirgede SOL_SOCKET kullanılabilirdi. TCP   |
	| gibi diğer seviyeler, seviyenin protokol numarası belirtilerek kullanılabilir.          |
	| 2. numeric var @optName => Seçenek ismi.  											  |
	| 3. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::getOption(SOL_SOCKET, SO_REUSEADDR)	        	  			  |
	|          																				  |
	******************************************************************************************/
	public static function getOption($level = 0, $optName = 0, $socket = NULL)
	{
		if( ! is_numeric($level) || ! is_numeric($optName) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_get_option($socket, $level, $optName);
	}
	
	/******************************************************************************************
	* SET OPTION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Soketle ilgili seçenekleri belirler.				          			  |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. numeric var @level => Seçeneğin geçerli olacağı protokol seviyesi. Örneğin soket 	  |
	| seviyesindeki seçenekleri almak için bu değiştirgede SOL_SOCKET kullanılabilirdi. TCP   |
	| gibi diğer seviyeler, seviyenin protokol numarası belirtilerek kullanılabilir.          |
	| 2. numeric var @optName => Seçenek ismi.  											  |
	| 3. numeric var @optValue => Seçenek değeri.  											  |
	| 4. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::setOption(SOL_SOCKET, SO_REUSEADDR, 1)	        	  		  |
	|          																				  |
	******************************************************************************************/
	public static function setOption($level = 0, $optName = 0, $optValue = 0, $socket = NULL)
	{
		if( ! is_numeric($level) || ! is_numeric($optName) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_set_option($socket, $level, $optName, $optValue);
	}
	
	/******************************************************************************************
	* GET PEER NAME                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen soketin yerel tarafını sorgulayıp soket türüne göre ya bir   |
	| konak/port çifti ya da bir Unix dosya yolu döndürür.				          			  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @address => Belirtilen soket AF_INET veya AF_INET6 türündeyse  			  |
	| socket_getsockname() işlevi, bu değiştirgede bir IP adresi (127.0.0.1 veya fe80::1 gibi)| 
	| ve port değiştirgesinde de belirtilmişse ilgili port numarasını döndürür.               |
	| 2. numeric var @port => Belirtilmişse ilgili port değeri bu değiştirgeye konur.    	  |
	| 3. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::getPeerName('127.0.0.1', 80)	        	  		  			  |
	|          																				  |
	******************************************************************************************/
	public static function getPeerName($address = '', $port = 0, $socket = NULL)
	{
		if( ! isValue($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		$name = socket_getpeername($socket, $address, $port);
		
		return array
		(
			'address'  => $address,
			'port'	   => $port,
			'return'   => $name
		);
	}
	
	/******************************************************************************************
	* GET SOCKET NAME                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen soketin yerel tarafını sorgulayıp soket türüne göre ya bir	  |
	| konak/port çifti ya da bir Unix dosya yolu döndürür.				          			  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @address => Belirtilen soket AF_INET veya AF_INET6 türündeyse  			  |
	| socket_getsockname() işlevi, bu değiştirgede bir IP adresi (127.0.0.1 veya fe80::1 gibi)| 
	| ve port değiştirgesinde de belirtilmişse ilgili port numarasını döndürür.               |
	| 2. numeric var @port => Belirtilmişse ilgili port değeri bu değiştirgeye konur.    	  |
	| 3. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::getName('127.0.0.1', 80)	        	  		  		  		  |
	|          																				  |
	******************************************************************************************/
	public static function getName($address = '', $port = 0, $socket = NULL)
	{
		if( ! isValue($address) || ! is_numeric($port) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		$name = socket_getsockname($socket, $address, $port);
		
		return array
		(
			'address' 	 => $address,
			'port'	  	 => $port,
			'return' 	 => $name
		);
	}
	
	/******************************************************************************************
	* RECEIVE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bağlı bir soketten veri alır.				          			  	      |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @buffer => Verinin alınacağı değişken burada belirtilir. Bir hata oluşursa| 
	| bağlantı kesilirse veya alınacak bir veri yoksa tampon içeriği olarak NULL atanır.      |
	| 2. numeric var @length => Okunacak azami bayt sayısını belirler.  	 				  |
	| 3. numeric var @options => Seçenekler.	 											  |
	| 	3.1 MSG_OOB																			  |
	| 	3.2 MSG_EOR       																	  |
	| 	3.3 MSG_EOF       																      |
	| 	3.4 MSG_DONTROUTE       															  |
	| 	3.5 MSG_WAITALL       															  	  |
	| 4. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::receives('Veri', 2048, MSG_WAITALL)	        	  		  	  |
	|          																				  |
	******************************************************************************************/
	public static function receive($buffer = '', $length = 0, $options = 0, $socket = NULL)
	{
		if( ! isValue($buffer) || ! is_numeric($length) || ! is_numeric($options) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		$receives = socket_recv($socket, $buffer, $length, $options);
		
		return array
		(
			'return' => $receives,
			'buffer' => $buffer
		);
	}
	
	/******************************************************************************************
	* RECEIVE FROM                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Bağlantılı olsun olmasın bir soketten veri alır.				          |
	|															                              |
	| Parametreler: 6 parametresi vardır.                                                     |
	| 1. string var @buffer => Alınan verinin yerleştirileceği tampon. 	  	 	 			  |	
	| 2. numeric var @length => Okunacak azami bayt sayısını belirler.  	 				  |
	| 3. numeric var @options => Seçenekler.	 											  |
	| 	3.1 MSG_OOB																			  |
	| 	3.2 MSG_EOR       																	  |
	| 	3.3 MSG_EOF       																      |
	| 	3.4 MSG_DONTROUTE       															  |
	| 	3.5 MSG_WAITALL       															  	  |
	| 4. string var @name => Soket AF_UNIX türündeyse dosya yolu, bağlantısız soketse uzak 	  |
	| konağın IP adresi, bağlantı yönelimli bir soketse NULL'dur.	 						  |
	| 5. numeric var @port => Sadece AF_INET ve AF_INET6 soketlere uygulanır ve verinin 	  |
	| alındığı uzak portu belirtir. Soket bağlantı yönelimli ise port NULL olacaktır.	 	  |
	| 6. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::receivesFrom('Veri', 2048, MSG_WAITALL)	        	  		  |
	|          																				  |
	******************************************************************************************/
	public static function receiveFrom($buffer = '', $length = 0, $options = 0, $name = '', $port = 0, $socket = NULL)
	{
		if( ! isValue($buffer) || ! is_numeric($length) || ! is_numeric($options) || ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		$receives = socket_recvfrom($socket, $buffer, $length, $options, $name, $port);
		
		return array
		(
			'return' => $receives,
			'buffer' => $buffer,
			'name'	 => $name,
			'port'	 => $port
		);
	}
	
	/******************************************************************************************
	* SELECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen soket dizileri üzerinde belirtilen zaman aşımı ile select()  |
	| sistem çağrısını çalıştırır				          									  |
	|															                              |
	| Parametreler: 6 parametresi vardır.                                                     |
	| 1. is_array var @read => Karakterlerin okunmaya hazır hale gelmesine kadar (başka bir   |
	| deyişle, okumanın engellenmediği görülene kadar) dinlenecek soket özkaynakları dizisi.  |	
	| 2. is_array var @write => Yazmanın engellenmediği görülene kadar 						  |
	| (soket yazmaya hazır hale gelene kadar) dinlenecek soket özkaynakları dizisi. 	 	  |
	| 3. is_array var @except => Bu dizideki soketler olağan dışı durumlara göre denetlenir.  |
	| 4. is_numeric var @secondTimeout => Saniye cinsinden zaman aşımı. select() sistem 	  |
	| çağrısının zamanaşımı değiştirgesini oluşturur.	 			  						  |
	| 5. numeric var @microSecondTimeout => Mikrosaniye cinsinden zaman aşımı. 	 	          |
	|          																				  |
	| Örnek Kullanım: Socket::select()	        	  		  								  |
	|          																				  |
	******************************************************************************************/
	public static function select($read = array(), $write = array(), $except = array(), $secondTimeout = 0, $microSecondTimeout = 0)
	{
		if( ! is_array($read) || ! is_array($write) || ! is_array($except) )
		{
			return false;
		}
		
		$select = socket_select($read, $write, $except, $secondTimeout, $microSecondTimeout);
		
		return array
		(
			'return' => $select,
			'read'   => $read,
			'write'	 => $write,
			'except' => $except
		);
	}
	
	/******************************************************************************************
	* SEND                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Bağlı bir sokete veri gönderir.				                          |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @buffer => Uzak konağa gönderilecek veriyi içeren tampon. 	  	 	 	  |	
	| 2. numeric var @length => Uzak konağa gönderilecek bayt sayısı.    	 				  |
	| 3. numeric var @options => Seçenekler.	 											  |
	| 	3.1 MSG_OOB																			  |
	| 	3.2 MSG_EOR       																	  |
	| 	3.3 MSG_EOF       																      |
	| 	3.4 MSG_DONTROUTE       															  |
	| 	3.5 MSG_WAITALL       															  	  |
	| 4. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::send('Veri', 2048, MSG_WAITALL)	        	  		          |
	|          																				  |
	******************************************************************************************/
	public static function send($buffer = '', $length = 0, $options = 0, $socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) || ! isValue($buffer) || ! is_numeric($length) || ! is_numeric($options) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_send($socket, $buffer, $length, $options);	
	}
	
	/******************************************************************************************
	* SEND TO                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Bağlı olsun olmasın bir sokete ileti gönderir.				          |
	|															                              |
	| Parametreler: 6 parametresi vardır.                                                     |
	| 1. string var @buffer => Veri bu tampondan gönderilir.         	  	 	 			  |	
	| 2. numeric var @length => Gönderilecek bayt sayısı.  	                 				  |
	| 3. numeric var @options => Seçenekler.	 											  |
	| 	3.1 MSG_OOB																			  |
	| 	3.2 MSG_EOR       																	  |
	| 	3.3 MSG_EOF       																      |
	| 	3.4 MSG_DONTROUTE       															  |
	| 	3.5 MSG_WAITALL       															  	  |
	| 4. string var @address => Uzak konağın IP adresi.		    	 						  |
	| 5. numeric var @port => Verinin gönderileceği uzak portun numarası.           	 	  |
	| 6. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::sendTo('Veri', 2048, MSG_WAITALL)	        	  		          |
	|          																				  |
	******************************************************************************************/
	public static function sendTo($buffer = '', $length = 0, $options = 0, $address = '', $port = 0, $socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) || ! isValue($buffer) || ! is_numeric($length) || ! is_numeric($options) || ! isValue($address) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_sendto($socket, $buffer, $length, $options, $address, $port);	
	}
	
	/******************************************************************************************
	* SET BLOCK                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Soketi engelleme kipine sokar.				          			      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::setBlock()	        	  		          				 	  |
	|          																				  |
	******************************************************************************************/
	public static function setBlock($socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_set_block($socket);	
	}
	
	/******************************************************************************************
	* SET NON BLOCK                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dosya tanıtıcısı için beklememe kipini etkinleştirir.		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::setNonBlock()	        	  		          				 	  |
	|          																				  |
	******************************************************************************************/
	public static function setNonBlock($socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_set_nonblock($socket);	
	}
	
	/******************************************************************************************
	* ACCEPT	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Soket üzerinden bağlantı kabul eder.		  							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::accept()	        	  		          				 	  	  |
	|          																				  |
	******************************************************************************************/
	public static function accept($socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_accept($socket);	
	}
	
	/******************************************************************************************
	* ERROR  	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Soket işlemleri ile ilgili oluşan hata bilgisini verir.		  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::error()	        	  		          				 	  	  |
	|          																				  |
	******************************************************************************************/
	public static function error($socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_strerror(self::errno($socket));
	}
	
	/******************************************************************************************
	* ERRNO 	                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Soket üzerindeki son hatanın kodunu döndürür.		  		  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::errno()	        	  		          				 	  	  |
	|          																				  |
	******************************************************************************************/
	public static function errno($socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_last_error($socket);
	}
	
	/******************************************************************************************
	* CLEAR ERROR                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Soket üzerindeki hatayı veya son hata kodunu siler.		  		  	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::clearError()	        	  		          				 	  |
	|          																				  |
	******************************************************************************************/
	public static function clearError($socket = NULL)
	{
		if( ! is_resource(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_clear_error($socket);
	}
	
	/******************************************************************************************
	* CLOSE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Bir soket özkaynağını serbest bırakır.		  		  	  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::clearError()	        	  		          				 	  |
	|          																				  |
	******************************************************************************************/
	public static function close($socket = NULL)
	{
		if( ! isset(self::$socketCreate) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		$close = socket_close($socket);
			
		self::$socketCreate = NULL;
		
		return $close;	
	}
	
	/******************************************************************************************
	* SHUT DOWN                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Bir soketi kapatır.		  		  	  			  					  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @ how => Kip.  														  |
	| 	1.1 0:Soket okumaya kapatılır.													      |
	|   1.2 1:Soket yazmaya kapatılır.														  |
	|   1.3 2:Soket yazmaya ve okumaya kapatılır.											  |
	| 2. [resource var @socket] => Farklı bir socket kullanılacaksa bu parametre kullanılır.  |
	|          																				  |
	| Örnek Kullanım: Socket::clearError()	        	  		          				 	  |
	|          																				  |
	******************************************************************************************/
	public static function shutDown($how = 2, $socket = NULL)
	{
		if( ! isset(self::$socketCreate) || ! is_numeric($how) )
		{
			return false;
		}
		
		if( ! is_resource($socket) )
		{
			$socket = self::$socketCreate;	
		}
		
		return socket_shutdown($socket, $how);
	}
}