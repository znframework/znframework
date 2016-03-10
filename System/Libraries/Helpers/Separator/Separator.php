<?php 
class __USE_STATIC_ACCESS__Separator implements SeparatorInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Key Değişkeni
	 *  
	 * Anahtar ile değer asındaki ayraç
	 * Varsayılan:+-?||?-+
	 */
	private $key = "+-?||?-+" ;
	
	/* Seperator Değişkeni
	 *  
	 * Anahtar ve değerler asındaki ayraç
	 * Varsayılan:|?-++-?|
	 */
	private $seperator = "|?-++-?|";
	
	use CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use ErrorControlTrait;
	
	/******************************************************************************************
	* ENCODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen ayraçlara göre diziyi özel bir veri tipine çeviriyor.        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. array var @data => Özel veriye çevrilecek dizi parametresi.        	  			  |
	| 2. [ string var @key ] => Anahtar değer ayracı. Varsayılan:+-?||?-+	                  |
	| 3. [ string var @seperator ] => Parametre ayracı. Varsayılan:|?-++-?|	                  |
	|          																				  |
	| Örnek Kullanım: encode(array(1 => 1, 2 => 2));        	  					          |
	| // 1+-?||?-+1|?-++-?|2+-?||?-+2     													  |
	|          																				  |
	******************************************************************************************/	
	public function encode($data = array(), $key = '', $seperator = '')
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_array($data) ) 
		{
			return Errors::set('Error', 'arrayParameter', 'data');
		}
		
		if( ! is_string($key) ) 
		{
			$key = '';
		}
		
		if( ! is_string($seperator) ) 
		{
			$seperator = '';
		}
		
		$word = '';
		
		// @key parametresi boş ise ön tanımlı ayracı kullan.
		if( empty($key) ) 
		{
			$key = $this->key;
		}
		
		// @seperator parametresi boş ise ön tanımlı ayracı kullan.
		if( empty($seperator) ) 
		{
			$seperator = $this->seperator;
		}
		// -----------------------------------------------------------------------------
		
		// Özel veri tipine çevirme işlemini başlat.
		foreach($data as $k => $v)
		{
			$word .= $k.$key.$v.$seperator;	
		}
		
		return substr($word, 0, -(strlen($seperator)));
	}
	
	/******************************************************************************************
	* DECODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. array var @data => Object veri türüne çevrilecek özel veri.        	  			  |
	| 2. [ string var @key ] => Anahtar değer ayracı. Varsayılan:+-?||?-+	                  |
	| 3. [ string var @seperator ] => Parametre ayracı. Varsayılan:|?-++-?|	                  |
	|          																				  |
	| Örnek Kullanım: decode('1+-?||?-+1|?-++-?|2+-?||?-+2 ');        	  					  |
	| //  (object)array(1 => 1, 2 => 2)   													  |
	|          																				  |
	******************************************************************************************/	

	public function decode($word = '', $key = '', $seperator = '')
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_string($word) ) 
		{
			return Errors::set('Error', 'stringParameter', 'word');
		}
		
		if( empty($word) ) 
		{
			return Errors::set('Error', 'emptyParameter', 'word');
		}
		
		if( ! is_string($key) ) 
		{
			$key = '';
		}
		
		if( ! is_string($seperator) ) 
		{
			$seperator = '';
		}
		
		if( empty($key) ) 
		{
			$key = $this->key;
		}
		
		if( empty($seperator) ) 
		{
			$seperator = $this->seperator;
		}
		// -----------------------------------------------------------------------------
		
		$keyval = explode($seperator, $word);
		$splits = array();
		$object = array();
		
		if( is_array($keyval) ) foreach( $keyval as $v )
		{
			 $splits = explode($key, $v);
			 
			 if( isset($splits[1]) )
			 {
				$object[$splits[0]] = $splits[1];
			 }
		}
		
		return (object)$object;
	}
}