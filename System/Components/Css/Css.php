<?php
/************************************************************/
/*                    TRANSLATE COMPONENT                   */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CSS                                                                                     *
*******************************************************************************************
| Dahil(Import) Edilirken : Css   		     							                  |
| Sınıfı Kullanırken      :	$this->css->       									  		  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentCss
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
	
	// Construct yapıcısı tarafından
	// Config/Css3.php dosyasından ayarlar alınıyor.
	public function __construct()
	{
		$this->browsers = config::get('Css3', 'browsers');	
	}
	
	/* Selector Function
	 * Params: string @selector 
	 * this, #custom, .example
	 *
	 * $(this), $("#custom"), $(".example") 
	 */
	public function selector($selector = '')
	{
		if( ! is_char($selector))
		{
			return $this;	
		}

		$this->selector = $selector;	
	
		return $this;
	}
	
	// PROTECTED ATTR
	protected function _attr($_attributes = array())
	{
		$attribute = "";
		if(is_array($_attributes))
		{
			foreach($_attributes as $key => $values)
			{
				if(is_numeric($key))
					$key = $values;
				$attribute .= ' '.$key.':'.$values.';';
			}	
		}
		
		$this->attr = $attribute;
		
		return $this;	
	}
	
	/******************************************************************************************
	* ATTR                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Css kodu eklemek için kullanılır.        		  		 				  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @_attributes => Eklenecek css kodları ve değerleri.		     			  |
	|          																				  |
	| Örnek Kullanım: ->attr(array('color' => 'red', 'border' => 'solid 1px #000')) 		  |
	|          																				  |
	******************************************************************************************/
	public function attr($attr = array())
	{		
		if( ! is_array($attr) )
		{
			return false;	
		}
		$this->_attr($attr);	
		
		$str  = $this->selector."{".ln();	
		$str .= $this->attr.ln();
		$str .= "}".ln();
		
		$this->_default_variable();
		
		return $str;
	}
	
	protected function _default_variable()
	{
		if( ! empty($this->attr) ) 		$this->attr = NULL;
		if( $this->selector !== 'this' )  $this->selector = 'this';
	}
}