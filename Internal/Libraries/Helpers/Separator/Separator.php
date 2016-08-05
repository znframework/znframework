<?php 
namespace ZN\Helpers;

class InternalSeparator extends \CallController implements SeparatorInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Key
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $key = "+-?||?-+" ;
	
	//----------------------------------------------------------------------------------------------------
	// Separator
	//----------------------------------------------------------------------------------------------------
	// 
	// @var string
	//
	//----------------------------------------------------------------------------------------------------
	protected $separator = "|?-++-?|";
	
	//----------------------------------------------------------------------------------------------------
	// Protected Security
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string  $data
	//
	//----------------------------------------------------------------------------------------------------
	protected function _security($data)
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
	public function encode(Array $data, String $key = NULL, String $separator = NULL)
	{
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
	public function decode(String $word, String $key = NULL, String $separator = NULL)
	{
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
	public function decodeArray(String $word, String $key = NULL, String $separator = NULL)
	{
		return (array)$this->decode($word, $key, $separator);
	}
}