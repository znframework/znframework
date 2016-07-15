<?php
namespace ZN\Caching\Drivers;

use ZN\Caching\CacheInterface;

class ApcDriver implements CacheInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	public function __construct()
	{
		if( $this->isSupported() === false )
		{
			die(getErrorMessage('Cache', 'unsupported', 'Apc'));
		}	
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
	public function select($key = '')
	{
		$success = false;
		
		$data = apc_fetch($key, $success);
		
		if( $success === true )
		{
			return ( is_array($data) )
				   ? unserialize($data[0])
				   : $data;
		}
		
		return false;
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
	public function insert($key = '', $var = '', $time = 60, $compressed = false)
	{	
		$time = (int)$time;
		
		return apc_store
		(
			$key,
			$compressed === true ? $var : [serialize($var), time(), $time],
			$time
		);
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
	public function delete($key = '')
	{
		return apc_delete($key);
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
	public function increment($key = '', $increment = 1)
	{
		return apc_inc($key, $increment);
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
	public function decrement($key = '', $decrement = 1)
	{	
		return apc_dec($key, $decrement);
	}
	
	/******************************************************************************************
	* CLEAN                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Tüm önbelleği silmek için kullanılır.					                  |
	|          																				  |
	******************************************************************************************/
	public function clean()
	{
		return apc_clear_cache('user');
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
	public function info($type = NULL)
	{	
		return apc_cache_info($type);
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
	public function getMetaData($key = '')
	{
		$success = false;
		
		$stored = apc_fetch($key, $success);
		
		if( $success === false || count($stored) !== 3 )
		{
			return false;
		}
		
		list($data, $time, $expire) = $stored;
		
		return 
		[
			'expire' => $time + $expire,
			'mtime'	 => $time,
			'data'	 => unserialize($data)
		];
	}
	
	/******************************************************************************************
	* IS SUPPORTED                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sürücünün desteklenip desklenmediğini öğrenmek için kullanılır.         |
	|          																				  |
	******************************************************************************************/
	public function isSupported()
	{
		if( ! extension_loaded('apc') || ! ini_get('apc.enabled') )
		{
			return \Errors::set('Cache', 'unsupported', 'Apc');
		}
		
		return true;
	}
}