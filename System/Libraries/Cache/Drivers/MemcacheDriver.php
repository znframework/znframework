<?php
/************************************************************/
/*                  MEMCACHE DRIVER LIBRARY                 */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* MEMCACHE DRIVER		                                                                  *
*******************************************************************************************
| Dahil(Import) Edilirken : Dahil Edilemez.  							                  |
| Sınıfı Kullanırken      :	Kullanılamaz.												  |
| 																						  |
| NOT: Ön bellekleme kütüphanesi için oluşturulmuş yardımcı sınıftır.                     |
******************************************************************************************/	
class MemcacheDriver
{
	/******************************************************************************************
	* CONNECT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve ön bellek ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public function connect($settings = array())
	{
		if( ! function_exists('memcache_add_server') )
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
		
		$config = Config::get('Cache', 'driverSettings');
		
		$config = ! empty($settings)
				  ? $settings
				  : $config['memcache'];
			
		$connect = @memcache_add_server($config['host'], $config['port'], $config['weight']);		
		
		if( empty($connect) )
		{
			die(getMessage('Cache', 'unsupported', 'Memcache'));
		}
		
		return true;
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Önbelleğe alınmış nesneyi çağırmak için kullanılır.				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @key => Nesne anahtarı.							 	 			    	  |
	|          																				  |
	| Örnek Kullanım: ->get('nesne');			        									  |
	|          																				  |
	******************************************************************************************/
	public function select($key)
	{
		if( ! function_exists('memcache_get') )
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
		
		$data = memcache_get($key);
		
		return ( is_array($data) ) 
			   ? $data[0] 
			   : $data;
	}
	
	/******************************************************************************************
	* INSERT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Ön bellekte değişken saklamak için kullanılır.					      |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @key => Nesne anahtarı.							 	 			    	  |
	| 2. variable var @var => Nesne.							 	 			    	 	  |
	| 3. numeric var @time => Saklanacağı zaman.							 	 			  |
	| 4. mixed var @compressed => Sıkıştırma.							 	 			  	  |
	|          																				  |
	| Örnek Kullanım: ->get('nesne');			        									  |
	|          																				  |
	******************************************************************************************/
	public function insert($key, $var, $time = 60, $compressed = false)
	{
		if( $compressed !== true )
		{
			$var = array($var, time(), $time);
		}
		
		if( function_exists('memcache_set') )
		{
			return memcache_set($key, $var, 0, $time);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Ön bellekten nesneyi silmek için kullanılır.					          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @key => Nesne anahtarı.							 	 			    	  |
	|																						  |
	| Örnek Kullanım: ->delete('nesne');			        							      |
	|          																				  |
	******************************************************************************************/
	public function delete($key)
	{
		if( function_exists('memcache_delete') )
		{
			return memcache_delete($key);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
	}
	
	/******************************************************************************************
	* INCREMENT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesnenin değerini artımak için kullanılır.				              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @key => Nesne anahtarı.							 	 			    	  |
	| 2. numeric var @increment => Artırım miktarı.  				 	 			    	  |
	|																						  |
	| Örnek Kullanım: ->increment('nesne', 1);			        							  |
	|          																				  |
	******************************************************************************************/
	public function increment($key, $increment = 1)
	{
		if( function_exists('memcache_increment') )
		{
			return memcache_increment($key, $increment);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
	}
	
	/******************************************************************************************
	* DECREMENT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesnenin değerini azaltmak için kullanılır.					          |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @key => Nesne anahtarı.							 	 			    	  |
	| 2. numeric var @decrement => Azaltım miktarı.  				 	 			    	  |
	|																						  |
	| Örnek Kullanım: ->decrement('nesne', 1);			        							  |
	|          																				  |
	******************************************************************************************/
	public function decrement($key, $decrement = 1)
	{
		if( function_exists('memcache_decrement') )
		{
			return memcache_decrement($key, $decrement);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
	}
	
	/******************************************************************************************
	* CLEAN                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Tüm önbelleği silmek için kullanılır.					                  |
	|          																				  |
	******************************************************************************************/
	public function clean()
	{
		if( function_exists('memcache_flush') )
		{
			return memcache_flush();
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
	}
	
	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Ön bellekleme hakkında bilgi edinmek için kullanılır. 		          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @type => Bilgi alınacak kullanıcı türü.							 	 	  |
	|																						  |
	| Örnek Kullanım: ->info('user');			        		     					      |
	|          																				  |
	******************************************************************************************/
	public function info()
 	{
		if( function_exists('memcache_get_stats') )
		{
			return memcache_get_stats(true);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
 	}
	
	/******************************************************************************************
	* GET METADATA                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Ön bellekteki nesne hakkında bilgi almak için kullanılır. 		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @key => Bilgi alınacak nesne.							 	 			  |
	|																						  |
	| Örnek Kullanım: ->get_metadata('nesne');			        		     				  |
	|          																				  |
	******************************************************************************************/
	public function getMetaData($key)
	{
		if( ! function_exists('memcache_get') )
		{
			return getMessage('Cache', 'unsupported', 'Memcache');
		}
		
		$stored = memcache_get($key);
		
		if( count($stored) !== 3 )
		{
			return false;
		}
		
		list($data, $time, $expire) = $stored;
		
		return array
		(
			'expire' => $time + $expire,
			'mtime'	 => $time,
			'data'	 => $data
		);
	}
	
	/******************************************************************************************
	* IS SUPPORTED                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sürücünün desteklenip desklenmediğini öğrenmek için kullanılır.         |
	|          																				  |
	******************************************************************************************/
	public function isSupported()
	{
		if ( ! extension_loaded('memcached') && ! extension_loaded('memcache') )
		{
			$report = getMessage('Cache', 'unsupported', 'Memcache');
			report('CacheUnsupported', $report, 'CacheLibary');
			return false;
		}
		
		return $this->connect();
	}
}