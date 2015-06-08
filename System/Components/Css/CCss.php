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
| Dahil(Import) Edilirken : CCss   		     							                  |
| Sınıfı Kullanırken      :	$this->ccss->       									  	  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class CCss
{
	/* Easing Değişkeni
	 *  
	 * Easing animasyon bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $easing;
	
	/* Manipulation Değişkeni
	 *  
	 * Değişiklik bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $manipulation;
	
	/* Selector Değişkeni
	 *  
	 * Seçici bilgisini tutması için
	 * oluşturulumuştur. 
	 */
	protected $selector = 'this';
	
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
	 * this, #custom, .example
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
		
		return $attribute;	
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

		$str  = $this->selector."{".ln();	
		$str .= $this->_attr($attr).ln();
		$str .= "}".ln();
		
		$this->_default_variable();
		
		return $str;
	}
	
	/******************************************************************************************
	* FILE                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Manüpile edilmek istenen css dosyasının adını belirtmek için kullanılır.|
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @file => Dosya adı bilgisi.  					  						  |
	|          																				  |
	| Örnek Kullanım: ->file('style')					 		         					  |
	|          																				  |
	******************************************************************************************/
	public function file($file = '')
	{
		if( is_string($file) )
		{
			$this->manipulation['filename'] = STYLES_DIR.suffix($file, '.css');
			$this->manipulation['file'] = file::contents($this->manipulation['filename']);
		}
		
		return $this;	
	}
	
	// PROTECTED MANIPULATION
	protected function _manipulation($selector)
	{
		$space = '\s*';
		$all   = '.*';
		
		$file = $this->manipulation['file'];
		
		if( empty($file) )
		{
			return false;	
		}
		
		preg_match('/'.$selector.$space.'\{'.$space.$all.$space.'\}'.$space.'/', $file, $output);
		
		if( ! empty($output[0]) )
		{
			$output = $output[0];	
		}
		else
		{
			return false;	
		}
		
		return $output;
	}
	
	/******************************************************************************************
	* GET SELECTOR                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Manüpile edilmek istenen css dosyasında yer alan seçiçinin içeriğine.	  |
	| erişmek için kullanılır.																  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @selector => Seçici bilgisi.					  						  |
	|          																				  |
	| Örnek Kullanım: ->get_selector('.test');			 		         					  |
	|          																				  |
	******************************************************************************************/
	public function get_selector($selector = '')
	{
		if( ! is_string($selector) )
		{
			return false;	
		}
		
		$space = '\s*';
		
		$output = $this->_manipulation($selector);
					  
		$output = preg_replace('/'.$selector.$space.'\{/', '', $output);
		$output = preg_replace('/\}/', '', $output);
		
		return trim($output);
	}
	
	/******************************************************************************************
	* SET SELECTOR                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Manüpile edilmek istenen css dosyasında yer alan seçiçinin içeriğine.	  |
	| erişmek için kullanılır.																  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @selector => Seçici bilgisi.					  						  |
	| 1. array var @attr => Yeni değerler.					  						  		  |
	|          																				  |
	| Örnek Kullanım: ->set_selector('.test', array('color' => 'red'));			 		      |
	|          																				  |
	******************************************************************************************/
	public function set_selector($selector = '', $attr = array())
	{
		if( ! is_string($selector) || ! is_array($attr) )
		{
			return false;	
		}	

		$file = $this->manipulation['file'];
		
		$value = $this->selector($selector)->attr($attr);
		
		$output = $this->_manipulation($selector);
		
		$output = str_replace($output, $value , $file);
		
		file::write($this->manipulation['filename'], $output);
	}
	
	// Değişkenler varsayılan ayarlarına getiriliyor.
	protected function _default_variable()
	{
		if( ! empty($this->attr) ) 		$this->attr = NULL;
		if( $this->selector !== 'this' )  $this->selector = 'this';
	}
}