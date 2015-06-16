<?php
/************************************************************/
/*                     SHADOW COMPONENT                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Css;

use Config;
/******************************************************************************************
* SHADOW                                                                                  *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->cshadow->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CShadow
{
	/* Easing Değişkeni
	 *  
	 * Easing animasyon bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $easing;
	
	/* Selector Değişkeni
	 *  
	 * Seçici bilgisini tutması için
	 * oluşturulumuştur. 
	 */
	protected $selector = 'this';
	
	/* Attr Değişkeni
	 *  
	 * Eklenmek istenen farklı css kodlarına.
	 * ait bilgileri tutması için oluşturulmuştur.
	 */
	protected $attr;
	
	/* Params Değişkeni
	 *  
	 * Sınıfa ait kullanacak
	 * verileri tutması için oluşturulmuştur.
	 *
	 */
	protected $params = array();

	// Construct yapıcısı tarafından
	// Config/Css3.php dosyasından ayarlar alınıyor.
	public function __construct()
	{
		$this->browsers = Config::get('Css3', 'browsers');	
	}
	
	/******************************************************************************************
	* SELECTOR                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Css kodlarının uygulanacağı nesne seçicisi.        		  		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @selector => .nesne, #eleman, td ... gibi seçiciler belirtilir.		      |
	|          																				  |
	| Örnek Kullanım: ->selector('#eleman') 						 		 		  		  |
	|          																				  |
	******************************************************************************************/
	public function selector($selector = '')
	{
		if( ! isChar($selector) )
		{
			return $this;	
		}

		$this->selector = $selector;	
	
		return $this;
	}
	
	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Farklı bir css kodu ekleneceği zaman kullanılır.        		  		  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @_attributes => Eklenecek css kodları ve değerleri.		     			  |
	|          																				  |
	| Örnek Kullanım: ->attr(array('color' => 'red', 'border' => 'solid 1px #000')) 		  |
	|          																				  |
	******************************************************************************************/
	public function attr($_attributes = array())
	{
		$attribute = '';
		
		if( is_array($_attributes) )
		{
			foreach($_attributes as $key => $values)
			{
				if( is_numeric($key) )
				{
					$key = $values;
				}
				$attribute .= ' '.$key.':'.$values.';';
			}	
		}
		
		$this->attr = $attribute;
		
		return $this;	
	}
	
	/******************************************************************************************
	* X                                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Gölgenin yataydaki boyutu.        		  		  				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Miktar.		     			  							  |
	|          																				  |
	| Örnek Kullanım: ->x(10) // 10px 		  												  |
	|          																				  |
	******************************************************************************************/
	public function x($val = '')
	{
		if( ! isValue($val) )
		{
			return $this;	
		}
		
		if( is_numeric($val) )
		{
			$val = $val."px";
		}
		
		$this->params['horizontal'] = $val;
		
		return $this;
	}
	
	/******************************************************************************************
	* HORIZONTAL / X                                                                          *
	*******************************************************************************************
	| Genel Kullanım: X() yönteminin alternatifidir. Gölgenin yataydaki boyutu.        		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Miktar.		     			  							  |
	|          																				  |
	| Örnek Kullanım: ->horizontal(10) // 10px 		  										  |
	|          																				  |
	******************************************************************************************/
	public function horizontal($val = '')
	{
		$this->x($val);
		
		return $this;
	}
	
	/******************************************************************************************
	* Y                                                                                       *
	*******************************************************************************************
	| Genel Kullanım: Gölgenin dikeydeki boyutu.        		  		  				      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Miktar.		     			  							  |
	|          																				  |
	| Örnek Kullanım: ->y(10) // 10px 		  												  |
	|          																				  |
	******************************************************************************************/
	public function y($val = '')
	{
		if( ! isValue($val) )
		{
			return $this;	
		}
		
		if( is_numeric($val) )
		{
			$val = $val."px";
		}
		
		$this->params['vertical'] = $val;
		
		return $this;
	}
	
	/******************************************************************************************
	* VERTICAL / Y                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Y() yönteminin alternatifidir. Gölgenin dikeydeki boyutu.        		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Miktar.		     			  							  |
	|          																				  |
	| Örnek Kullanım: ->y(10) // 10px 		  												  |
	|          																				  |
	******************************************************************************************/
	public function vertical($val = '')
	{
		$this->y($val);
		
		return $this;
	}
	
	/******************************************************************************************
	* BLUR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Gölgenin görünülük miktarıdır.        		  						  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Miktar.		     			  							  |
	|          																				  |
	| Örnek Kullanım: ->blur(10) // 10px 		  											  |
	|          																				  |
	******************************************************************************************/
	public function blur($val = '')
	{
		if( ! isValue($val) )
		{
			return $this;	
		}
		
		if( is_numeric($val) )
		{
			$val = $val."px";
		}
		
		$this->params['blur'] = $val;
		
		return $this;
	}
	
	/******************************************************************************************
	* DIFFUSION                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Gölgenin yayılma miktarı.        		  						  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Miktar.		     			  							  |
	|          																				  |
	| Örnek Kullanım: ->diffusion(10) // 10px 		  										  |
	|          																				  |
	******************************************************************************************/
	public function diffusion($val = '')
	{
		if( ! isValue($val) )
		{
			return $this;	
		}
		
		if( is_numeric($val) )
		{
			$val = $val."px";
		}
		
		$this->params['spread'] = $val;
		
		return $this;
	}
	
	/******************************************************************************************
	* SPREAD / DIFFUSION                                                                      *
	*******************************************************************************************
	| Genel Kullanım: diffusion() yönteminin alternatifidir. Gölgenin yayılma miktarı.        |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Miktar.		     			  							  |
	|          																				  |
	| Örnek Kullanım: ->spread(10) // 10px 		  										      |
	|          																				  |
	******************************************************************************************/
	public function spread($val = '')
	{
		$this->diffusion($val);
		
		return $this;
	}
	
	/******************************************************************************************
	* COLOR                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Gölgenin rengini belirlemek için kullanılır.					          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string/numeric var @val => Renk kodu veya adı.  		  							  |
	|          																				  |
	| Örnek Kullanım: ->color('red')			  										      |
	| Örnek Kullanım: ->color('000') // #000		  										  |
	|          																				  |
	******************************************************************************************/
	public function color($val = '')
	{
		if( ! isValue($val))
		{
			return $this;	
		}
		
		if( is_numeric($val) )
		{
			$val = "#".$val;
		}
		
		$this->params['color'] = $val;
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                     			  *
	*******************************************************************************************
	| Genel Kullanım: Efekti tamamlamak için kullanılan zincirin son halkasıdır.			  |
	|															                              |
	| Örnek Kullanım: ->create()					  										  |
	|          																				  |
	******************************************************************************************/	
	public function create()
	{
		$str  = $this->selector."{".eof();	
		$str .= $this->attr.eof();
		
		$shadow = 	"box-shadow:".
					$this->params['horizontal']." ".
					$this->params['vertical']." ".
					$this->params['blur']." ".
					$this->params['spread']." ".
					$this->params['color'].";".
		$browser = '';	
				
		foreach($this->browsers as $val)
		{
			$str .= $val.$shadow.eof();
		}
		$str .= "}".eof();
		
		return $str;
	}
	
	// VARSAYILAN DEĞİŞKEN AYARLARI
	// Efekt tamamlandığında değişkenler
	// varsayılan ayarlarına getirmek için
	// kullanılmaktadır.
	protected function _default_variable()
	{
		if( ! empty($this->attr) ) 			$this->attr = NULL;
		if( ! empty($this->params) )		$this->params = array();
		if( $this->selector !== 'this' )  	$this->selector = 'this';
	}
}