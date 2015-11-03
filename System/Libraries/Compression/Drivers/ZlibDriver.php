<?php
class ZlibDriver
{
	/***********************************************************************************/
	/* ZLIB LIBRARY							                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Zlib
	/* Sınıf Versiyon: PHP 5 >= 5.4.0
	/* ZN Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Zlib::, $this->Zlib, zn::$use->Zlib, uselib('Zlib')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	public function __construct()
	{
		if( ! isPhpVersion('5.4.0') )
		{
			die(getErrorMessage('Error', 'invalidVersion', array('%' => 'zlib_', '#' => '5.4.0')));		
		}	
	}
	
	public function extract()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
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
	
	public function read()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
	
	public function simpleRead()
	{
		// Bu sürücü tarafından desteklenmemektedir!
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

	/******************************************************************************************
	* ENCODE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Zlibli bir dizge oluşturur.				     						  |
	|          																				  |
	******************************************************************************************/
	public function encode($data = '', $level = -1, $encoding = ZLIB_ENCODING_GZIP)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(level) & 3.(encoding)'));	
		}
		
		return zlib_encode($data, $encoding, $level);
	}
	
	/******************************************************************************************
	* DECODE	                                                      	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli bir dizgenin sıkıştırmasını açar.								  |
	|          																				  |
	******************************************************************************************/
	public function decode($data = '', $length = 0)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($length) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(length)'));	
		}
		
		return zlib_decode ($data, $length);
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
	
	public function close()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
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
	
	public function open()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
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
	
	/******************************************************************************************
	* ENCODING TYPE	                                                   	                      *
	*******************************************************************************************
	| Genel Kullanım: Çıktı sıkıştırması için kullanılan kodlama türünü döndürür.			  |
	|          																				  |
	******************************************************************************************/
	public function encodingType()
	{
		return zlib_get_coding_type();
	}
}