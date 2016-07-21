<?php
namespace ZN\Caching\Drivers;

use ZN\Caching\CacheInterface;

class FileDriver implements CacheInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Path Değişkeni
	 *  
	 * Ön bellekleme dizin bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $path;
	
	/******************************************************************************************
	* CONSTRUCT YAPICISI                                                                      *
	******************************************************************************************/
	public function __construct()
	{
		$this->path = STORAGE_DIR.'Cache/';
		
		if( ! is_dir($this->path) )
		{
			\Folder::create($this->path, 0755);	
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
	public function select($key = '', $compressed = false)
	{
		$data = $this->_select($key);
		
		if( ! empty($data['data']) )
		{
			if( $compressed !== false )
			{
				$data['data'] = \Compress::driver($compressed)->uncompress($data['data']);
			}
			
			return $data['data'];
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
		if( $compressed !== false )
		{
			$var = \Compress::driver($compressed)->compress($var);
		}
		
		$datas = array
		(
			'time'	=> time(),
			'ttl'	=> $time,
			'data'	=> $var
		);
		
		if( \File::write($this->path.$key, serialize($datas)) )
		{
			\File::permission($this->path.$key, 0640);
			
			return true;
		}
		
		return false;
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
		return \File::delete($this->path.$key);
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
		$data = $this->_select($key);
		
		if( $data === false )
		{
			$data = ['data' => 0, 'ttl' => 60];
		}
		elseif( ! is_numeric($data['data']) )
		{
			return false;
		}
		
		$newValue = $data['data'] + $increment;
		
		return ( $this->insert($key, $newValue, $data['ttl']) )
			   ? $newValue
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
		$data = $this->_select($key);
		
		if( $data === false )
		{
			$data = ['data' => 0, 'ttl' => 60];
		}
		elseif( ! is_numeric($data['data']) )
		{
			return false;
		}
		
		$newValue = $data['data'] - $decrement;
		
		return $this->insert($key, $newValue, $data['ttl'])
			   ? $newValue
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
		return \Folder::delete($this->path);
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
		$info = \Folder::fileInfo($this->path);
 	
		if( $type === NULL )
		{
			return $info;	
		}
		elseif( ! empty($info[$type]) )
		{
			return $info[$type];
		}
		
		return false;
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
		if( ! file_exists($this->path.$key) )
		{
			return false;
		}
		
		$data = unserialize(\File::read($this->path.$key));
		
		if( is_array($data) )
		{
			$mtime = filemtime($this->path.$key);
			
			if( ! isset($data['ttl']) )
			{
				return false;
			}
			
			return 
			[
				'expire' => $mtime + $data['ttl'],
				'mtime'	 => $mtime
			];
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
		return is_writable($this->path);
	}
	
	/******************************************************************************************
	* PROTECTED SELECT	                                                                      *
	******************************************************************************************/
	protected function _select($key)
	{
		if( ! file_exists($this->path.$key) )
		{
			return false;
		}

		$data = unserialize(\File::read($this->path.$key));
		
		if( $data['ttl'] > 0 && time() > $data['time'] + $data['ttl'] )
		{
			\File::delete($this->path.$key);
			
			return false;
		}
		
		return $data;
	}
}