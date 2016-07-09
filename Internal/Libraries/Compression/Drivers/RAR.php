<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressInterface;

class RarDriver implements CompressInterface
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
	public function extract($source = '', $target = '.', $password = NULL)
	{
		if( ! is_file($source) )
		{
			return \Errors::set('Error', 'fileParameter', '1.(source)');
		}
		
		$rarFile = rar_open($source, $password);
		$list    = rar_list($rarFile);
		
		if( ! empty($list) ) foreach( $list as $file ) 
		{
			$entry = rar_entry_get($rarFile, $file);
			$entry->extract($target);
		}
		else
		{
			return \Errors::set('Error', 'emptyVariable', '$list');	
		}
		
		rar_close($rarFile);
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
		return false;
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