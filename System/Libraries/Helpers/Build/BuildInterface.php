<?php
interface BuildInterface
{
	/***********************************************************************************/
	/* BUILD LIBRARY		    		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Build
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: build::, $this->build, zn::$use->build, uselib('build')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/

	/******************************************************************************************
	* XML BUILDER                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Xml belgesi oluşturmak için kullanılır. 								  |
	|																						  |
	| Parametreler: 5 parametresi vardır.                                              		  |
	| 1. array var @element => Eleman ismi.						     	  				  |
	| 4. [ string var @version ] => Oluşturulacak belgenin sürümü. Varsayılan:1.0    		  |
	| 5. [ string var @encoding ] => Oluşturulacak belgenin karakter seti. Varsayılan:utf-8   |
	|																						  |
	******************************************************************************************/	
	public function xml($elements, $version, $encoding);

	/******************************************************************************************
	* SCHEDULE                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Liste oluşturmak için kullanılır. 							     	  |
	  
	  @param array $elements
	  
	  @return string
	|																						  |
	******************************************************************************************/	
	public function schedule($elements);

	/******************************************************************************************
	* TABLE BUILDER                                                                           *
	*******************************************************************************************
	| Genel Kullanım: Tablo oluşturmak için kullanılır. 							     	  |
	
	  @param array $elements
	  @param array $attributes
	  
	  @return string 
	|																						  |
	******************************************************************************************/	
	public function table($elements, $attributes);
}