<?php
namespace ZN\Cryptography;

class InternalEncode implements EncodeInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $driver
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		$this->config();	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Config Method
	//----------------------------------------------------------------------------------------------------
	// 
	// config()
	//
	//----------------------------------------------------------------------------------------------------
	use \ConfigMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Encode Method
	//----------------------------------------------------------------------------------------------------
	// 
	// encode()
	//
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Rastgele şifre oluşturmak için kullanılır.						      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @count => Şifrenin karakter uzunluğu. Varsayılan:6						  |
	| 1. string var @chars => Şifrelemede hangi karakterlerin kullanılacağı. Varsayılan:all	  |
	|          																				  |
	| Örnek Kullanım: create(5);        									                  |
	|          																				  |
	******************************************************************************************/
	public function create($count = 6, $chars = 'all')
	{
		// Parametre numeric yani sayısal veri içermelidir.
		if( ! is_numeric($count) ) 
		{
			$count = 6;
		}
		
		if( ! is_string($chars) ) 
		{
			$chars = "all";
		}
		
		$password = '';
		
		// Şifreleme için kullanılacak karakter listesi.
		if( $chars === "all" || $chars === 'alnum' ) 
		{
			$characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		}
		if( $chars === "numeric" ) 
		{
			$characters = "1234567890";
		}
		if( $chars === "string" || $chars === "alpha" )
		{ 
			$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		}
		
		// Parametre olarak belirtilen sayı kadar karakter
		// listesinden karakterler seçilerek
		// rastgele şifre oluşturulur.
		for( $i = 0; $i < $count; $i++ )
		{
			$password .= substr( $characters, rand( 0, strlen($characters)), 1 );	
		}
		
		return $password;
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Type Methods
	//----------------------------------------------------------------------------------------------------
	// 
	// golden()
	// super()
	// type()
	// data()
	//
	//----------------------------------------------------------------------------------------------------
	
	/******************************************************************************************
	* GOLDEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Şifreleme yapmak için kullanılır. md5 şifreleme yöntemini kullanır.	  |
	| ama bu şifrelemenin adının altın olmasın sebebi şifreye ek belirtmenizdir. Böylece	  |
	| aynı veri için farklı şifrlemeler yapabilirsiniz.									      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string/numeric var @data => Şifrelenecek veri.						  			      |
	| 2. string/numeric var @additional => Şifrelenecek veriye eklenecek veri.        	      |
	|          																				  |
	| Örnek Kullanım: golden('data', 'extra1');        									      |
	| Örnek Kullanım: golden('data', 'extra2');  											  |
	|																						  |
	| Yukarıdaki kullanımların çıktıları birbirinden farklı olacaktır.      				  |
	|          																				  |
	******************************************************************************************/
	public function golden($data = '', $additional = 'default')
	{
		if( ! is_scalar($data) || empty($data) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'data');
		}
		
		if( ! is_scalar($additional) )
		{
			$additional = 'default';
		}
	
		$algo = $this->config['type'];
		
		if( ! isHash($algo) )
		{
			$algo = 'md5';	
		}
		// Ek veri şifreleniyor.
		
		$additional = hash($algo, $additional);
		
		// Veri şifreleniyor.
		$data = hash($algo, $data);
		
		// Veri ve ek yeniden şifreleniyor.
		return hash($algo, $data.$additional);

		
	}	
	
	/******************************************************************************************
	* SUPER                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Şifreleme yapmak için kullanılır. md5 şifreleme yöntemini kullanır.	  |
	| ama bu şifrelemenin adının süper olmasın sebebi şifreye eki harici bir dosyadan         |
	| belirtmenizdir. Böylece aynı veri için farklı şifrlemeler yapabilirsiniz.				  |
	|															                              |
	| Parametreler: 1 parametresi vardır.                                                     |
	| 1. string/numeric var @data => Şifrelenecek veri.						  			      |
	|          																				  |
	| Örnek Kullanım: super('data', 'extra1');        									      |
	|																						  |
	| Not:Şifre eki Config/Encode.php dosyasında yer alan proje anahtarı bölümündedir.   	  |
	|          																				  |
	******************************************************************************************/
	public function super($data = '')
	{
		if( ! is_scalar($data) || empty($data) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'data');
		}
		
		$projectKey = $this->config['projectKey'];
		
		$algo = $this->config['type'];
		
		if( ! isHash($algo) )
		{
			$algo = 'md5';	
		}
		
		// Proje Anahatarı belirtizme bu veri yerine
		// Proje anahtarı olarak sitenin host adresi
		// eklenecek ek veri kabul edilir.
		if( empty($projectKey) ) 
		{
			$additional = hash($algo, host()); 
		}
		else 
		{
			$additional = hash($algo, $projectKey);
		}
		
		// Veri şifreleniyor.
		$data = hash($algo, $data);
		
		// Veri ve ek yeniden şifreleniyor.
		return hash($algo, $data.$additional);

	}
	
	/******************************************************************************************
	* DATA                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veriyi istenilen şifreleme algoritmasına göre şifrelemek içindir.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string/numeric var @data => Şifrelenecek veri.						  			      |
	| 3. string var @type => Şifreleme Türü. Varsayılan:md5						  			  |
	|          																				  |
	| Örnek Kullanım: type('data', 'sha1');        									          |
	|																						  |
	| Not:Şifreleme türünüz geçerli şifreleme algoritması olmak zorundadır. 			  	  |
	|          																				  |
	******************************************************************************************/
	public function data($data = '', $type = 'md5')
	{
		if( ! is_scalar($data) )
		{
			return  \Errors::set('Error', 'scalarParameter', '1.(data)');
		}
		
		$algos = ['golden', 'super'];
		
		if( ! isHash($type) && ! in_array($type, $algos) )
		{
			return \Errors::set('Error', 'hashParameter', '2.(type)');	
		}
		
		if( in_array($type, $algos) )
		{
			return \Encode::$type($data);	
		}
		
		return hash($type, $data);
	}
	
	/******************************************************************************************
	* TYPE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Veriyi istenilen şifreleme algoritmasına göre şifrelemek içindir.		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string/numeric var @data => Şifrelenecek veri.						  			      |
	| 3. string var @type => Şifreleme Türü. Varsayılan:md5						  			  |
	|          																				  |
	| Örnek Kullanım: type('data', 'sha1');        									          |
	|																						  |
	| Not:Şifreleme türünüz geçerli şifreleme algoritması olmak zorundadır. 			  	  |
	|          																				  |
	******************************************************************************************/
	public function type($data = '', $type = 'md5')
	{
		return $this->data($data, $type);
	}
}