<?php 
namespace ZN\ShoppingCart;

interface CartInterface
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
	* INSERT ITEM                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sepete ürün eklemek için kullanılır. Eklenecek ürünler dizi olarak	  |
	| belirtilir.														                      |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @product => Eklenecek ürünlerin bilgisini tutar .					      |
	|          																				  |
	| Örnek Kullanım: array('id' => 1, 'price' => 5, quantity => 1, 'name' => 'Urun')         |
	|          																				  |
	| Ürün eklenirken belirtilmek zorunda olunan parametreler şunlardır.          			  |
	|          																				  |
	| 1-Fiyat Parametresi: price => fiyat bildirilirken price anahtar kelimesi kullanılır.    |
	| 2-Adet Parametresi: quantity => adet bildirilirken quantity anahtar kelime kullanılır.  |
	| bu anahtar kelime kullanılmazsa ürün adeti 1 kabul edilir. Bunların dışındaki        	  |
	| isimlendirmeler keyfidir. Yani isteğe bağlıdır.        								  |
	|          																				  |
	******************************************************************************************/
	public function insertItem($product);
	
	/******************************************************************************************
	* SELECT ITEMS                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sepetteki tüm ürün bilgilerini dizi olarak döndürmek için kullanılır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public function selectItems();
	
	/******************************************************************************************
	* SELECT ITEM                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sepet içerisindeki belirtilen ürün hakkında verilere ulaşmak için       |
	| kullanılır. Yani ürün seçmek için kullanılır.											  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. mixed var @code => Seçilen ürüne ait ayırt edici bilgi parametre olarak girilir.	  |
	|        		  																		  |
	| Code parametresi 2 tür değişken türü içerir bunlar;                                     |
	|          																				  |
	| 1-String/Numeric  => bu tipte parametre için ürünün ayırt edici bilgisi kullanılır.     |	
	| Örnek: id, ürün kodu, seri numara gibi.                                                 |
	|																						  |   													
	| 2-Array => bu tipte parametre kullanımında ise hangi parametreye göre ürünün seçileceği |
	| belirtilir.    																		  |
	| Örnek: array('id' => 'id değeri').                                                      |
	|          																				  |
	******************************************************************************************/
	public function selectItem($code);
	
	/******************************************************************************************
	* TOTAL ITEMS                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sepetteki toplam ürün adet bilgisine erişmek için kullanılır.			  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	| NOT:Bu hesaplama ürün verileri içerisinde quantity parametresine göre yapılmaktadır.    |
	| Bu nedenle quantity dışında ürün adeti için farklı bir parametre kullanmayınız.         |
	|        																				  |
	******************************************************************************************/
	public function totalItems();
	
	/******************************************************************************************
	* TOTAL PRICES                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sepetteki ürünlerin toplam fiyat değerine erişmek için kullanılır.	  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	| NOT:Bu hesaplama ürün verileri içerisinde quantity ve price parametrelerine göre        |
	| yapılmaktadır. Bu nedenle quantity dışında ürün adeti ve fiyat için farklı bir          |
	| parametre kullanmayınız.      														  |
	|     																					  |
	******************************************************************************************/
	public function totalPrices();
	
	/******************************************************************************************
	* UPDATE ITEM                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sepet içerisindeki belirtilen ürün bilgilerinin güncellenmesi için	  |
	| kullanılır.															                  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. mixed var @code => Güncellenen ürüne ait ayırt edici bilgi parametre olarak girilir. |
	| 2. array var @data => Güncellenecek verileri dizi içerisinde anahtar değer çifti olarak |
	| girilmelidir.																			  |
	|																						  |
	| Code parametresi 2 tür değişken türü içerir bunlar;                                     |
	|          																				  |
	| 1-String/Numeric  => bu tipte parametre için ürünün ayırt edici bilgisi kullanılır.     |	
	| Örnek: id, ürün kodu, seri numara gibi.                                                 |
	|																						  |   													
	| 2-Array => bu tipte parametre kullanımında ise hangi parametreye göre ürünün seçileceği |
	| belirtilir.    																		  |
	| Örnek: array('id' => 'id değeri').                                                      |
	|          																				  |
	| Örnek Kullanım: updateItem(array('id' => 10), array('price' => 5, 'name' => 'Urun1'))  |
	| Yukarıda yapılan id'si 10 olan ürünün fiyatını 5 ve isminide Urun1                      |
	| olarak güncelle işlemidir.         												      |
	|          																				  |
	******************************************************************************************/
	public function updateItem($code, $data);
	
	/******************************************************************************************
	* DELETE ITEM                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Sepet içerisindeki belirtilen ürünü silmek için kullanılır.             |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. mixed var @code => Seçilen ürüne ait ayırt edici bilgi parametre olarak girilir.	  |
	|        		  																		  |
	| Code parametresi 2 tür değişken türü içerir bunlar;                                     |
	|          																				  |
	| 1-String/Numeric  => bu tipte parametre için ürünün ayırt edici bilgisi kullanılır.     |	
	| Örnek: id, ürün kodu, seri numara gibi.                                                 |
	|																						  |   													
	| 2-Array => bu tipte parametre kullanımında ise hangi parametreye göre ürünün seçileceği |
	| belirtilir.    																		  |
	| Örnek: array('id' => 'id değeri').                                                      |
	|          																				  |
	******************************************************************************************/
	public function deleteItem($code);
	
	/******************************************************************************************
	* DELETE ITEMS                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Sepetteki tüm ürünleri silmek için kullanılır.	                      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function deleteItems();
	
	/******************************************************************************************
	* MONEY FORMAT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Parametre olarak belirtilen sayısal veriyi para birimine çevirmek için. |
	| kullanılır.		                                                                      |
	|     														                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	|     														                              |
	| 1. numeric var @money => Para biçimine çevrilmek istenen sayılsal veri.				  |
	| 2. string var @type => Sayısal verinin sonunda görüntülenmesi istenilen para birimidir. |
	|     														                              |
	| Örnek Kullanım: moneyFormat(1200, '₺');  // Çıktı: 1.200,00 ₺     					  |
	| Örnek Kullanım: moneyFormat(1000, '€');  // Çıktı: 1.000,00 €     					  |
	|     														                              |
	******************************************************************************************/
	public function moneyFormat($money, $type);
}