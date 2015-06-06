<?php 
/************************************************************/
/*                      CACHE LIBRARY                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CACHE	WITH VERSION 1.3	                                                              *
*******************************************************************************************
| Dahil(Import) Edilirken : SCache  							                          |
| Sınıfı Kullanırken      :	scache::     												  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class SCache
{
	/* Cache Değişkeni
	 *  
	 * Cache sürücüsünü
	 * tutmak için oluşturulmuştur.
	 *
	 */ 
	protected static $cache;
	
	protected static $settings = false;
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Nesne tanımlaması ve ön bellek ayarları çalıştırılıyor.				  |
	|          																				  |
	******************************************************************************************/
	public static function settings($driver = '')
	{
		require_once(CACHE_DIR.'CacheCommon.php');
		
		self::$cache = cachecommon($driver);
		
		if( self::$cache === false )
		{
			if( empty($driver) )
			{
				$config = config::get('Cache');
				$driver = $config['driver'];
			}
		
			die(get_message('Cache', 'cache_invalid_driver', $driver));	
		}
		
		self::$settings = true;
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
	public static function select($key = '')
	{ 
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->select($key);
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
	public static function insert($key = '', $var = '', $time = 60, $compressed = false)
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->insert($key, $var, $time, $compressed);
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
	public static function delete($key = '')
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->delete($key);
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
	public static function increment($key = '', $increment = 1)
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->increment($key, $increment);
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
	public static function decrement($key = '', $decrement = 1)
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->decrement($key, $decrement);
	}
	
	/******************************************************************************************
	* CLEAN                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Tüm önbelleği silmek için kullanılır.					                  |
	|          																				  |
	******************************************************************************************/
	public static function clean()
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->clean();
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
	public static function info($type = 'user')
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->info($type);
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
	public static function get_metadata($key = '')
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->get_metadata($key);
	}
	
	/******************************************************************************************
	* IS SUPPORTED                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sürücünün desteklenip desklenmediğini öğrenmek için kullanılır.         |
	|          																				  |
	******************************************************************************************/
	public static function is_supported()
	{
		if( empty(self::$settings) )
		{
			self::settings();	
		}
		
		return self::$cache->is_supported();
	}
	
	/******************************************************************************************
	* DIFFERENT DRIVER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Farklı sürücüleri aynı anda kullanmak için kullanılır. 		          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @driver => Farklı olarak kullanılacak sürücü.							  |
	|																						  |
	| Örnek Kullanım: ->different_driver('apc');			        		     			  |
	|          																				  |
	******************************************************************************************/
	public static function driver($driver = '')
	{	
		return new Cache($driver);	
	}
}