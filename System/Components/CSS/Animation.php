<?php
class __USE_STATIC_ACCESS__CAnimation
{
	/***********************************************************************************/
	/* ANIMATION COMPONENT		   		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CAnimation
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->canimation, zn::$use->canimation, uselib('canimation')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
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
			Error::set(lang('Error', 'valueParameter', 'selector'));
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
		if( ! isValue($name) )
		{
			Error::set(lang('Error', 'valueParameter', 'name'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-name:$name;".eol());
		
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
		if( ! isValue($direction) )
		{
			Error::set(lang('Error', 'valueParameter', 'direction'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-direction:$direction;".eol());
		
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
		if( ! isValue($status) )
		{
			Error::set(lang('Error', 'valueParameter', 'status'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-play-state:$status;".eol());
		
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
		if( ! isValue($fill) )
		{
			Error::set(lang('Error', 'valueParameter', 'fill'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-fill-mode:$fill;".eol());
		
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
		if( ! isValue($repeat) )
		{
			Error::set(lang('Error', 'valueParameter', 'repeat'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-iteration-count:$repeat;".eol());
		
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
		if( ! isValue($duration) )
		{
			Error::set(lang('Error', 'valueParameter', 'duration'));
			return $this;	
		}
		
		if(is_numeric($duration))
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("animation-duration:$duration;".eol());
		
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
		if( ! isValue($delay) )
		{
			Error::set(lang('Error', 'valueParameter', 'delay'));
			return $this;	
		}
		
		if( is_numeric($delay) )
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("animation-delay:$delay;".eol());
		
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
		if( ! isValue($easing) )
		{
			Error::set(lang('Error', 'valueParameter', 'easing'));
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("animation-timing-function:$easing;".eol());
		
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
		
		return eol().$transitions;
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
		$this->_defaultVariable();
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
		$combineTransitions = func_get_args();
		
		$str  = $this->selector."{".eol();	
		$str .= $this->attr.eol();
		$str .= $this->complete();
		
		if( ! empty($combineTransitions) ) foreach( $combineTransitions as $transition )
		{			
			$str .= $transition;
		}
	
		$str .= "}".eol();
		
		return $str;
	}
	
	// Değişkenler default ayarlarına getiriliyor.
	protected function _defaultVariable()
	{
		if( ! empty($this->attr) ) 		  $this->attr = NULL;
		if( ! empty($this->transitions) ) $this->transitions = '';
		if( $this->selector !== 'this' )  $this->selector = 'this';
	}
}