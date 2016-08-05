<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\DriverMapping;

class GZDriver extends DriverMapping
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
	* WRITE   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Veriyi sıkıştırarak dosyaya yazar.							     	  |
	|          																				  |
	******************************************************************************************/
	public function write($file = '', $data = '', $mode = 'w')
	{
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
		return gzuncompress($data, $length);
	}
	
	/******************************************************************************************
	* ENCODE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Gzipli bir dizge oluşturur.				     						  |
	|          																				  |
	******************************************************************************************/
	public function encode($data = '', $level = -1, $encoding = FORCE_GZIP)
	{
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
		return gzinflate($data, $length);
	}
}