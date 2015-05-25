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
* TRANSFORM                                                                               *
*******************************************************************************************
| Dahil(Import) Edilirken : Css/Transform   		     							      |
| Sınıfı Kullanırken      :	$this->transform->       									  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/
class ComponentCssTransform
{
	/* Selector Değişkeni
	 *  
	 * Seçici bilgisini tutması için
	 * oluşturulumuştur. 
	 */
	protected $selector = 'this';
	
	/* Transforms Değişkeni
	 *  
	 * Dönüşüm efektlerine ait kullanacak
	 * verileri tutması için oluşturulmuştur.
	 *
	 */
	protected $transforms = array();
	 
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
		if( ! is_char($selector))
		{
			return $this;	
		}

		$this->selector = $selector;	
	
		return $this;
	}
	
	protected function _params($data)
	{
		$arguments = $data;
		$argument = '';
		
		if(is_array($data))
		{
			foreach($arguments as $arg)
			{
				$argument .= $arg.",";
			}
			$argument = substr($argument, 0, -1);
		}
		else
		{
			$argument = $data;	
		}	
		
		return $argument;
	}
	protected function _transform($data)
	{
		$str  = '';
		$str .= $this->selector."{".ln();	
		
		foreach($this->browsers as $val)
		{
			$str .= $val."transform:$data;".ln();
		}
		
		$str .= "}".ln();
		
		return $str;
	}
	
	public function matrix()
	{
		$arguments = func_get_args();
		
		if(isset($arguments[0]) && is_array($arguments[0]))
		{
			$arguments = $arguments[0];	
		}
		
		$this->transforms['matrix'] = "matrix(".$this->_params($arguments).")";
		
		return $this;
	}
	
	public function rotate($argument = '')
	{
		if( ! is_value($argument))
		{
			return $this;
		}
		
		if(is_numeric($argument))
		{
			$argument = $argument."deg";
		}
		$this->transforms['rotate'] = "rotate(".$this->_params($argument).")";
		
		return $this;
	}
	
	public function scale($x = 0, $y = 0)
	{
		if( ! ( is_value($x) || is_value($y) ) )
		{
			return $this;
		}
		
		if( ! ( is_numeric($x) || is_numeric($y)) )
		{
			return $this;
		}
		$this->transforms['scale'] = "scale(".$this->_params("$x,$y").")";
		
		return $this;
	}
	
	public function scalex($x = 0)
	{
		if( ! is_value($x))
		{
			return $this;
		}
		
		if( ! is_numeric($x) )
		{
			return $this;
		}
		$this->transforms['scalex'] = "scaleX(".$this->_params($x).")";
		
		return $this;
	}
	
	public function scaley($y = 0)
	{
		if( ! is_value($y))
		{
			return $this;
		}
		
		if( ! is_numeric($y) )
		{
			return $this;
		}
		$this->transforms['scaley'] = "scaleY(".$this->_params($y).")";
		
		return $this;
	}
	
	public function skew($x = '', $y = '')
	{
		if( ! ( is_value($x) || is_value($y) ) )
		{
			return $this;
		}
		
		if(is_numeric($x))
		{
			$x = $x."deg";
		}		
		if(is_numeric($y))
		{
			$y = $y."deg";
		}
		$this->transforms['skew'] = "skew(".$this->_params("$x,$y").")";
		
		return $this;
	}
	
	public function skewx($x = '')
	{
		if( ! is_value($x))
		{
			return $this;
		}
		
		if(is_numeric($x))
		{
			$x = $x."deg";
		}		
		
		$this->transforms['skewx'] = "skewX(".$this->_params($x).")";
		
		return $this;
	}
		
	public function skewy($y = '')
	{
		if( ! is_value($y))
		{
			return $this;
		}
		
		if(is_numeric($y))
		{
			$y = $y."deg";
		}		
		
		$this->transforms['skewy'] = "skewY(".$this->_params($y).")";
		
		return $this;
	}
	
	public function translate($x = 0, $y = 0)
	{
		if( ! ( is_value($x) || is_value($y) ) )
		{
			return $this;
		}
		
		if(is_numeric($x))
		{
			$x = $x."px";
		}		
		
		if($y !== 0)
		{
			if(is_numeric($y))
			{
				$y = $y."px";
			}
			
			$args = "$x,$y";		
		}
		else
		{
			$args = $x;	
		}
		
		$this->transforms['translate'] = "translate(".$this->_params($args).")";
		
		return $this;
	}
	
	public function translatex($x = 0)
	{
		if( ! is_value($x))
		{
			return $this;
		}
		
		if(is_numeric($x))
		{
			$x = $x."px";
		}		
		
		$this->transforms['translatex'] = "translateX(".$this->_params($x).")";
		
		return $this;
	}
	
	public function translatey($y = 0)
	{
		if( ! is_value($y))
		{
			return $this;
		}
		
		if(is_numeric($y))
		{
			$y = $y."px";
		}		
		
		$this->transforms['translatey'] = "translateY(".$this->_params($y).")";
		
		return $this;
	}
	
	public function create()
	{
		$transforms = '';
		if( ! empty($this->transforms))foreach($this->transforms as $trans)
		{
			$transforms .= $trans;
		}	
		
		$transforms = $this->_transform($transforms);
		$this->_default_variable();
		return $transforms;
	}
	
	protected function _default_variable()
	{
		if($this->selector !== 'this')  $this->selector = 'this';
		if( ! empty($this->transforms)) $this->transforms = array();
	}
}