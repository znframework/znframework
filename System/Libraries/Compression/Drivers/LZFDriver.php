<?php
class LZFDriver
{
	/***********************************************************************************/
	/* LZF LIBRARY							                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: LZF
	/* Sınıf Versiyon: PECL lzf >= 0.1.0
	/* ZN Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: LZF::, $this->LZF, zn::$use->LZF, uselib('LZF')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	public function __construct()
	{
		if( ! function_exists('lzf_compress') )
		{
			die(getErrorMessage('Error', 'undefinedFunctionExtension', 'LZF'));	
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
	
	/******************************************************************************************
	* COMPRESS		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: LZF sıkıştırma işlemi.			     	 							  |
	|          																				  |
	******************************************************************************************/
	public function compress($data = '')
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		return lzf_compress($data);
	}
	
	/******************************************************************************************
	* UNCOMPRESS	                                                                          *
	*******************************************************************************************
	| Genel Kullanım: LZF sıkıştırmasını açma işlemi.								     	  |
	|          																				  |
	******************************************************************************************/
	public function uncompress($data = '', $small = 0)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}

		return lzf_decompress($data);
	}
	
	/******************************************************************************************
	* OPTIMIZED FOR	                                                                          *
	*******************************************************************************************
	| Genel Kullanım: LZF eklentisinin neye göre en iyilendirildiğini bildirir.		    	  |
	|          																				  |
	******************************************************************************************/
	public function optimizedFor()
	{
		return lzf_optimized_for();
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
	
	public function encodingType()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
}