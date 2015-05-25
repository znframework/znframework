<?php
/************************************************************/
/*                    ANIMATION COMPONENT                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* ANIMATION                                                                               *
*******************************************************************************************
| Dahil(Import) Edilirken : Css/Animation     							                  |
| Sınıfı Kullanırken      :	$this->animation->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class ComponentCssAnimation
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
		$this->browsers = config::get('Css3', 'browsers');	
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
		if( ! is_char($selector) )
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
	* ANIMATION NAME                                                                          *
	*******************************************************************************************
	| Genel Kullanım: animation-name nesnesine ait verilecek isim bilgisi.    		  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @name  => Animasyon ismi.		     			      					  |
	|          																				  |
	| Örnek Kullanım: ->name('animasyon') 		  									  		  |
	|          																				  |
	******************************************************************************************/
	public function name($name = '')
	{
		if( ! is_value($name) )
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-name:$name;".ln());
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION DIRECTION                                                                     *
	*******************************************************************************************
	| Genel Kullanım: animation-directon nesnesinin kullanımıdır.    		  		 		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @direction => Animasyonun yönü. Varsayılan:reverse    					  |
	|          																				  |
	| Örnek Kullanım: ->direction('reverse') 		  									  	  |
	|          																				  |
	******************************************************************************************/
	public function direction($direction = 'reverse')
	{
		if( ! is_value($direction) )
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-direction:$direction;".ln());
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION PLAY STATE                                                                    *
	*******************************************************************************************
	| Genel Kullanım: animation-play-state nesnesinin kullanımıdır.    		  		 		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @status => Animasyonun oynatılma durumu.			   					  |
	|          																				  |
	| Örnek Kullanım: ->status('pause') 		  									  	 	  |
	|          																				  |
	******************************************************************************************/
	public function status($status = '')
	{
		if( ! is_value($status) )
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-play-state:$status;".ln());
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION FILL MODE                                                                     *
	*******************************************************************************************
	| Genel Kullanım: animation-fill-mode kullanımıdır.    		  		 		  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @fill => Özellik bilgisi.			   					  	  			  |
	|          																				  |
	| Örnek Kullanım: ->fill() 		  									  	 	 		      |
	|          																				  |
	******************************************************************************************/
	public function fill($fill = '')
	{
		if( ! is_value($fill) )
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-fill-mode:$fill;".ln());
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION ITERATION COUNT                                                               *
	*******************************************************************************************
	| Genel Kullanım: animation-iteration-count kullanımıdır.    				  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. numeric var @repeat => Tekrar bilgisi.			   					  	  			  |
	|          																				  |
	| Örnek Kullanım: ->repeat(2) 		  									  	 	 		  |
	|          																				  |
	******************************************************************************************/
	public function repeat($repeat = '')
	{
		if( ! is_value($repeat) )
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-iteration-count:$repeat;".ln());
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION DURATION                                                                      *
	*******************************************************************************************
	| Genel Kullanım: animation-duration kullanımıdır.    				  			  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @duration => Süre bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->duration(2) 		  									  	 	 	  |
	|          																				  |
	******************************************************************************************/
	public function duration($duration = '')
	{
		if( ! is_value($duration) )
		{
			return $this;	
		}
		
		if(is_numeric($duration))
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("animation-duration:$duration;".ln());
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION DELAY                                                                         *
	*******************************************************************************************
	| Genel Kullanım: animation-delay kullanımıdır.    				  			  		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string/numeric var @delay => Geçikme bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->delay(2) 		  									  	 	 	  	  |
	|          																				  |
	******************************************************************************************/
	public function delay($delay = '')
	{
		if( ! is_value($delay) )
		{
			return $this;	
		}
		
		if( is_numeric($delay) )
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("animation-delay:$delay;".ln());
		
		return $this;
	}
	
	/******************************************************************************************
	* ANIMATION TIMING FUNCTION                                                               *
	*******************************************************************************************
	| Genel Kullanım: animation-timing-function kullanımıdır.    				  			  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                              	  |
	| 1. string var @easing => Animasyon türü bilgisi.			   					  	      |
	|          																				  |
	| Örnek Kullanım: ->easing('ease-in-out') 		  									  	  |
	|          																				  |
	******************************************************************************************/
	public function easing($easing = '')
	{
		if( ! is_value($easing) )
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-timing-function:$easing;".ln());
		
		return $this;
	}
	
	// PROTECTED transitions nesnesi
	protected function _transitions($data)
	{
		$transitions = "";
		foreach($this->browsers as $val)
		{
			$transitions .= "$val$data";
		}
		
		return ln().$transitions;
	}
	
	/******************************************************************************************
	* ANIMATION COMPLETE                                                                      *
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
	* ANIMATION CREATE	                                                                      *
	*******************************************************************************************
	| Genel Kullanım: Animasyon oluşturmada kullanılan son yöntemdir.   					  |
	|															                              |	
	| Örnek Kullanım: ->create() 		  									  	 			  |
	|          																				  |
	******************************************************************************************/
	public function create()
	{
		$combine_transitions = func_get_args();
		
		$str  = $this->selector."{".ln();	
		$str .= $this->attr.ln();
		$str .= $this->complete();
		
		if( ! empty($combine_transitions) )foreach($combine_transitions as $transition)
		{			
			$str .= $transition;
		}
	
		$str .= "}".ln();
		
		return $str;
	}
	
	// Değişkenler default ayarlarına getiriliyor.
	protected function _default_variable()
	{
		if( ! empty($this->attr)) 		$this->attr = NULL;
		if( ! empty($this->transitions))$this->transitions = '';
		if($this->selector !== 'this')  $this->selector = 'this';
	}
}