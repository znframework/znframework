<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressInterface;

class ZipDriver implements CompressInterface
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
	* EXRACT   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: File::zipExtract() yöntemi ile aynı kullanıma sahiptir.		    	  |
	|          																				  |
	******************************************************************************************/
	public function extract($source = '', $target = '', $password = NULL)
	{
		return \File::zipExtract($source, $target);
	}
	
	public function write($file = NULL, $data = NULL, $mode = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
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
		
		$open = zip_open($file);
		
		if( empty($open) )
		{
			return \Errors::set('Error', 'fileNotFound', $file);	
		}
		
		$return = zip_read($open);
		
		zip_close($open);
		
		return $return;
	}
	
	public function compress($data = '', $blockSize = NULL, $workFactor = NULL)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function uncompress($data = '', $small = 0)
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
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