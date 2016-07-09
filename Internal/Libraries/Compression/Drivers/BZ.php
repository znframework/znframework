<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressInterface;

class BZDriver implements CompressInterface
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
	public function write($file = '', $data = '', $mode = NULL)
	{
		if( ! is_string($file) || empty($file) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(file)');	
		}
		
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '2.(data)');	
		}
		
		$open = bzopen($file, 'w');
		
		if( empty($open) )
		{
			return \Errors::set('Error', 'fileNotFound', $file);	
		}
		
		$return = bzwrite($open, $data, strlen($data));
		
		bzclose($open);
		
		return $return;
	}
	
	/******************************************************************************************
	* READ   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Sıkıştırılmış veriyi dosyadan okur.							     	  |
	|          																				  |
	******************************************************************************************/
	public function read($file = '', $length = 1024, $type = NULL)
	{
		if( ! is_string($file) || empty($file) )
		{
			return \Errors::set('Error', 'stringParameter', '1.(file)');	
		}
		
		if( ! is_numeric($length) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(length)');	
		}
		
		$open = bzopen($file, 'r');
		
		if( empty($open) )
		{
			return \Errors::set('Error', 'fileNotFound', $file);	
		}
		
		$return = bzread($open, $length);
		
		bzclose($open);
		
		return $return;
	}
	
	/******************************************************************************************
	* COMPRESS		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Verilen dizgeyi bzip2 kodlamalı olarak sıkıştırır.			     	  |
	|          																				  |
	******************************************************************************************/
	public function compress($data = '', $blockSize = 4, $workFactor = 0)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($blockSize) || ! is_numeric($workFactor) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(blockSize) & 3.(workFactor)');	
		}
		
		return bzcompress($data, $blockSize, $workFactor);
	}
	
	/******************************************************************************************
	* UNCOMPRESS	                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bzip2 ile sıkıştırılmış veriyi açar.							     	  |
	|          																				  |
	******************************************************************************************/
	public function uncompress($data = '', $small = 0)
	{
		if( ! is_scalar($data) )
		{
			return \Errors::set('Error', 'valueParameter', '1.(data)');	
		}
		
		if( ! is_numeric($small) )
		{
			return \Errors::set('Error', 'numericParameter', '2.(small)');	
		}
		
		return bzdecompress($data, $small);
	}
	
	public function encode($data = NULL, $level = NULL, $encoding = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function decode($data = NULL, $length = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function deflate($data = NULL, $level = NULL, $encoding = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function inflate($data = NULL, $length = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
}