<?php
class ZipDriver
{
	/***********************************************************************************/
	/* ZIP LIBRARY		     				                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Zip
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Zip::, $this->Zip, zn::$use->Zip, uselib('Zip')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/

	/******************************************************************************************
	* EXRACT   		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: File::zipExtract() yöntemi ile aynı kullanıma sahiptir.		    	  |
	|          																				  |
	******************************************************************************************/
	public function extract($source = '', $target = '')
	{
		return File::zipExtract($source, $target);
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
		if( ! is_string($file) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(file)'));	
		}
		
		$open = zip_open($file);
		
		if( empty($open) )
		{
			return Error::set(lang('Error', 'fileNotFound', $file));	
		}
		
		$return = zip_read($open);
		
		zip_close($open);
		
		return $return;
	}
	
	/******************************************************************************************
	* SIMPLE READ   	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Sıkıştırılmış veriyi dosyadan okur.							     	  |
	|          																				  |
	******************************************************************************************/
	public function simpleRead($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return zip_read($zp);
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
		
		return zip_close($zp);
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
	public function open($filename = '', $mode = '', $includePath = 0)
	{
		if( ! is_string($filename) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(filename)'));	
		}
		
		return zip_open($filename);
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