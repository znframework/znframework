<?php
class Controller
{
	/***********************************************************************************/
	/* CONTROLLER LIBRARY	     			                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Controller
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Controllers/ sınıflarına extends edilerek kullanılır
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CONSTRUCT                                                                               *
	*******************************************************************************************
	| Nesnelere $this nesnesi ile erişmek için kullanılmaktadır.							  |
	| 																						  |
	******************************************************************************************/	
	public function __construct()
	{
		// ---------------------------------------------------------------------
		// Eğer çalışılan sayfada __construct yapıcısı kullanılırsa 
		// Conroller sınıfının sağlıklı çalışması için bu yöntemin için
		// parent::__construct() kodu ilave edilerek Conroller->__construct()
		// yönteminin çalışması sağlanır.
		// ---------------------------------------------------------------------
		zn::$use =& $this;
		// ---------------------------------------------------------------------
	}
		
	/******************************************************************************************
	* GET                                                                                     *
	*******************************************************************************************
	| Nesnelere $this nesnesi ile sınıflara erişmek için kullanılmaktadır.					  |
	| 																						  |
	******************************************************************************************/	
	public function __get($class)
	{
		// ---------------------------------------------------------------------
		// Nesnenin tanımlanmamış ise tanımlanmasını sağla.
		// ---------------------------------------------------------------------
		if( ! isset($this->$class) )
		{
			// Sınıf Tanımlaması Yapılıyor.
			$this->$class = uselib($class);	
			return $this->$class ;
		}
		// ---------------------------------------------------------------------
	}
}