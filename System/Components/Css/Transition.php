<?php
/************************************************************/
/*                   TRANSITION COMPONENT                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* TRANSITION                                                                              *
*******************************************************************************************
| Dahil(Import) Edilirken : Css/Transition   		     							      |
| Sınıfı Kullanırken      :	$this->transition->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentCssTransition
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
	
	public function property($property = '')
	{
		if( ! is_value($property))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-property:$property;".ln());
		
		return $this;
	}
	
	public function duration($duration = '')
	{
		if( ! is_value($duration))
		{
			return $this;	
		}
		
		if(is_numeric($duration))
		{
			$duration = $duration."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-duration:$duration;".ln());
		
		return $this;
	}
	
	public function delay($delay = '')
	{
		if( ! is_value($delay))
		{
			return $this;	
		}
		
		if(is_numeric($delay))
		{
			$delay = $delay."s";	
		}
		
		$this->transitions .= $this->_transitions("transition-delay:$delay;".ln());
		
		return $this;
	}
	
	public function easing($easing = '')
	{
		if( ! is_value($easing))
		{
			return $this;	
		}
		
		$this->transitions .= $this->_transitions("transition-timing-function:$easing;".ln());
		
		return $this;
	}
	
	public function _transitions($data)
	{
		$transitions = "";
		foreach($this->browsers as $val)
		{
			$transitions .= "$val$data";
		}
		
		return ln().$transitions;
	}
	
	public function complete()
	{
		$trans = $this->transitions;	
		$this->_default_variable();
		return $trans;
	}
	
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