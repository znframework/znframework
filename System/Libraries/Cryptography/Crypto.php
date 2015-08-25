<?php
class __USE_STATIC_ACCESS__Crypto
{
	/***********************************************************************************/
	/* ENCODE LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Encode
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: encode::, $this->encode, zn::$use->encode, uselib('encode')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* 
	 * Sürücü bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 * @var object
	 */
	protected $crypto;
	
	public function __construct($driver = '')
	{
		$this->crypto = Driver::run('Encode', $driver);
	}
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Crypto::$method()"));	
	}
	
	/******************************************************************************************
	* ENCRYPT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Dizgeyi şifreler.										 		          |
	
	  @param string $data
	  @param array  $settings -> cipher, key, mode, iv
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function encrypt($data = '',  $settings = array())
	{
		if( ! is_scalar($data) )
		{
			return Error::set(lang('Error', 'scalarParameter', '1.(data)'));	
		}
		
		if( ! is_array($settings) )
		{
			return Error::set(lang('Error', 'arrayParameter', '2.(settings)'));	
		}
		
		return $this->crypto->encrypt($data,  $settings);
	}
	
	/******************************************************************************************
	* DECRYPT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Şifrelenmiş dizgeyi çözer.							 		          |
	
	  @param string $data
	  @param array  $settings -> cipher, key, mode, iv
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function decrypt($data = '', $settings = array())
	{
		if( ! is_scalar($data) )
		{
			return Error::set(lang('Error', 'scalarParameter', '1.(data)'));	
		}
		
		if( ! is_array($settings) )
		{
			return Error::set(lang('Error', 'arrayParameter', '2.(settings)'));	
		}
		
		return $this->crypto->decrypt($data,  $settings);
	}
	
	/******************************************************************************************
	* KEYGEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen uzunlukta anahtar oluşturur.				 		          |
	
	  @param string $length = 8
	  
	  @return string
	|          																				  |
	******************************************************************************************/
	public function keygen($length = 8)
	{
		if( ! is_numeric($length) )
		{
			return Error::set(lang('Error', 'numericParameter', '1.(length)'));	
		}
		
		return $this->crypto->keygen($length);
	}
	
	/******************************************************************************************
	* DIFFERENT DRIVER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Farklı sürücüleri aynı anda kullanmak için kullanılır. 		          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @driver => Farklı olarak kullanılacak sürücü.							  |
	|																						  |
	| Örnek Kullanım: ->diver('mcrypt');			                 		     			  |
	|          																				  |
	******************************************************************************************/
	public function driver($driver = '')
	{
		return new self($driver);
	}
}