<?php
namespace ZN\Services;

interface CookieInterface
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
	* TIME                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak çerezin süresini belirtmek için kullanılır.               |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @time => Çerezin ne kadar süre ile kalacağı.					          |
	|          																				  |
	| Örnek Kullanım: ->time(3600) // 1 saat. 										          |
	|          																				  |
	******************************************************************************************/
	public function time($time);
	
	/******************************************************************************************
	* PATH                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Çerezlerin oluşturulacağı dizini belirlemek için kullanılır.	          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @path => Dizinin var olacağı dizin yolu. Varsayılan:/                     |
	|          																				  |
	| Örnek Kullanım: ->path('cerezler/')										              |
	|          																				  |
	******************************************************************************************/
	public function path($path);
	
	/******************************************************************************************
	* PATH                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Çerezlerin kullanılabilir olacağı domaini belirtmek için kullanılır.    |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @domain => Domain ismi.                   								  |
	|          																				  |
	| Örnek Kullanım: ->domain('http://www.zntr.net')										  |
	|          																				  |
	******************************************************************************************/
	public function domain($domain);
	
	/******************************************************************************************
	* SECURE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Çerezler için https bağlantısının kullanılıp kullanılmayacağıdır.       |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @secure => True olarak ayarlanması durumunda sadece https bağlantısı	  |
	| için geçerli olacaktır. Varsayılan:false                  							  |
	|          																				  |
	| Örnek Kullanım: ->secure(true)										 				  |
	|          																				  |
	******************************************************************************************/
	public function secure($secure);
	
	/******************************************************************************************
	* HTTP ONLY                                                                               *
	*******************************************************************************************
	| Genel Kullanım: TRUE olduğu takdirde çerez sadece HTTP protokolü üzerinden erişilebilir |
    | olacaktır.       																		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @httponly => True olarak ayarlanması durumunda sadece http protokülü	  |
	| için geçerli olacaktır. Varsayılan:true                    							  |
	|          																				  |
	| Örnek Kullanım: ->httpOnly(true)										 				  |
	|          																				  |
	******************************************************************************************/
	public function httpOnly($httpOnly);
}