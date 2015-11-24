<?php	
class WincacheDriver implements CacheInterface
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
		$success = false;
		
		if( function_exists('wincache_ucache_get') )
		{
			$data = wincache_ucache_get($key, $success);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
		}
		
		return ( $success ) 
			   ? $data 
			   : false;
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
	public function insert($key = '', $var = '', $time = 60, $expressed = false)
	{
		if( function_exists('wincache_ucache_set') )
		{
			return wincache_ucache_set($key, $var, $time);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
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
	public function delete($key = '')
	{
		if( function_exists('wincache_ucache_delete') )
		{
			return wincache_ucache_delete($key);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
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
	public function increment($key = '', $increment = 1)
	{
		$success = false;
		
		if( function_exists('wincache_ucache_inc') )
		{
			$value = wincache_ucache_inc($key, $increment, $success);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
		}
		
		return ( $success === true ) 
			   ? $value 
			   : false;
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
		$success = false;
		
		if( function_exists('wincache_ucache_dec') )
		{
			$value = wincache_ucache_dec($key, $decrement, $success);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
		}
		
		return ( $success === true ) 
			   ? $value 
			   : false;
	}
	
	/******************************************************************************************
	* CLEAN                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Tüm önbelleği silmek için kullanılır.					                  |
	|          																				  |
	******************************************************************************************/
	public function clean()
	{
		if( function_exists('wincache_ucache_clear') )
		{
			return wincache_ucache_clear();
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
		}
	}
	
	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Ön bellekleme hakkında bilgi edinmek için kullanılır. 		          |
	|          																				  |
	******************************************************************************************/
	public function info($type = NULL)
 	{
		if( function_exists('wincache_ucache_info') )
		{
			return wincache_ucache_info(true);
		}
		else
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
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
	public function getMetaData($key = '')
	{
		if( ! function_exists('wincache_ucache_info') )
		{
			return getMessage('Cache', 'unsupported', 'Wincache');
		}
		
		if( $stored = wincache_ucache_info(false, $key) )
		{
			$age 	  = $stored['ucache_entries'][1]['age_seconds'];
			$ttl 	  = $stored['ucache_entries'][1]['ttl_seconds'];
			$hitcount = $stored['ucache_entries'][1]['hitcount'];
			
			return array
			(
				'expire'	=> $ttl - $age,
				'hitcount'	=> $hitcount,
				'age'		=> $age,
				'ttl'		=> $ttl
			);
		}
		return false;
	}
	
	/******************************************************************************************
	* IS SUPPORTED                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sürücünün desteklenip desklenmediğini öğrenmek için kullanılır.         |
	|          																				  |
	******************************************************************************************/
	public function isSupported()
	{
		if ( ! extension_loaded('wincache') || ! ini_get('wincache.ucenabled') )
		{
			$report = getMessage('Cache', 'unsupported', 'Wincache');
			report('CacheUnsupported', $report, 'CacheLibary');
			return false;
		}
		
		return true;
	}
}