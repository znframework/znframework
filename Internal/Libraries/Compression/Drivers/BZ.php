<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\CompressAbstract\CompressAbstract;

class BZDriver extends CompressAbstract
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
	public function write($file = '', $data = '', $mode = NULL)
	{
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
		return bzdecompress($data, $small);
	}
}