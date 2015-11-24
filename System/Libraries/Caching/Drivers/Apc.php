<?php
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
		if( ! function_exists('apc_fetch') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
		$success = false;
		
		$data = apc_fetch($key, $success);
		
		if ( $success === true )
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
		if( ! function_exists('apc_store') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
		$time = (int)$time;
		
		return apc_store
		(
			$key,
			$compressed === true ? $var : array(serialize($var), time(), $time),
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
		if( ! function_exists('apc_delete') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
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
		if( ! function_exists('apc_inc') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
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
		if( ! function_exists('apc_dec') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
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
		if( ! function_exists('apc_clear_cache') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
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
		if( ! function_exists('apc_cache_info') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
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
		if( ! function_exists('apc_fetch') )
		{
			return getMessage('Cache', 'unsupported', 'Apc');
		}
		
		$success = false;
		
		$stored = apc_fetch($key, $success);
		
		if( $success === false || count($stored) !== 3 )
		{
			return false;
		}
		
		list($data, $time, $expire) = $stored;
		
		return array
		(
			'expire' => $time + $expire,
			'mtime'	 => $time,
			'data'	 => unserialize($data)
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
		if ( ! extension_loaded('apc') || ! ini_get('apc.enabled') )
		{
			$report = getMessage('Cache', 'unsupported', 'Apc');
			report('CacheUnsupported', $report, 'CacheLibary');
			return false;
		}
		
		return true;
	}
}