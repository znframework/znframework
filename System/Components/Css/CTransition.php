<?php
/************************************************************/
/*                   TRANSITION COMPONENT                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
namespace Css;

use Config;
/******************************************************************************************
* TRANSITION                                                                              *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->ctransition->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CTransition
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
	
	/* Transtions Değişkeni
	 *  
	 * Geçiş efektlerine ait kullanacak
	 * verileri tutması için oluşturulmuştur.
	 *
	 */
	protected $transitions = '';
	
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
	* TRANSITION PROPERTY                                                                     *
	*******************************************************************************************
	| Genel Kullanım: transition-duration kullanımıdır.    				  			  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @property => Özellikler bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->property('color') 		  									  	 	 	  |
	|          																				  |
	******************************************************************************************/
	public function property($property = '')
	{
		if( ! isValue($property))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-property:$property;".eof());
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSITION DURATION                                                                     *
	*******************************************************************************************
	| Genel Kullanım: transition-duration kullanımıdır.    				  			  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @duration => Süre bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->duration(2) 		  									  	 	 	  |
	|          																				  |
	******************************************************************************************/
	public function duration($duration = '')
	{
		if( ! isValue($duration))
		{
			return $this;	
		}
		
		if(is_numeric($duration))
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-duration:$duration;".eof());
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSITION DELAY                                                                         *
	*******************************************************************************************
	| Genel Kullanım: transition-delay kullanımıdır.    				  		  		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @delay => Geçikme bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->delay(2) 		  									  	 	 	  	  |
	|          																				  |
	******************************************************************************************/
	public function delay($delay = '')
	{
		if( ! isValue($delay) )
		{
			return $this;	
		}
		
		if( is_numeric($delay) )
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-delay:$delay;".eof());
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSITION TIMING FUNCTION                                                              *
	*******************************************************************************************
	| Genel Kullanım: transition-timing-function kullanımıdır.    				  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @easing => Animasyon türü bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->easing('ease-in-out') 		  									  	  |
	|          																				  |
	******************************************************************************************/
	public function easing($easing = '')
	{
		if( ! isValue($easing))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-timing-function:$easing;".eof());
		
		return $this;
	}
	
	// PROTECTED transitions nesnesi
	public function _transitions($data)
	{
		$transitions = "";
		foreach($this->browsers as $val)
		{
			$transitions .= "$val$data";
		}
		
		return eof().$transitions;
	}
	
	/******************************************************************************************
	* TRANSITION COMPLETE                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Çoklu animasyon oluşturulacağı zaman sonlandırma yöntemi olarak		  |
	| kullanılır    				  			  											  |
	|															                              |	
	| Örnek Kullanım: ->complete() 		  									  	 			  |
	|          																				  |
	******************************************************************************************/
	public function complete()
	{
		$trans = $this->transitions;	
		$this->_default_variable();
		return $trans;
	}
	
	/******************************************************************************************
	* TRANSITION CREATE	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Animasyon oluşturmada kullanılan son yöntemdir.   					  |
	|															                              |	
	| Örnek Kullanım: ->create() 		  									  	 			  |
	|          																				  |
	******************************************************************************************/
	public function create()
	{
		$combine_transitions = func_get_args();
		
		$str  = $this->selector."{".eof();	
		$str .= $this->attr.eof();
		$str .= $this->complete();
		
		if( ! empty($combine_transitions) )foreach($combine_transitions as $transition)
		{			
			$str .= $transition;
		}
	
		$str .= "}".eof();
		
		return $str;
	}
	
	// Değişkenler default ayarlarına getiriliyor.
	protected function _default_variable()
	{
		if( ! empty($this->attr) ) 		  $this->attr = NULL;
		if( ! empty($this->transitions) ) $this->transitions = '';
		if( $this->selector !== 'this' )  $this->selector = 'this';
	}
}