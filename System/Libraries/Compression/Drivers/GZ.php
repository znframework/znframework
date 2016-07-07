<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressInterface;

class GZDriver implements CompressInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	public function extract($source = NULL, $target = NULL, $password = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	/******************************************************************************************
	* WRITE   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veriyi sıkıştırarak dosyaya yazar.							     	  |
	|          																				  |
	******************************************************************************************/
	public function write($file = '', $data = '', $mode = 'w')
	{
		if( ! is_string($file) || empty($file) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(file)');	
		}
		
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '2.(data)');	
		}
		
		$open = gzopen($file, $mode);
		
		if( empty($open) )
		{
			return \Errors::set('Error', 'fileNotFound', $file);	
		}
		
		$return = gzwrite($open, $data, strlen($data));
		
		gzclose($open);
		
		return $return;
	}
	
	/******************************************************************************************
	* READ   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Sıkıştırılmış veriyi dosyadan okur.							     	  |
	|          																				  |
	******************************************************************************************/
	public function read($file = '', $length = 1024, $mode = 'r')
	{
		if( ! is_string($file) || empty($file) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(file)');	
		}
		
		if( ! is_numeric($length) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(length)');	
		}
		
		$open = gzopen($file, $mode);
		
		if( empty($open) )
		{
			return \Errors::set('Error', 'fileNotFound', $file);	
		}
		
		$return = gzread($open, $length);
		
		gzclose($open);
		
		return $return;
	}
	
	/******************************************************************************************
	* COMPRESS		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Verilen dizgeyi gz kodlamalı olarak sıkıştırır.				     	  |
	|          																				  |
	******************************************************************************************/
	public function compress($data = '', $level = -1, $encoding = ZLIB_ENCODING_DEFLATE)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(level) & 3.(encoding)');	
		}
		
		return gzcompress($data, $level, $encoding);
	}
	
	/******************************************************************************************
	* UNCOMPRESS	                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Gz ile sıkıştırılmış veriyi açar.								     	  |
	|          																				  |
	******************************************************************************************/
	public function uncompress($data = '', $length = 0)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($length) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(length)');	
		}
		
		return gzuncompress($data, $length);
	}
	
	public function optimizedFor()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;
	}
	
	/******************************************************************************************
	* ENCODE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Gzipli bir dizge oluşturur.				     						  |
	|          																				  |
	******************************************************************************************/
	public function encode($data = '', $level = -1, $encoding = FORCE_GZIP)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(level) & 3.(encoding)');	
		}
		
		return gzencode($data, $level, $encoding);
	}
	
	/******************************************************************************************
	* DECODE	                                                      	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli bir dizgenin sıkıştırmasını açar.								  |
	|          																				  |
	******************************************************************************************/
	public function decode($data = '', $length = 0)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($length) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(length)');	
		}
		
		return gzdecode($data, $length);
	}
	
	/******************************************************************************************
	* DEFLATE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir dizgeyi deflate biçeminde sıkıştırır.								  |
	|          																				  |
	******************************************************************************************/
	public function deflate($data = '', $level = -1, $encoding = ZLIB_ENCODING_RAW)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(level) & 3.(encoding)');	
		}
		
		return gzdeflate($data, $level, $encoding);
	}
	
	/******************************************************************************************
	* INFLATE	                                                      	                      *
	*******************************************************************************************
	| Genel Kullanım: Deflate bir dizgenin sıkıştırmasını açar.								  |
	|          																				  |
	******************************************************************************************/
	public function inflate($data = '', $length = 0)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($length) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(length)');	
		}
		
		return gzinflate($data, $length);
	}
}