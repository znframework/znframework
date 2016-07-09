<?php 
namespace ZN\Helpers;

interface SeparatorInterface
{
	/***********************************************************************************/
	/* JSON LIBRARY	     					                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Seperator
	/* Versiyon: 2.0 Eylül Güncellemesi
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Seperator::, $this->Seperator, zn::$use->Seperator, uselib('Seperator')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* ENCODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen ayraçlara göre diziyi özel bir veri tipine çeviriyor.        |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. array var @data => Özel veriye çevrilecek dizi parametresi.        	  			  |
	| 2. [ string var @key ] => Anahtar değer ayracı. Varsayılan:+-?||?-+	                  |
	| 3. [ string var @seperator ] => Parametre ayracı. Varsayılan:|?-++-?|	                  |
	|          																				  |
	| Örnek Kullanım: encode(array(1 => 1, 2 => 2));        	  					          |
	| // 1+-?||?-+1|?-++-?|2+-?||?-+2     													  |
	|          																				  |
	******************************************************************************************/	
	public function encode($data, $key, $seperator);
	
	/******************************************************************************************
	* DECODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Özel veriyi Object veri türüne çevirir.        						  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. array var @data => Object veri türüne çevrilecek özel veri.        	  			  |
	| 2. [ string var @key ] => Anahtar değer ayracı. Varsayılan:+-?||?-+	                  |
	| 3. [ string var @seperator ] => Parametre ayracı. Varsayılan:|?-++-?|	                  |
	|          																				  |
	| Örnek Kullanım: decode('1+-?||?-+1|?-++-?|2+-?||?-+2 ');        	  					  |
	| //  (object)array(1 => 1, 2 => 2)   													  |
	|          																				  |
	******************************************************************************************/	
	public function decode($word, $key, $seperator);
}