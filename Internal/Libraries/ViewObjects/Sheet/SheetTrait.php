<?php
namespace ZN\ViewObjects;

trait SheetTrait
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Selector Değişkeni
	 *  
	 * Seçici bilgisini tutması için
	 * oluşturulumuştur. 
	 */
	private $selector = 'this';
	
	/* Attr Değişkeni
	 *  
	 * Eklenmek istenen farklı css kodlarına.
	 * ait bilgileri tutması için oluşturulmuştur.
	 */
	protected $attr;
	
	/* Easing Değişkeni
	 *  
	 * Easing animasyon bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $easing;
	
	/* Transtions Değişkeni
	 *  
	 * Geçiş efektlerine ait kullanacak
	 * verileri tutması için oluşturulmuştur.
	 *
	 */
	protected $transitions = '';
	
	protected $tag = false;
	
	// Construct yapıcısı tarafından
	// Config/Css3.php dosyasından ayarlar alınıyor.
	public function __construct($tag = false)
	{
		$this->browsers = \Config::get('ViewObjects', 'css3')['browsers'];	
		
		$this->tag = $tag;
	}
	
	protected function _tag($code)
	{
		if( $this->tag === true )
		{
			return \Style::open().$code.\Style::close();
		}
		
		return $code;
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
	private function _attr($_attributes = [])
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
	| Genel Kullanım: Farklı bir css kodu ekleneceği zaman kullanılır.        		  		  |
	|															                              |
	| Parametreler: Tek dizi parametresi vardır.                                              |
	| 1. array var @_attributes => Eklenecek css kodları ve değerleri.		     			  |
	|          																				  |
	| Örnek Kullanım: ->attr(array('color' => 'red', 'border' => 'solid 1px #000')) 		  |
	|          																				  |
	******************************************************************************************/
	public function attr($_attributes = [])
	{
		$this->attr = $this->_attr($_attributes);
		return $this;
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
			\Errors::set('Error', 'valueParameter', 'selector');
			return $this;	
		}

		$this->selector = $selector;	
	
		return $this;
	}
	
	// PRIVATE transitions nesnesi
	private function _transitions($data)
	{
		$transitions = "";
		
		foreach($this->browsers as $val)
		{
			$transitions .= "$val$data";
		}
		
		return EOL.$transitions;
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
		$this->_defaultVariable();
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
	public function create(...$args)
	{
		$combineTransitions = $args;
		
		$str  = $this->selector."{";	
		if( ! empty($this->attr) ) $str .= EOL.$this->attr.EOL;
		$str .= $this->complete();
		
		if( ! empty($combineTransitions) ) foreach( $combineTransitions as $transition )
		{			
			$str .= $transition;
		}
	
		$str .= "}".EOL;
		
		return $this->_tag($str);
	}
	
	// Değişkenler default ayarlarına getiriliyor.
	protected function _defaultVariable()
	{
		if( ! empty($this->attr) ) 		  $this->attr = NULL;
		if( ! empty($this->transitions) ) $this->transitions = '';
		if( $this->selector !== 'this' )  $this->selector = 'this';
	}
}