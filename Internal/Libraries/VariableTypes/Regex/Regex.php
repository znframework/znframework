<?php
namespace ZN\VariableTypes;

class InternalRegex extends \Requirements implements RegexInterface
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
	// Match                                                                
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $pattern
	// @param string $str
	// @param string $ex
	// @param string $delimiter
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function match(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array
	{
		$pattern = $this->_regularConverting($pattern, $ex, $delimiter);
		
		preg_match($pattern, $str , $return);	
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Match All                                                                
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $pattern
	// @param string $str
	// @param string $ex
	// @param string $delimiter
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function matchAll(String $pattern, String $str, String $ex = NULL, String $delimiter = '/') : Array
	{
		$pattern = $this->_regularConverting($pattern, $ex, $delimiter);
		
		preg_match_all($pattern, $str , $return);	
		
		return $return;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Replace                                                                
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $pattern
	// @param string $rep
	// @param string $str
	// @param string $ex
	// @param string $delimiter
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function replace(String $pattern, String $rep, String $str, String $ex = NULL, String $delimiter = '/')
	{
		$pattern = $this->_regularConverting($pattern, $ex, $delimiter);	
		
		return preg_replace($pattern, $rep, $str);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Group                                                                
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $str
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function group(String $str) : String
	{
		return "(".$str.")";
	}
	
	//----------------------------------------------------------------------------------------------------
	// Recount                                                                
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $str
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function recount(String $str) : String
	{
		return "{".$str."}";
	}
	
	//----------------------------------------------------------------------------------------------------
	// To                                                                
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $str
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function to(String $str) : String
	{
		return "[".$str."]";
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Quote                                                                
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $data
	// @param string $delimiter
	//																						  
	//----------------------------------------------------------------------------------------------------
	public function quote(String $data, String $delimiter = NULL) : String
	{
		return preg_quote($data, $delimiter);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Regular Converting                                                                
	//----------------------------------------------------------------------------------------------------
	protected function _regularConverting($pattern, $ex, $delimiter)
	{
		
		$specialChars = $this->config['specialChars'];
		
		$pattern = str_ireplace(array_keys($specialChars ), array_values($specialChars), $pattern);
		
		// Config/Regex.php dosyasından düzenlenmiş karakter 
		// listeleri alınıyor.
		$regexChars   = \Arrays::multikey($this->config['regexChars']);
		
		$settingChars = \Arrays::multikey($this->config['settingChars']);
		// --------------------------------------------------------------------------------------------
		
		$pattern = str_ireplace(array_keys($regexChars), array_values($regexChars), $pattern);	
		
		if( ! empty($ex) ) 
		{
			$ex = str_ireplace(array_keys($settingChars), array_values($settingChars), $ex);
		}
		
		return presuffix($pattern, $delimiter).$ex;
	}
}