<?php
namespace ZN\Helpers;

interface ConvertInterface
{
	/***********************************************************************************/
	/* CONVERT LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: Convert
	/* Versiyon: 1.4
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: convert::, $this->convert, zn::$use->convert, uselib('convert')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	//----------------------------------------------------------------------------------------------------
	// anchor
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $data
	// @param string $type: short, long
	// @param array  $attributes
	//
	//----------------------------------------------------------------------------------------------------
	public function anchor($data, $type, $attributes);
	
	/******************************************************************************************
	* CHAR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Karakterleri bir türden diğer türe dönüştürmek için kullanılır. 		  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @type ] => Hangi türden dönüşüm yapılacağı. Varsayılan:char			  |
	| 3. [ string var @change_type ] => Hangi türe dönüşüm yapılacağı. Varsayılan:html		  |
	|   																					  |
	| Dönüştürülebilecek türler => char, html, dex, hex										  |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo char('Metin'); // Kaynak Kod Çıktı: &#77;&#101;&#116;&#105;&#110; 		  		  |
	| echo char('Metin', 'char', 'dec'); // Çıktı: 77 101 116 105 110 			  			  |
	| echo char('Metin', 'char', 'hex'); // Çıktı: 4D 65 74 69 6E 				  			  |
	|																						  |
	| Kendi Aralarında Dönüştürme														      |
	| $html = char('Metin');														  		  |
	| $dec = char('Metin', 'char', 'dec');										  			  |
	| $hex = char('Metin', 'char', 'hex');										  			  |
	|																						  |
	| echo char($hex, 'hex', 'char'); // Çıktı: Metin								  		  |
	| echo char($dec, 'dec', 'hex'); // Çıktı: 4D 65 74 69 6E					     	 	  |
	| echo char($html, 'html', 'dec'); // Çıktı: 77 101 116 105 110                 		  |	
	|       																				  |
	******************************************************************************************/
	public function char($string, $type, $changeType);

	/******************************************************************************************
	* ACCENT CONVERTER                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Yabancı içerikli karaketerleri standart karakterlere dönüştürür. 		  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo accent_converter('Åķŝǻň'); // Çıktı: Aksan 										  |
	|       																				  |
	******************************************************************************************/
	public function accent($str);

	/******************************************************************************************
	* URL WORD CONVERTER                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Yabancı karaketer içerikli metni url yapısına uygun hale dönüştürür 	  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 1. [ string var @splitword ] => Kelimeler arasına konacak işaret. Varsayılan:-		  |
	|       																				  |
	| Örnek Kullanım:  																	      |
	| echo url_word_converter('Zn Kod Çatısına Hoş'); // zn-kod-catisina-hos 				  |
	| echo url_word_converter('Zn Kod Çatısına Hoş', '/'); //  zn/kod/catisina/hos			  |
	|       																				  |
	******************************************************************************************/
	public function urlWord($str, $splitWord);

	/******************************************************************************************
	* ARRAY CASE -> V2 - TEMMUZ GÜNCELLEMESİ                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Küçük büyük harf dönüştürmeleri yapmak için kullanılır.			  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @type ] => Dönüşümün tipi. Varsayılan:lower					     	  |
	| 3. [ string var @encoding ] => Dönüşümün karakter seti. Varsayılan:utf-8				  |
	|       																				  |
	| Kullanılabilir Dönüşüm Tipleri: lower, upper, title   								  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş'); // Çıktı: zn kod çatısına hoş				  |
	| echo case_converter('Zn Kod Çatısına Hoş', 'upper'); // Çıktı: ZN KOD ÇATISINA HOŞ	  |
	| echo case_converter('Zn Kod Çatısına Hoş', 'title'); // Çıktı: Zn Kod Çatısına Hoş	  |
	|       																				  |
	******************************************************************************************/
	public function stringCase($str, $type, $encoding);	
	
	/******************************************************************************************
	* ARRAY CASE -> V2 - TEMMUZ GÜNCELLEMESİ                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizi anahtar ve değerlerinde harf dönüşümü yapmak için kullanılır .     |
	
	  @param array  $array
	  @param string $type lower, upper, title
	  @param string $keyval all, key, val/value
	|																						  |
	******************************************************************************************/
	public function arrayCase($array, $type, $keyval);
	
	/******************************************************************************************
	* CHARSET CONVERTER                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Küçük büyük harf dönüştürmeleri yapmak için kullanılır.			  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ string var @from_charset ] => Hangi karakter setinden. Varsayılan:utf-8			  |
	| 3. [ string var @to_charset ] => Hangi karakter setine. Varsayılan:utf-8				  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş', 'latin5', 'urtf-8');                         |
	|       																				  |
	******************************************************************************************/
	public function charset($str, $fromCharset, $toCharset);
	
	/******************************************************************************************
	* HIGH LIGHT                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Girilen metinsel kodun yazı biçimini ve renkleri ayarlamak içindir.	  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @string => Dönüştürülecek metin.				                          |
	| 2. [ array var @settings ] => Renk ve yazı ayarları.									  |
	|																						  |
	| Örnek Kullanım: highLight('echo 1;');  											  	  |
	|       																				  |
	******************************************************************************************/
	public function highLight($str, $settings);
	
	/******************************************************************************************
	* TO INT			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü int türüne çevirmek için kullanılır.			  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toInt($var);
	
	/******************************************************************************************
	* TO INTEGER			                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü int türüne çevirmek için kullanılır.			  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toInteger($var);
	
	/******************************************************************************************
	* TO BOOL			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü boolean türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toBool($var);
	
	/******************************************************************************************
	* TO BOOLEAN    	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü boolean türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toBoolean($var);
	
	/******************************************************************************************
	* TO STRING      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü string türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toString($var);
	
	/******************************************************************************************
	* TO FLOAT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü float türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toFloat($var);
	
	/******************************************************************************************
	* TO REAL        	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü real türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toReal($var);
	
	/******************************************************************************************
	* TO DOUBLE      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü double türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toDouble($var);
	
	/******************************************************************************************
	* TO OBJECT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü object türüne çevirmek için kullanılır.		  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toObject($var);
	
	/******************************************************************************************
	* TO ARRAY      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü array türüne çevirmek için kullanılır.		      |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	|       																				  |
	******************************************************************************************/
	public function toArray($var);
	
	/******************************************************************************************
	* TO UNSET      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkeni silmek için kullanılır.		  								  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Silinecek değişken.				                         	  	  |
	|       																				  |
	******************************************************************************************/
	public function toUnset($var);
	
	/******************************************************************************************
	* TO CONSTANT      	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: String ifadeyi contant türüne çevirmek için kullanılır.				  |	
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. var var @var => Çevrilecek değişken.				                         	  	  |
	|       																				  |
	******************************************************************************************/
	public function toConstant($var, $prefix, $suffix);
	
	/******************************************************************************************
	* VAR TYPE			                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Değişkenin veri türünü değiştirmek için kullanılır.			  	  	  |	
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. var var @var => Dönüştürülecek değişken.				                         	  |
	| 2. [ string var @type ] => Hangi türe. Varsayılan:int									  |
	|																						  |
	| Örnek Kullanım:  																	      |
	| echo case_converter('Zn Kod Çatısına Hoş', 'latin5', 'urtf-8');                         |
	|       																				  |
	******************************************************************************************/
	public function varType($var, $type);
}