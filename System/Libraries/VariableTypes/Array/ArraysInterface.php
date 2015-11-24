<?php	
interface ArraysInterface
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
	* ARRAY POS CHANGE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: Herhangi bir dizi indeksini, istenilen başka bir dizi indeksine 		  |
	| eklemeye yarar.  															              |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      |
	| 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.|
	|																						  |
	******************************************************************************************/	
	public function posChange($array, $poss, $changePos);

	
	/******************************************************************************************
	* ARRAY POS REVERSE                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Dizi elementlarını kendi içlerinde yer değiştirmek için kullanılır. 	  |
	|																						  |
	| Parametreler: 3 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string/numeric var @poss => Yerleştirme işlemi yapılacak elemanın indeksi.		      |
	| 3. string/numeric var @change_pos => Yerleştirme işlemi yapılacağı yeni indeks numarası.|
	|          																				  |
	******************************************************************************************/
	public function posReverse($array, $poss, $changePos);
	
	/******************************************************************************************
	* ARRAY CASE -> V2 - TEMMUZ GÜNCELLEMESİ                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinnin . 	                          								  |
	|																						  |
	******************************************************************************************/
	public function casing($array, $type, $keyval);
	
	/******************************************************************************************
	* REMOVE LAST -> V2 - EYLÜL GÜNCELLEMESİ                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin son kaldırmak silmek için kullanılır.							  |
	|																						  |
	******************************************************************************************/
	public function removeLast($array, $count);
	
	/******************************************************************************************
	* REMOVE FIRST -> V2 - EYLÜL GÜNCELLEMESİ                                                 *
	*******************************************************************************************
	| Genel Kullanım: Dizinin ilk elemanını kaldırmak için kullanılır.						  |
	|																						  |
	******************************************************************************************/
	public function removeFirst($array, $count);
	
	/******************************************************************************************
	* ADD FIRST -> V2 - EYLÜL GÜNCELLEMESİ                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dizinin başına elaman ekleme için kullanılır.							  |
	|																						  |
	******************************************************************************************/
	public function addFirst($array, $element);
	
	/******************************************************************************************
	* ADD LAST -> V2 - EYLÜL GÜNCELLEMESİ                                                     *
	*******************************************************************************************
	| Genel Kullanım: Dizinin sonuna elaman ekleme için kullanılır.							  |
	|																						  |
	******************************************************************************************/
	public function addLast($array, $element);
	
	/******************************************************************************************
	* ARRAY DELETE ELEMENT                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Diziden istenilen eleman veya elamanları silmek için kullanılır. 	      |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. mixed var @object => Silinecek eleman.		                              |
	|          																				  |
	******************************************************************************************/
	public function deleteElement($array, $object);
	
	/******************************************************************************************
	* MULTI KEY ARRAY                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Çoklu anahtar oluşturmak için kullanılır. 	                          |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string var @key_split => Çoklu anahtarları ayır edecek ayraç bilgisi. Varsayılan:|   |
	|          																				  |
	******************************************************************************************/
	public function multikey($array, $keySplit);
	
	/******************************************************************************************
	* ARRAY KEYVAL                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin anahtarını yada değerini elde etmek için kullanılır. 	      |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	| 2. string var @keyval => Öğrenilmek istenen bilgi. Varsayılan:val                       |
	|          																				  |
	******************************************************************************************/
	public function keyval($array, $keyval);
		
	/******************************************************************************************
	* GET LAST		                             			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin son elemanını döndürür.										  |
	
	  @param 	array   $array
	  @param 	numeric $count
	  @param	bool	$preserverKey
	  @return 	string, array
	|          																				  |
	******************************************************************************************/
	public function getLast($array, $count, $preserverKey);
	
	/******************************************************************************************
	* GET FIRST		                             			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin ilk elemanını döndürür.										  |
	
	  @param 	array   $array
	  @param 	numeric $count
	  @param	bool	$preserverKey
	  @return 	string, array
	|          																				  |
	******************************************************************************************/
	public function getFirst($array, $count, $preserverKey);
	
	/******************************************************************************************
	* ORDER                                        			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizide sıralama yapmak için kullanılır.								  |
	
	  @param 	array  $array
	  @param	string $type  -> asc(asort),  		desc(arsort), 		 	asckey(ksort),   
	  							 desckey(krsort), 	user(usort),		 	userassoc(uasort), 
								 userkey(uksort), 	insens(natcasesort), 	natural(natsort), 	
								 reverse(rsort),	random(shuffle)
	  @param 	value  $flags -> regular, numeric, string, locale_string, natural, flag_case
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function order($array, $type, $flags);
	
	/******************************************************************************************
	* OBJECT DATA                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Dizi olarak girilen verileri object veri tipine dönüştürür. 	          |
	|																						  |
	| Parametreler: 2 parametresi vardır.                                              		  |
	| 1. array var @array => İşlem yapılıcak dizi.							  				  |
	|          																				  |
	******************************************************************************************/
	public function objectData($data);
	
	/******************************************************************************************
	* LENGTH                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizinin eleman sayısını döndürür.							 	          |
	|          																				  |
	******************************************************************************************/
	public function length($data);
	
	/******************************************************************************************
	* APPORTION                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Diziyi eşit paraçlara böler.								 	          |
	|          																				  |
	******************************************************************************************/
	public function apportion($data, $portionCount, $preserveKeys);
	
	/******************************************************************************************
	* COMBINE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: ' diziyi anahtar değer çifti olarak birleştirir.			 	          |
	
	  @param 	array $keys
	  @param	array $values
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function combine($keys, $values);
	
	/******************************************************************************************
	* COUNT SAME VALUES                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Dizide yer alan değerlerden hangisinden kaç tane olduğunu sayar.        |
	
	  @param 	array $array
	  @param	value $key
	  @return 	array, string
	|          																				  |
	******************************************************************************************/
	public function countSameValues($array, $key);
	
	/******************************************************************************************
	* FLIP                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Dizinin anahtarları ile değerleri yer değiştirir.			 	          |
	
	  @param 	array $array
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function flip($array);
	
	/******************************************************************************************
	* IMPLEMENT CALLBACK                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dizilerin elemanlarına geriçağırım işlevini uygular.		  |
	
	  @param 	string $functionName
	  @param 	array ...arguments
	  @return	array
	|          																				  |
	******************************************************************************************/
	public function implementCallback();
	
	/******************************************************************************************
	* RECURSIVE MERGE                                                                         *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dizileri bileştirmek için kullanılır.						  |
	
	  @param 	array ...arguments
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function recursiveMerge();
	
	/******************************************************************************************
	* MERGE                                        			                                  *
	*******************************************************************************************
	| Genel Kullanım: Belirtilen dizileri bileştirmek için kullanılır.						  |
	
	  @param 	array ...arguments
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function merge();
	
	/******************************************************************************************
	* REVERSE                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Diziyi tersine sıralayıp döndürür.									  |
	
	  @param 	array $array
	  @param 	bool  $preserveKeys
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function reverse($array, $preserveKeys);
	
	/******************************************************************************************
	* PRODUCT                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizideki değerlerin çarpımını verir.									  |
	
	  @param 	array $array
	  @return 	numeric
	|          																				  |
	******************************************************************************************/
	public function product($array);
	
	/******************************************************************************************
	* SUM                                     				                                  *
	*******************************************************************************************
	| Genel Kullanım: Dizideki değerlerin toplamını verir.									  |
	
	  @param 	array $array
	  @return 	numeric
	|          																				  |
	******************************************************************************************/
	public function sum($array);
	
	/******************************************************************************************
	* RANDOM                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir diziden belli sayıda rasgele eleman döndürür.						  |
	
	  @param 	array 	$array
	  @param	numeric $countRequest
	  @return 	numeric, array
	|          																				  |
	******************************************************************************************/
	public function random($array, $countRequest);
	
	/******************************************************************************************
	* SEARCH                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizide belirtilen değeri arar ve bulursa ilgili anahtarı döndürür.  |
	
	  @param 	array $array
	  @param 	mixed $element
	  @param 	bool  $strict
	  @return 	numeric
	|          																				  |
	******************************************************************************************/
	public function search($array, $element, $strict);
	
	/******************************************************************************************
	* VALUE EXISTS                                 			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizide bir değerin varlığını araştırır.  							  |
	
	  @param 	array $array
	  @param 	mixed $element
	  @param 	bool  $strict
	  @return 	bool
	|          																				  |
	******************************************************************************************/
	public function valueExists($array, $element, $strict);
	
	/******************************************************************************************
	* KEY EXISTS                                  			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizide bir anahtarın varlığını arar.  							  |
	
	  @param 	array $array
	  @param 	mixed $key
	  @return 	bool
	|          																				  |
	******************************************************************************************/
	public function keyExists($array, $key);
	
	/******************************************************************************************
	* SECTION                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin belli bir bölümünü döndürür.								  |
	
	  @param 	array 	$array
	  @param 	numeric $start
	  @param 	numeric $length
	  @param 	bool	$preserveKeys
	  @return	array
	|          																				  |
	******************************************************************************************/
	public function section($array, $start, $length, $preserveKeys);
	
	/******************************************************************************************
	* RESECTION                                     			                                  *
	*******************************************************************************************
	| Genel Kullanım: Bir dizinin belli bir bölümünü silip yerine başka şeyler koyar.		  |
	
	  @param 	array 	$array
	  @param 	numeric $start
	  @param 	numeric $length
	  @param 	mixed	$newElement
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function resection($array, $start, $length, $newElement);
	
	/******************************************************************************************
	* DELETE RECURRENT                             			                                  *
	*******************************************************************************************
	| Genel Kullanım: Diziden yinelenen değerleri siler.									  |
	
	  @param 	array $array
	  @param 	value $flags -> regular, numeric, string, locale_string
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function deleteRecurrent($array, $flags);
	
	/******************************************************************************************
	* SERIES                             			             		                      *
	*******************************************************************************************
	| Genel Kullanım: Belli bir eleman aralığını içeren bir dizi oluşturur.					  |
	
	  @param 	numeric $start
	  @param 	numeric $end
	  @param 	numeric $step
	  @return 	array
	|          																				  |
	******************************************************************************************/
	public function series($start, $end, $step);
}