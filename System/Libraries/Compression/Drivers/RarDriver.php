<?php
class RarDriver
{
	/***********************************************************************************/
	/* RAR LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: RarDriver
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Compress kütüphanesi tarafından kullanılmaktadır.
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/

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
			return Error::set(lang('Error', 'fileParameter', '1.(source)'));
		}
		
		$rarFile = rar_open($source, $password);
		$list    = rar_list($rarFile);
		
		if( ! empty($list) ) foreach( $list as $file ) 
		{
			$entry = rar_entry_get($rarFile, $file);
			$entry->extract($target); // extract to the current dir
		}
		else
		{
			return Error::set(lang('Error', 'emptyVariable', '$list'));	
		}
		
		rar_close($rarFile);
	}
	
	public function write()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function simpleWrite()
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
	
	/******************************************************************************************
	* SIMPLE READ   	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sıkıştırılmış veriyi dosyadan okur.							     	  |
	|          																				  |
	******************************************************************************************/
	public function simpleRead($zp = '')
	{
		return false;
	}
	
	public function compress()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function uncompress()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
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
		
		return rar_close($zp);
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
	| Genel Kullanım: Bir rarlı dosya açar.													  |
	|          																				  |
	******************************************************************************************/
	public function open($filename = '', $password = NULL, $volumeCallback = NULL)
	{
		if( ! is_string($filename) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(filename)'));	
		}
		
		return rar_open($filename, $password, $volumeCallback);
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