<?php
namespace ZN\Compression\Drivers;

use ZN\Compression\DriverMapping;

class ZipDriver extends DriverMapping
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
	
	/******************************************************************************************
	* READ   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Sıkıştırılmış veriyi dosyadan okur.							     	  |
	|          																				  |
	******************************************************************************************/
	public function read($file = '', $length = 1024, $mode = 'r')
	{
		$open = zip_open($file);
		
		if( empty($open) )
		{
			return \Exceptions::throws('Error', 'fileNotFound', $file);	
		}
		
		$return = zip_read($open);
		
		zip_close($open);
		
		return $return;
	}
}