<?php
trait EncodeCreateMethodTrait
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
		
		$password   	= '';
		
		// Şifreleme için kullanılacak karakter listesi.
		if( $chars === "all" ) 
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
}