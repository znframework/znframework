<?php
interface StringsInterface
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
	*  MTRIM                                                                    			  *
	*******************************************************************************************
	| Genel Kullanım: Verideki tüm boşlukları silmek için kullanılır.   	                  |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @str => Boşlukları silinecek veri.			  					          |
	|          																				  |
	| Örnek Kullanım: mtrim(' abc bcd '); // abcbcd         						  		  |
	|          																				  |
	******************************************************************************************/
	public function mtrim($str);

	/******************************************************************************************
	*  TRIM SLASHES                                                               			  *
	*******************************************************************************************
	| Genel Kullanım: Verinin başındaki veya sonundaki / taksim karakterlerini silmek 		  |
	| için kullanılır.   	                  											      |
	|																						  |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @str => Başındaki ve sonundaki / taksim işaretleri temizlenecek olan veri.|
	|          																				  |
	| Örnek Kullanım: trimSlashes('/abc bcd/'); // abc bcd         						  |
	|          																				  |
	******************************************************************************************/
	public function trimSlashes($str);
	
	/******************************************************************************************
	* CASING CONVERTER                                                                        *
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
	| echo casing('Zn Kod Çatısına Hoş'); // Çıktı: zn kod çatısına hoş				  |
	| echo casing('Zn Kod Çatısına Hoş', 'upper'); // Çıktı: ZN KOD ÇATISINA HOŞ	  |
	| echo casing('Zn Kod Çatısına Hoş', 'title'); // Çıktı: Zn Kod Çatısına Hoş	  |
	|       																				  |
	******************************************************************************************/
	public function casing($str, $type, $encoding);

	/******************************************************************************************
	*  UPPERCASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeleri büyük harfe çevirir.   	                  		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Büyük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: upperCase('zntr.net'); // ZNTR.NET         						      |
	|          																				  |
	******************************************************************************************/
	public function upperCase($str, $encoding);

	/******************************************************************************************
	*  LOWERCASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeleri küçük harfe çevirir.   	                  		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: upperCase('ZNTR.NET'); // zntr.net         						      |
	|          																				  |
	******************************************************************************************/
	public function lowerCase($str, $encoding);

	/******************************************************************************************
	*  TITLECASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadelerin sadece ilk harfini büyük harfe çevirir.     		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: titleCase('ZNTR.NET'); // Zntr.net         						      |
	|          																				  |
	******************************************************************************************/
	public function titleCase($str, $encoding);
	
	/******************************************************************************************
	*  CAMELCASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: camelCase tipinde yazı elde etmek için kullanılır.		     		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: camelCase('ZNTR NET'); // zntrNet         						      |
	|          																				  |
	******************************************************************************************/
	public function camelCase($str);	
	
	/******************************************************************************************
	*  PASCAL CASE                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: PascalCase tipinde yazı elde etmek için kullanılır.		     		  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Küçük harfe çevirelecek metin.								      |
	| 2. string var @encoding => Kodlama Türü.		    								      |
	|          																				  |
	| Örnek Kullanım: pascalCase('ZNTR NET'); // zntrNet         						      |
	|          																				  |
	******************************************************************************************/
	public function pascalCase($str);

	/******************************************************************************************
	* SECTION                  	                                                              *
	*******************************************************************************************
	| Genel Kullanım: Dizgenin bir alt dizgesini alır.										  | 
		
	  @param  string  $str 
	  @param  string  $starting
	  @param  numeric $count NULL
	  @param  string  $encoding utf-8 
	  @return string
	|														                                  |
	******************************************************************************************/
	public function section($str, $starting, $count, $encoding);

	/******************************************************************************************
	*  STRING SEARCH                                                              			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeler içinde arama yapmak için kullanılır.     		      |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @str => Arama yapılacak metin.								              |
	| 2. string var @needle => Aranan karakter veya karakterler.		    				  |
	| 3. string var @type => Arama sonucunun türü. 											  |
	| Parametrenin alabileceği değerler: str/string veya pos/position.						  | 
	| 	3.1-str/string: aranan kelime bulunmuş ise bulunan veri döner.				          |
	| 	3.2-pos/position: aranan kelime bulunmuş ise bulunan verinin ilk karakterinin 		  |
	|   indeks numarası döner.   								          					  |
	| 4. string var @case => False ayarlanırsa büyük-küçük harf duyarlılığına bakılmaz.		  |
	|          																				  |
	| Örnek Kullanım: string_search('ZNTR.NET', 'NET'); // NET         						  |
	| Örnek Kullanım: string_search('ZNTR.NET', 'NET', 'pos'); // 5         				  |
	|          																				  |
	******************************************************************************************/
	public function search($str, $needle, $type, $case);

	/******************************************************************************************
	*  STRING RESHUFFLE                                                           			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeler içinde istenilen karaketerleri birbirleri ile 		  |
	| yer değiştirmek için kullanılır.     		      						  			      |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @str => Değişiklik yapılacak metin.								          |
	| 2. string var @shuffle => Yer değiştirilmesi istenen ilk karakter veya karakterler.	  |
	| 3. string var @reshuffle => Yer değiştirilmesi istenen ikinci karakter veya karakterler.|
	|          																				  |
	| Örnek Kullanım: string_reshuffle('ZNTR.NET', '.', 'N'); // Z.TRN.ET         			  |
	|          																				  |
	******************************************************************************************/
	public function reshuffle($str, $shuffle, $reshuffle);	

	/******************************************************************************************
	*  STRING RECURRENT COUNT                                                      			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadelerde tekrarlayan karakter veya karakterlerin 			  |
	| sayısını öğrenmek için kullanılır.     		      						  			  |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @str => Arama yapılacak metin.								         	  |
	| 2. string var @shuffle => Kaç kez tekrar ettiği hesaplanmak istenen karakter veya 	  |
	| karakterler.	  																		  |
	|          																				  |
	| Örnek Kullanım: string_recurrentCount('ZNTR.NET', 'N'); // 2               			  |
	|          																				  |
	******************************************************************************************/
	public function recurrentCount($str, $char);

	/******************************************************************************************
	*  STRING PLACEMENT                                                          			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadeler içinde istenilen karakterlerin yerine başka 		  |
	| karakterler yerleştirmek için kullanılır.     		      						  	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              	      |
	| 1. string var @str => Değişiklik yapılacak metin.								          |
	| 2. string var @delimiter => Hangi karakterin yerine yerleştirme yapılacağı.	  		  |
	| 3. array var @array => Değiştirilmek istenen karakterler yerine sırasıyla hangi 
	| karakterlerin geleceği.	  		  													  |
	|          																				  |
	| Örnek Kullanım: string_recurrentCount('ZNTR.NET', 'N', array('+', '-')); // Z+TR.-ET   |
	|          																				  |
	******************************************************************************************/
	public function placement($str, $delimiter, $array);	
	
	/******************************************************************************************
	* REPLACE                        	                                         			  *
	*******************************************************************************************
	| Genel Kullanım: Bir alt dizgenin bütün örneklerini yenisiyle değiştirir.	           	  |
	  $case parametresinin false olması durumunda harf duyarlılığı dikkate alınmaz.
	
	  @param  string			$string
	  @param  string, array		$oldChar
	  @param  string, array		$newChar
	  @param  bool				$case defaul false
	  @return string
	|          																				  |
	******************************************************************************************/
	public function replace($string, $oldChar, $newChar, $case);
	
	/******************************************************************************************
	* TO ARRAY                                                                       		  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizgeyi bir ayraca göre bölüp bir dizi haline getirir.	          |
	
	  @param  scalar	$string
	  @param  scalar	$string default secure
	  @return string
	|          																				  |
	******************************************************************************************/
	public function toArray($string, $split);
	
	/******************************************************************************************
	* TO CHAR                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Kodu belirtilen karakteri döndürür.   		                  		  |
	
	  @param  int	$ascii
	  @return string
	|          																				  |
	******************************************************************************************/
	public function toChar($ascii);
	
	/******************************************************************************************
	* TO ASCII                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Belitlen karakterin ascii kodunu döndürür.   		                  	  |
	
	  @param  string	$string
	  @return string
	|          																				  |
	******************************************************************************************/
	public function toAscii($string);
	
	/******************************************************************************************
	* ADD SLASHES                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Özel karakterlerin önüne tersbölü yerleştirir.	                  	  |
	
	  @param  string	$string
	  @param  string	$addDifferentChars
	  @return string
	|          																				  |
	******************************************************************************************/
	public function addSlashes($string, $addDifferentChars);
	
	/******************************************************************************************
	* ADD SLASHES                                                                 			  *
	*******************************************************************************************
	| Genel Kullanım: Özel karakterlerin önüne tersbölü yerleştirir.	                  	  |
	
	  @param  string	$string
	  @return string
	|          																				  |
	******************************************************************************************/
	public function removeSlashes($string);
	
	/******************************************************************************************
	* LENGTH                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadenin karakter sayısını döndürür	.	                  	  |
	
	  @param  scalar	$string
	  @return string
	|          																				  |
	******************************************************************************************/
	public function length($string, $encoding);
	
	/******************************************************************************************
	* ENCODE                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Tek yönlü dizge şifrelemesi yapar.	        		 	          	  |
	
	  @param  scalar	$string
	  @param  scalar	$string default secure
	  @return string
	|          																				  |
	******************************************************************************************/
	public function encode($string, $salt);
	
	/******************************************************************************************
	* REPATE                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizgeyi yineler.					        		 	          	  |
	
	  @param  scalar	$string
	  @param  scalar	$string default secure
	  @return string
	|          																				  |
	******************************************************************************************/
	public function repeat($string, $count);
	
	/******************************************************************************************
	* TRANSLATION TABLE                                                           			  *
	*******************************************************************************************
	| Genel Kullanım: htmlentities() tarafından kullanılan dönüşüm tablosunu döndürür.	      |
	
	  @param  numeric	$table  default specialchars -> entities, specialchars
	  @param  numeric	$string default compat       -> compat, quotes, nonquotes
	  @return array
	|          																				  |
	******************************************************************************************/
	public function translationTable($table, $quote);
}