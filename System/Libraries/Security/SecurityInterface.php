<?php 
namespace ZN\Security;

interface SecurityInterface
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
	* NC ENCODE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Kötü içerikli karakterlerin temizlemesi için                            |
	| kullanılır.												                              |
	|															                              |
	| Parametreler: 3 adet parametre alır.                                                    |
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	| 2. string/array var @badword => Kötü içerikli kelimeler.                                |
	| 3. string/array var @changechar => Değiştirilecek kelilemeler                           |
	|          																				  |
	| 2. ve 3. Parametreler kullanılmaz ise varsayılan olarak Config/Security.php dosyasında  |
	| yer alan nc_encode => change chars karakterleri ayarlı olacaktır. 					  |
	******************************************************************************************/
	public function ncEncode($string, $badWords, $changeChar);		
		
	/******************************************************************************************
	* INJECTION ENCODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilmesi için         |
	| kullanılır. Hangi karakterlerin izole edileceği Config/Security.php dosyasında yer alan.|									         
	| Injection_bad_chars parametresinde mevcuttur.											  |				                           
	| Parametreler: 3 adet parametre alır. 													  |
	|																						  |                                                   
	| 1. string var @string => Temizleme yapılacak metin.                                     |
	******************************************************************************************/	
	public function injectionEncode($string);
	
	/******************************************************************************************
	* INJECTION DECODE                                                                        *
	*******************************************************************************************
	| Genel Kullanım: SQL sorgularında tehdit edici karakterlerin izole edilen karakterlerin  |
	| kullanılır. Ancak sadece izole edilen tırnak işareleri tekrar eski haline getirilir.    |
	|																						  |	
	| 1. string var @string => Temizleme yapılacak metin. 									  |								       
	******************************************************************************************/	
	public function injectionDecode($string);
		
	/******************************************************************************************
	* XSS ENCODE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Script kodların kullanımında tehdit edici karakterlerin izole edilmesini|
	| sağlamak için kullanılır. Dönüştürülecek karakterlerin listesi için Cofig/Security.php  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	******************************************************************************************/	
	public function xssEncode($string);

	/******************************************************************************************
	* HTML EMCODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: HTML özel karakterlerinin ( < , > )izole edilmesini                     |
	| sağlamak için kullanılır. 															  |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public function htmlEncode($string, $type);
	
	/******************************************************************************************
	* HTML DECODE                                                                             *
	*******************************************************************************************
	| Genel Kullanım: İzole edilen HTML özel karakterlerinin ( < , > ) gerçek hallerine       |
	| dönmesini sağlamak için kullanılır. 												      |	
	|																						  |
	| 1. string var @string => Temizleme yapılacak metin.           					      |
	| 2. string var @type => Tırnak işaretleri.           					                  |
	******************************************************************************************/	
	public function htmlDecode($string, $type);
	
	// Function: phpTagEncode()
	// İşlev: Php taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function phpTagEncode($str);
	
	// Function: phpTagDecode()
	// İşlev: Php taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function phpTagDecode($str);
	
		// Function: scriptTagEncode()
	// İşlev: Script taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function scriptTagEncode($str);
	
	// Function: scriptTagDecode()
	// İşlev: Script taglarını numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function scriptTagDecode($str);
	
	// Function: nailEncode()
	// İşlev: Tırnak işaretlerini numerik koda dönüştürmek çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function nailEncode($str);
	
	// Function: nailDecode()
	// İşlev: Tırnak işaretlerini numerik koda dönüştürmek çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function nailDecode($str);
	
	// Function: foreignCharEncode()
	// İşlev: Farklı dillerdeki yabancı karakterleri numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function foreignCharEncode($str);
	
	// Function: foreignCharDecode()
	// İşlev: Farklı dillerdeki yabancı karakterleri numerik koda çevirir.
	// Parametreler
	// @str = Şifrelenecek data.
	// Dönen Değer: Şifrelenmiş bilgi.
	public function foreignCharDecode($str);	
	
	// Function: escapeStringEncode()
	// İşlev: Tırnak işaretlerinin önüne \ işareti getirilir.
	// Parametreler
	// @str = Dönüştürülen data.
	// Dönen Değer: Dönüştürülmüş bilgi.
	public function escapeStringEncode($data);
	
	// Function: escapeStringDecode()
	// İşlev: Önüne \ işareti getirilen tırnakları bu sembolden temizler.
	// Parametreler
	// @str = Dönüştürülen data.
	// Dönen Değer: Dönüştürülmüş bilgi.
	public function escapeStringDecode($data);
}