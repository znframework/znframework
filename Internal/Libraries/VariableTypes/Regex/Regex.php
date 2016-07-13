<?php
namespace ZN\VariableTypes;

class InternalRegex implements RegexInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Config Değişkeni
	 *  
	 * FTP ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	public function __construct()
	{
		$this->config = \Config::get('Regex');	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Call Undefined Method                                                                       
	//----------------------------------------------------------------------------------------------------
	//
	// __call()
	//																						  
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;
	
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
	public function match($pattern = '', $str = '', $ex = '', $delimiter = '/')
	{
		// Parametre kontrolleri yapılıyor. ----------------------------------------------------------
		if( ! is_string($pattern) || ! is_string($str) ) 
		{
			\Errors::set('Error', 'stringParameter', '1.(pattern)');
			\Errors::set('Error', 'stringParameter', '2.(str)');	
			
			return false;
		}	
		// --------------------------------------------------------------------------------------------
		
		$pattern = $this->_regularConverting($pattern, $ex, $delimiter);
		
		preg_match($pattern, $str , $return);	
		
		return $return;
	}
	
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
	public function matchAll($pattern = '', $str = '', $ex = '', $delimiter = '/')
	{
		// Parametre kontrolleri yapılıyor. ----------------------------------------------------------
		if( ! is_string($pattern) || ! is_string($str) ) 
		{
			\Errors::set('Error', 'stringParameter', '1.(pattern)');
			\Errors::set('Error', 'stringParameter', '2.(str)');	
			
			return false;
		}	
		// --------------------------------------------------------------------------------------------
		
		$pattern = $this->_regularConverting($pattern, $ex, $delimiter);
		
		preg_match_all($pattern, $str , $return);	
		
		return $return;
	}
	
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
	public function replace($pattern = '', $rep = '', $str = '', $ex = '', $delimiter = '/')
	{
		// Parametre kontrolleri yapılıyor. ----------------------------------------------------------
		if( ! is_string($pattern) || ! is_string($rep) || ! is_string($str) ) 
		{
			\Errors::set('Error', 'stringParameter', '1.(pattern)');
			\Errors::set('Error', 'stringParameter', '2.(rep)');
			\Errors::set('Error', 'stringParameter', '3.(str)');	
			
			return false;
		}
		// --------------------------------------------------------------------------------------------
		
		$pattern = $this->_regularConverting($pattern, $ex, $delimiter);	
		
		return preg_replace($pattern, $rep, $str);
	}
	
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
	public function group($str = '')
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		return "(".$str.")";
	}
	
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
	public function recount($str = '')
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		return "{".$str."}";
	}
	
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
	public function to($str = '')
	{
		if( ! is_string($str) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(str)');
		}
		
		return "[".$str."]";
	}	
	
	/******************************************************************************************
	* QUOTE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Düzenli ifadelerin özel karakterlerini önceler.                         |
	 
	  @param string $data
	|          																				  |
	******************************************************************************************/	
	public function quote($data = '', $delimiter = NULL)
	{
		if( ! is_string($data) ) 
		{
			return \Errors::set('Error', 'stringParameter', '1.(data)');
		}
		
		return preg_quote($data, $delimiter);
	}
	
	/******************************************************************************************
	* PRIVATE REGULAR CONVERTING                                                              *
	******************************************************************************************/	
	private function _regularConverting($pattern, $ex = '', $delimiter = '/')
	{
		
		$specialChars = $this->config['specialChars'];
		
		$pattern = str_ireplace(array_keys($specialChars ), array_values($specialChars), $pattern);
		
		// Config/Regex.php dosyasından düzenlenmiş karakter 
		// listeleri alınıyor.
		$regexChars   = \Arrays::multikey($this->config['regexChars']);
		
		$settingChars = \Arrays::multikey($this->config['settingChars']);
		// --------------------------------------------------------------------------------------------
		
		$pattern = str_ireplace(array_keys($regexChars), array_values($regexChars), $pattern);	
		
		if( ! empty($ex) ) 
		{
			$ex = str_ireplace(array_keys($settingChars), array_values($settingChars), $ex);
		}
		
		return presuffix($pattern, $delimiter).$ex;
	}
}