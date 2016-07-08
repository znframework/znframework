<?php
namespace ZN\Helpers;

interface SearchInterface
{
	/***********************************************************************************/
	/* SEARCH LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Search
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: search::, $this->search, zn::$use->search, uselib('search')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* FILTER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Aramaya filtre uygulamak için kullanılır.                               |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @column => Filtre uygulanacak sütun ve operatör bilgisi.                  |
	| 2. string var @value  => Belirlenen sütunda filtrelenecek veri.                   	  |
	|          																				  |
	| Örnek Kullanım: filter('yas >', 15);        	  			  							  |
	| // where yas > 15         														      |
	|          																				  |
	| ÇOKLU FİLTRELEME         																  |
	| [VE] bağlacı ile yapılmak isteniyorsa filter() yöntemini kullanılır.        			  |
	| [VEYA] bağlacı ile yapılmak isteniyorsa orFilter() yöntemini kullanılır.        		  |
	|          																				  |
	******************************************************************************************/	
	public function filter($column, $value);
	
	/******************************************************************************************
	* OR FILTER                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Aramaya birden fazla filtre uygulanacağı zamana ve kullanımda veya      |
	| bağlacı tercih edileceği zaman kullanılır.                                              |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @column => Filtre uygulanacak sütun ve operatör bilgisi.                  |
	| 2. string var @value  => Belirlenen sütunda filtrelenecek veri.                   	  |
	|          																				  |
	| Örnek Kullanım: orFilter('yas >', 15);        	  			  						  |
	| // or where yas > 15         														      |
	|          																				  |
	******************************************************************************************/	
	public function orFilter($column, $value);
	
	/******************************************************************************************
	* WORD                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Aranacak kelime veya data.                                              |
	
	  @var string $word: aranacak kelime
	  
	  @return $this
	|          																				  |
	******************************************************************************************/	
	public function word($word);
	
	/******************************************************************************************
	* TYPE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Aranacak türü.          				                                  |
	
	  @var string $type: arama türü
	  
	  @return $this
	|          																				  |
	******************************************************************************************/	
	public function type($type);
	
	/******************************************************************************************
	* GET                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Arama işlemini başlatır ve sonucu çıktılar.                             |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. array var @conditions => Arama yapılacak tablo adı ve tabloya ait sütun dizisidir.   |
	| 2. string var @word  => Belirtilen tablo ve sütunlarda aranacak veri.                   |
	| 3. string var @type  => Aranan kelimenin içinde geçen, ile başlayan ve ile biten durumu.|
	|          																				  |
	| Örnek Kullanım: 																		  |
	| get(																					  |	
	|	  array																				  |
	|	  (																					  |
	|		   'table1' => array('column1','column2') , 									  |
	|		   'table2' => array('column1','column2')										  |	
	|     ) 																			      |
	| );        	  			  							  						          |
	|          																				  |
	| 3. TYPE Parametresi 5 farklı değer alabilir        									  |
	| inside, starting, ending, equal, auto 												  |
	|          																				  |
	******************************************************************************************/	
	public function get($conditions, $word, $type);
	
	// Function: data()
	// İşlev: Dizilerde ve metinsel ifadeler arama yapmak için kullanılır.
	// Parametreler
	// @search_data = Aranacak olan metin veya dizi.
	// @search_word = Aranacak olan karakter veya karakterler
	// @output = Arama sonucu türü. Parametrenin alabileceği değerler: bool, boolean, pos, position
	// 1- bool/boolean sonucun bulunuduğunu yada bulunmadığını gösteren true veya false değeri döndürür.
	// 2- pos/position sonuc bulunmuş ise bulunan bilginin başlangıç indeks numarasını bulunmamış ise -1 değerini döndürür.
	// Dönen Değer: Arama sonucu.
	public function data($searchData, $searchWord, $output);
}