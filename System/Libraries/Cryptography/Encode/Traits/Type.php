<?php
trait EncodeTypeMethodsTrait
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
			return Error::set(lang('Error', 'valueParameter', 'data'));
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
			return Error::set(lang('Error', 'valueParameter', 'data'));
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
			return Error::set(lang('Error', 'scalarParameter', '1.(data)'));
		}
		
		if( ! isHash($type) )
		{
			return Error::set(lang('Error', 'hashParameter', '2.(type)'));	
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