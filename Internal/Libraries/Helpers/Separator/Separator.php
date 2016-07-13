<?php 
namespace ZN\Helpers;

class InternalSeparator implements SeparatorInterface
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
	private $separator = "|?-++-?|";
	
	use \CallUndefinedMethodTrait;
	
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
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Protected Security
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string  $data
	//
	//----------------------------------------------------------------------------------------------------
	protected function _security($data = '')
	{
		return str_replace([$this->key, $this->separator], '', $data);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Encode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param array  $data
	// @param string $key
	// @param string $separator
	//
	//----------------------------------------------------------------------------------------------------
	public function encode($data = [], $key = '', $separator = '')
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_array($data) ) 
		{
			return \Errors::set('Error', 'arrayParameter', 'data');
		}
		
		if( ! is_string($key) ) 
		{
			$key = '';
		}
		
		if( ! is_string($separator) ) 
		{
			$separator = '';
		}
		
		$word = '';
		
		// @key parametresi boş ise ön tanımlı ayracı kullan.
		if( empty($key) ) 
		{
			$key = $this->key;
		}
		
		// @seperator parametresi boş ise ön tanımlı ayracı kullan.
		if( empty($separator) ) 
		{
			$separator = $this->separator;
		}
		// -----------------------------------------------------------------------------
		
		// Özel veri tipine çevirme işlemini başlat.
		foreach( $data as $k => $v )
		{
			$word .= $this->_security($k).$key.$this->_security($v).$separator;	
		}
		
		return mb_substr($word, 0, -(mb_strlen($separator)));
	}
	
	//----------------------------------------------------------------------------------------------------
	// Decode
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $word
	// @param string $key
	// @param string $separator
	//
	//----------------------------------------------------------------------------------------------------
	public function decode($word = '', $key = '', $separator = '')
	{
		// Parametre kontrolleri yapılıyor. -------------------------------------------
		if( ! is_string($word) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'word');
		}
		
		if( empty($word) ) 
		{
			return \Errors::set('Error', 'emptyParameter', 'word');
		}
		
		if( ! is_string($key) ) 
		{
			$key = '';
		}
		
		if( ! is_string($separator) ) 
		{
			$separator = '';
		}
		
		if( empty($key) ) 
		{
			$key = $this->key;
		}
		
		if( empty($separator) ) 
		{
			$separator = $this->separator;
		}
		// -----------------------------------------------------------------------------
		
		$keyval = explode($separator, $word);
		$splits = [];
		$object = [];
		
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
	
	//----------------------------------------------------------------------------------------------------
	// Decode Array
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $word
	// @param string $key
	// @param string $separator
	//
	//----------------------------------------------------------------------------------------------------
	public function decodeArray($word = '', $key = '', $separator = '')
	{
		return (array)$this->decode($word, $key, $separator);
	}
}