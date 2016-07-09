<?php
namespace ZN\VariableTypes;

interface RegexInterface
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
	* MATCH                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: preg_match() yönteminin işlevini üstlensede bu yöntemden farklı         |
	| olarak böyle bir yöntemin geliştirilmesinin amacı düzenli ifadelerdeki karmaşık görünen |
	| karakterler yerine isimlendirmeler yapılan yeni kelimeler oluşturulmuştur.              |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @pattern => Eşleşme istenen düzenli ifade deseni.                         |
	| 2. string var @str =>  Eşlleşme sağlanması istenen metin.                               |
	| 3. string var @ex => /desen/xi gibi bir desende kapsayıcı dışına yazılan x, i.          |
	| 4. string var @delimiter => Kapsayıcı işaretleri. Varsayılan:/                          |
	|          																				  |
	| NOT: Düzenli ifadelerde kullanılan karakterlerde yapılan değişiklik Config/Regex.php    |
	| dosyasında yer almaktadır. İnceleyiniz.                                                 |
	|          																				  |
	| Örnek Kullanım: match('<numeric>', 'a12', '<insesn>');        	  			          |
	| // preg_match('/\d/i', 'a12')        												      |
	|          																				  |
	|   >>>>>>>>>>>>>>>>>>>>>>Daha detaylı kullanımı için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<    |
	|          																				  |
	******************************************************************************************/	
	public function match($pattern, $str, $ex, $delimiter);
	
	/******************************************************************************************
	* MATCH ALL                                                                               *
	*******************************************************************************************
	| Genel Kullanım: matchAll() yönteminin işlevini üstlensede bu yöntemden farklı           |
	| olarak böyle bir yöntemin geliştirilmesinin amacı düzenli ifadelerdeki karmaşık görünen |
	| karakterler yerine isimlendirmeler yapılan yeni kelimeler oluşturulmuştur.              |
	|															                              |
	| Parametreler: 4 parametresi vardır.                                                     |
	| 1. string var @pattern => Eşleşme istenen düzenli ifade deseni.                         |
	| 2. string var @str =>  Eşlleşme sağlanması istenen metin.                               |
	| 3. string var @ex => /desen/xi gibi bir desende kapsayıcı dışına yazılan x, i.          |
	| 4. string var @delimiter => Kapsayıcı işaretleri. Varsayılan:/                          |
	|          																				  |
	| NOT: Düzenli ifadelerde kullanılan karakterlerde yapılan değişiklik Config/Regex.php    |
	| dosyasında yer almaktadır. İnceleyiniz.                                                 |
	|          																				  |
	| Örnek Kullanım: matchAll('<numeric>', 'a12', '<insesn>');        	  			          |
	| // matchAll('/\d/i', 'a12')        												      |
	|          																				  |
	|   >>>>>>>>>>>>>>>>>>>>>>Daha detaylı kullanımı için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<    |
	|          																				  |
	******************************************************************************************/	
	public function matchAll($pattern, $str, $ex, $delimiter);
	
	/******************************************************************************************
	* REPLACE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: matchAll() yönteminin işlevini üstlensede bu yöntemden farklı     |
	| olarak böyle bir yöntemin geliştirilmesinin amacı düzenli ifadelerdeki karmaşık görünen |
	| karakterler yerine isimlendirmeler yapılan yeni kelimeler oluşturulmuştur.              |
	|															                              |
	| Parametreler: 5 parametresi vardır.                                                     |
	| 1. string var @pattern => Değiştirilmek istenen düzenli ifade deseni.                   |
	| 2. string var @rep => Değiştirilecek karakter.                                          |
	| 3. string var @str =>  Eşlleşme sağlanması istenen metin.                               |
	| 4. string var @ex => /desen/xi gibi bir desende kapsayıcı dışına yazılan x, i.          |
	| 5. string var @delimiter => Kapsayıcı işaretleri. Varsayılan:/                          |
	|          																				  |
	| NOT: Düzenli ifadelerde kullanılan karakterlerde yapılan değişiklik Config/Regex.php    |
	| dosyasında yer almaktadır. İnceleyiniz.                                                 |
	|          																				  |
	| Örnek Kullanım: preg_reaplace('<numeric>', '', 'a12', '<insesn>');        	  		  |
	| // preg_replace('/\d/i', '', 'a12')        											  |
	|          																				  |
	|   >>>>>>>>>>>>>>>>>>>>>>Daha detaylı kullanımı için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<    |
	|          																				  |
	******************************************************************************************/	
	public function replace($pattern, $rep, $str, $ex, $delimiter);
	
	/******************************************************************************************
	* GROUP                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Düzenli ifadelerdeki ( ) grup karakterleri yerine kullanılır.           |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @str => Grup paranterzleri içerisine yazılacak veri.                      |
	|          																				  |
	| Örnek Kullanım: group('1|3');        	  		  										  |
	| // (1|3)        											                              |
	|          																				  |
	|   >>>>>>>>>>>>>>>>>>>>>>Daha detaylı kullanımı için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<    |
	|          																				  |
	******************************************************************************************/	
	public function group($str);
	
	/******************************************************************************************
	* RECOUNT                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Düzenli ifadelerdeki { } karakterleri yerine kullanılır.                |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @str => Tekrar paranterzleri içerisine yazılacak veri.                    |
	|          																				  |
	| Örnek Kullanım: recount(3);        	  		  										  |
	| // {3}        											                              |
	|          																				  |
	|   >>>>>>>>>>>>>>>>>>>>>>Daha detaylı kullanımı için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<    |
	|          																				  |
	******************************************************************************************/	
	public function recount($str);
	
	/******************************************************************************************
	* TO                                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Düzenli ifadelerdeki [ ] karakterleri yerine kullanılır.                |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @str => [ ] aranterzleri içerisine yazılacak veri.                        |
	|          																				  |
	| Örnek Kullanım: to(azAZ09);        	  		  										  |
	| // [azAZ09]        											                          |
	|          																				  |
	|   >>>>>>>>>>>>>>>>>>>>>>Daha detaylı kullanımı için zntr.net<<<<<<<<<<<<<<<<<<<<<<<<    |
	|          																				  |
	******************************************************************************************/	
	public function to($str);
	
	/******************************************************************************************
	* QUOTE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Düzenli ifadelerin özel karakterlerini önceler.                         |
	 
	  @param string $data
	|          																				  |
	******************************************************************************************/	
	public function quote($data, $delimiter);
}