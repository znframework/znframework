<?php
class GZDriver
{
	/***********************************************************************************/
	/* GZ LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: GZ
	/* Sınıf Versiyon: PHP 4, PHP 5
	/* ZN Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Mixed
	/* Dahil Edilme: Gerektirmez
	/* Erişim: GZ::, $this->GZ, zn::$use->GZ, uselib('GZ')
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
	public function write($file = '', $data = '', $mode = 'w')
	{
		if( ! is_string($file) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(file)'));	
		}
		
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '2.(data)'));	
		}
		
		$open = gzopen($file, $mode);
		
		if( empty($open) )
		{
			return Error::set(lang('Error', 'fileNotFound', $file));	
		}
		
		$return = gzwrite($open, $data, strlen($data));
		
		gzclose($open);
		
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
		
		return gzwrite($zp, $data, $length);
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
		
		if( ! is_numeric($length) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(length)'));	
		}
		
		$open = gzopen($file, $mode);
		
		if( empty($open) )
		{
			return Error::set(lang('Error', 'fileNotFound', $file));	
		}
		
		$return = gzread($open, $length);
		
		gzclose($open);
		
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
		
		return gzread($zp, $length);
	}
	
	/******************************************************************************************
	* COMPRESS		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Verilen dizgeyi gz kodlamalı olarak sıkıştırır.				     	  |
	|          																				  |
	******************************************************************************************/
	public function compress($data = '', $level = -1, $encoding = ZLIB_ENCODING_DEFLATE)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(level) & 3.(encoding)'));	
		}
		
		return gzcompress($data, $level, $encoding);
	}
	
	/******************************************************************************************
	* UNCOMPRESS	                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Gz ile sıkıştırılmış veriyi açar.								     	  |
	|          																				  |
	******************************************************************************************/
	public function uncompress($data = '', $length = 0)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($length) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(length)'));	
		}
		
		return gzuncompress($data, $length);
	}
	
	public function optimizedFor()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;
	}
	
	/******************************************************************************************
	* ENCODE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Gzipli bir dizge oluşturur.				     						  |
	|          																				  |
	******************************************************************************************/
	public function encode($data = '', $level = -1, $encoding = FORCE_GZIP)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(level) & 3.(encoding)'));	
		}
		
		return gzencode($data, $level, $encoding);
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
		
		return gzdecode($data, $length);
	}
	
	/******************************************************************************************
	* DEFLATE		                                                                          *
	*******************************************************************************************
	| Genel Kullanım: Bir dizgeyi deflate biçeminde sıkıştırır.								  |
	|          																				  |
	******************************************************************************************/
	public function deflate($data = '', $level = -1, $encoding = ZLIB_ENCODING_RAW)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($level) || ! is_numeric($encoding) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(level) & 3.(encoding)'));	
		}
		
		return gzdeflate($data, $level, $encoding);
	}
	
	/******************************************************************************************
	* INFLATE	                                                      	                      *
	*******************************************************************************************
	| Genel Kullanım: Deflate bir dizgenin sıkıştırmasını açar.								  |
	|          																				  |
	******************************************************************************************/
	public function inflate($data = '', $length = 0)
	{
		if( ! isValue($data) )
		{
			return Error::set(lang('Error', 'valueParameter', '1.(data)'));	
		}
		
		if( ! is_numeric($length) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(length)'));	
		}
		
		return gzinflate($data, $length);
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
		
		return gzclose($zp);
	}
	
	/******************************************************************************************
	* END OF LINE                                                     	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya tanıtıcında dosya sonunu sınar.							  |
	|          																				  |
	******************************************************************************************/
	public function eof($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gzeof($zp);
	}
	
	/******************************************************************************************
	* FILE                                                          	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosyayı bir dizi içinde döndürür.								  |
	|          																				  |
	******************************************************************************************/
	public function file($zp = '', $includePath = 0)
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gzfile($zp, $includePath);
	}
	
	/******************************************************************************************
	* GET CHAR                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya göstericisindeki karakteri döndürür.						  |
	|          																				  |
	******************************************************************************************/
	public function getChar($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gzgetc($zp);
	}
	
	/******************************************************************************************
	* GET LINE                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya tanıtıcısından bir satır döndürür.						  |
	|          																				  |
	******************************************************************************************/
	public function getLine($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gzgets($zp);
	}
	
	/******************************************************************************************
	* GET LINE                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya tanıtıcısından bir satır okuyup HTML etikelerini siler.	  |
	|          																				  |
	******************************************************************************************/
	public function getCleanLine($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gzgetss($zp);
	}
	
	/******************************************************************************************
	* OPEN	                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Bir gzipli dosya açar.												  |
	|          																				  |
	******************************************************************************************/
	public function open($filename = '', $mode = '', $includePath = 0)
	{
		if( ! is_string($filename) || ! is_string($mode) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(filename) & 2.(mode)'));	
		}
		
		return gzopen($filename, $mode, $includePath);
	}
	
	/******************************************************************************************
	* PASS THRU                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya tanıtıcısında kalan verinin tamamını çıktılar.			  |
	|          																				  |
	******************************************************************************************/
	public function passThru($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gzpassthru($zp);
	}
	
	/******************************************************************************************
	* REWIND                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya göstericisini dosya başlangıcına taşır.			  |
	|          																				  |
	******************************************************************************************/
	public function rewind($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gzrewind($zp);
	}
	
	/******************************************************************************************
	* SEEK	                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya göstericisini konumlar.									  |
	|          																				  |
	******************************************************************************************/
	public function seek($zp = '', $offset = 0, $whence = SEEK_SET)
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		if( ! is_numeric($offset) )
		{
			return Error::set(lang('Error', 'numericParameter', '2.(offset)'));	
		}
		
		return gzseek($zp, $offset, $whence);
	}
	
	/******************************************************************************************
	* TELL                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya tanıtıcısının okuma/yazma konumunu döndürür.				  |
	|          																				  |
	******************************************************************************************/
	public function tell($zp = '')
	{
		if( ! is_resource($zp) )
		{
			return Error::set(lang('Error', 'resourceParameter', '1.(zp)'));	
		}
		
		return gztell($zp);
	}
	
	/******************************************************************************************
	* READ FILE                                                        	                      *
	*******************************************************************************************
	| Genel Kullanım: Gzipli dosya tanıtıcısının okuma/yazma konumunu döndürür.				  |
	|          																				  |
	******************************************************************************************/
	public function readFile($fileName = '', $includePath = 0)
	{
		if( ! is_string($fileName) )
		{
			return Error::set(lang('Error', 'stringParameter', '1.(fileName)'));	
		}
		
		return readgzfile($fileName, $includePath);
	}
	
	public function encodingType()
	{
		// Bu sürücü tarafından desteklenmemektedir!
		return false;	
	}
}