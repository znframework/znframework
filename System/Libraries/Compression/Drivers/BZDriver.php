<?php
class BZDriver
{
	/***********************************************************************************/
	/* BZIP2 LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: BZ
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: BZ::, $this->BZ, zn::$use->BZ, uselib('BZ')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	public function extract()
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
	public function write($file = '', $data = '')
	{
		if( ! is_string($file) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(file)'));	
		}
		
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '2.(data)'));	
		}
		
		$open = bzopen($file, 'w');
		
		if( empty($open) )
		{
			return Error::set(lang('Error', 'fileNotFound', $file));	
		}
		
		$return = bzwrite($open, $data, strlen($data));
		
		bzclose($open);
		
		return $return;
	}
	
	/******************************************************************************************
	* SIMPLE WRITE                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Veriyi sıkıştırarak dosyaya yazar.							     	  |
	|          																				  |
	******************************************************************************************/
	public function simpleWrite($zp = '', $data = '', $length = 0)
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '2.(data)'));	
		}
		
		if( $length === 0 )
		{
			$length = strlen($data);	
		}
		
		return bzwrite($zp, $data, $length);
	}
	
	/******************************************************************************************
	* READ   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Sıkıştırılmış veriyi dosyadan okur.							     	  |
	|          																				  |
	******************************************************************************************/
	public function read($file = '', $length = 1024)
	{
		if( ! is_string($file) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(file)'));	
		}
		
		if( ! is_numeric($length) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(length)'));	
		}
		
		$open = bzopen($file, 'r');
		
		if( empty($open) )
		{
			return Error::set(lang('Error', 'fileNotFound', $file));	
		}
		
		$return = bzread($open, $length);
		
		bzclose($open);
		
		return $return;
	}
	
	/******************************************************************************************
	* SIMPLE READ   	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sıkıştırılmış veriyi dosyadan okur.							     	  |
	|          																				  |
	******************************************************************************************/
	public function simpleRead($zp = '', $length = 1024)
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return bzread($zp, $length);
	}
	
	/******************************************************************************************
	* COMPRESS		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Verilen dizgeyi bzip2 kodlamalı olarak sıkıştırır.			     	  |
	|          																				  |
	******************************************************************************************/
	public function compress($data = '', $blockSize = 4, $workFactor = 0)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($blockSize) || ! is_numeric($workFactor) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(blockSize) & 3.(workFactor)'));	
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
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($small) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(small)'));	
		}
		
		return bzdecompress($data, $small);
	}
	
	public function optimizedFor()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;
	}
	
	public function encode()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function decode()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function deflate()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function inflate()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	/******************************************************************************************
	* CLOSE  	                                                      	                      *
	*******************************************************************************************
	| Genel Kullanım: Bir açık gzipli dosya tanıtıcısını kapar.								  |
	|          																				  |
	******************************************************************************************/
	public function close($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return bzclose($zp);
	}
	
	public function eof()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function file()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function getChar()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function getLine()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function getCleanLine()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	/******************************************************************************************
	* OPEN	                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Bir gzipli dosya açar.												  |
	|          																				  |
	******************************************************************************************/
	public function open($filename = '', $mode = '')
	{
		if( ! is_string($filename) || ! is_string($mode) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(filename) & 2.(mode)'));	
		}
		
		return bzopen($filename, $mode);
	}
	
	public function passThru()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function rewind()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function seek()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function tell()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function readFile()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function encodingType()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
}