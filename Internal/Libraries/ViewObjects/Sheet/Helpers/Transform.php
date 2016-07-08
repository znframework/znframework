<?php
namespace ZN\ViewObjects\Sheet\Helpers;

use ZN\ViewObjects\SheetTrait;

class Transform
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	use SheetTrait;
	
	use \CallUndefinedMethodTrait;
	
	/* Transforms Değişkeni
	 *  
	 * Dönüşüm efektlerine ait kullanacak
	 * verileri tutması için oluşturulmuştur.
	 *
	 */
	protected $transforms = [];
	
	// Protected Params Fonkisyonu
	// Css yöntemleri için oluşturulmuştur.
	protected function _params($data)
	{
		$arguments = $data;
		$argument  = '';
		
		if( is_array($data) )
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
	
	// Protected transform nesnesi
	protected function _transform($data)
	{
		$str  = '';
		$str .= $this->selector."{".EOL;	
		
		foreach($this->browsers as $val)
		{
			$str .= $val."transform:$data;".EOL;
		}
		
		$str .= "}".EOL;
		
		return $str;
	}
	
	/******************************************************************************************
	* MATRIX                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Css3 matrix transform nesnesinin kullanımıdır.        		  		  |
	|															                              |
	| Parametreler: Argüment parametresi vardır.                                              |
	| 1. arguments var @args => Matrix kullanımda girilen 6 adet değer girilir.		          |
	|          																				  |
	| Örnek Kullanım: ->matrix(0, 1, 1, 0, 20, 50) 						 		 		  	  |
	|          																				  |
	******************************************************************************************/
	public function matrix(...$arguments)
	{
		if( isset($arguments[0]) && is_array($arguments[0]) )
		{
			$arguments = $arguments[0];	
		}
		
		$this->transforms['matrix'] = "matrix(".$this->_params($arguments).")";
		
		return $this;
	}
	
	/******************************************************************************************
	* MATRIX                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Css3 rotate transform nesnesinin kullanımıdır.        		  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric/string var @argument => Sayılsal veri girilirken "deg" ifadesine gerek yoktur|
	|          																				  |
	| Örnek Kullanım: ->rorate(90) // 90deg	     						 		 		  	  |
	|          																				  |
	******************************************************************************************/
	public function rotate($argument = '')
	{
		if( ! is_scalar($argument) )
		{
			\Errors::set('Error', 'valueParameter', 'argument');
			return $this;
		}
		
		// Parametre sayısal olduğu taktirde
		// deg ibraresini ekleyetiyoruz.
		if( is_numeric($argument) )
		{
			$argument = $argument."deg";
		}
		
		$this->transforms['rotate'] = "rotate(".$this->_params($argument).")";
		
		return $this;
	}
	
	
	/******************************************************************************************
	* SCALE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Css3 scale transform nesnesinin kullanımıdır.        		  		      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @x => X parametresidir.												  |	 
	| 1. numeric var @y => Y parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->scale(10, 20)			     						 		 		  |
	|          																				  |
	******************************************************************************************/
	public function scale($x = 0, $y = 0)
	{
		if( ! is_numeric($x) || ! is_numeric($y) )
		{
			\Errors::set('Error', 'numericParameter', 'x & y');
			return $this;
		}
		
		$this->transforms['scale'] = "scale(".$this->_params("$x,$y").")";
		
		return $this;
	}
	
	/******************************************************************************************
	* SCALEX                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Css3 scaleX transform nesnesinin kullanımıdır.        		  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @x => X parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->scaleX(10)			     						 		 		      |
	|          																				  |
	******************************************************************************************/
	public function scaleX($x = 0)
	{	
		if( ! is_numeric($x) )
		{
			\Errors::set('Error', 'numericParameter', 'x');
			return $this;
		}
		
		$this->transforms['scalex'] = "scaleX(".$this->_params($x).")";
		
		return $this;
	}
	
	/******************************************************************************************
	* SCALEY                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Css3 scaleY transform nesnesinin kullanımıdır.        		  		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @y => Y parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->scaleY(10)			     						 		 		      |
	|          																				  |
	******************************************************************************************/
	public function scaleY($y = 0)
	{
		if( ! is_numeric($y) )
		{
			\Errors::set('Error', 'numericParameter', 'y');
			return $this;
		}
		
		$this->transforms['scaley'] = "scaleY(".$this->_params($y).")";
		
		return $this;
	}
	
	/******************************************************************************************
	* SKEW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Css3 skew transform nesnesinin kullanımıdır.        		  		      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @x => X parametresidir.												  |	 
	| 1. numeric var @y => Y parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->skew(10, 20)			     						 		 		  |
	|          																				  |
	******************************************************************************************/
	public function skew($x = '', $y = '')
	{
		if( ! is_scalar($x) || ! is_scalar($y) )
		{
			\Errors::set('Error', 'valueParameter', 'x & y');
			return $this;
		}
		
		if( is_numeric($x) )
		{
			$x = $x."deg";
		}		
		if( is_numeric($y) )
		{
			$y = $y."deg";
		}
		
		$this->transforms['skew'] = "skew(".$this->_params("$x,$y").")";
		
		return $this;
	}
	
	/******************************************************************************************
	* SKEWX                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Css3 skewX transform nesnesinin kullanımıdır.        		  		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @x => X parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->skewx(10)			     						 		 		      |
	|          																				  |
	******************************************************************************************/
	public function skewX($x = '')
	{
		if( ! is_scalar($x) )
		{
			\Errors::set('Error', 'valueParameter', 'x');
			return $this;
		}
		
		if( is_numeric($x) )
		{
			$x = $x."deg";
		}		
		
		$this->transforms['skewx'] = "skewX(".$this->_params($x).")";
		
		return $this;
	}
		
	/******************************************************************************************
	* SKEWY                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Css3 skewY transform nesnesinin kullanımıdır.        		  		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @y => Y parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->skewy(10)			     						 		 		      |
	|          																				  |
	******************************************************************************************/
	public function skewY($y = '')
	{
		if( ! is_scalar($y) )
		{
			\Errors::set('Error', 'valueParameter', 'y');
			return $this;
		}
		
		if( is_numeric($y) )
		{
			$y = $y."deg";
		}		
		
		$this->transforms['skewy'] = "skewY(".$this->_params($y).")";
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSLATE                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Css3 translate transform nesnesinin kullanımıdır.        		  		  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @x => X parametresidir.												  |	 
	| 1. numeric var @y => Y parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->translate(10, 20)			     						 		      |
	|          																				  |
	******************************************************************************************/
	public function translate($x = 0, $y = 0)
	{
		if( ! is_scalar($x) || ! is_scalar($y) )
		{
			\Errors::set('Error', 'valueParameter', 'x & y');
			return $this;
		}
		
		if( is_numeric($x) )
		{
			$x = $x."px";
		}		
		
		if( $y !== 0 )
		{
			if( is_numeric($y) )
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
	
	/******************************************************************************************
	* TRANSLATEX                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Css3 translateX transform nesnesinin kullanımıdır.        		  	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @x => X parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->translatex(10)			     						 		 		  |
	|          																				  |
	******************************************************************************************/
	public function translateX($x = 0)
	{
		if( ! is_scalar($x) )
		{
			\Errors::set('Error', 'valueParameter', 'x');
			return $this;
		}
		
		if( is_numeric($x) )
		{
			$x = $x."px";
		}		
		
		$this->transforms['translatex'] = "translateX(".$this->_params($x).")";
		
		return $this;
	}
	
	/******************************************************************************************
	* TRANSLATEY                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Css3 translateY transform nesnesinin kullanımıdır.        		  	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @y => Y parametresidir.												  |	 
	|          																				  |
	| Örnek Kullanım: ->translatey(10)			     						 		 		  |
	|          																				  |
	******************************************************************************************/
	public function translateY($y = 0)
	{
		if( ! is_scalar($y) )
		{
			\Errors::set('Error', 'valueParameter', 'y');
			return $this;
		}
		
		if( is_numeric($y) )
		{
			$y = $y."px";
		}		
		
		$this->transforms['translatey'] = "translateY(".$this->_params($y).")";
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Transform nesnesini oluşturmak için nihai kullanılan yöntemdir.		  |
	|          																				  |
	******************************************************************************************/
	public function create()
	{
		$transforms = '';
		
		if( ! empty($this->transforms) ) foreach( $this->transforms as $trans )
		{
			$transforms .= $trans;
		}	
		
		$transforms = $this->_transform($transforms);
		
		$this->_defaultVariable();
		
		return $this->_tag($transforms);
	}
	
	// Değişkenler varsayılan ayarlarına getiriliyor.
	protected function _defaultVariable()
	{
		if( $this->selector !== 'this' ) $this->selector = 'this';
		if( ! empty($this->transforms) ) $this->transforms = [];
	}
}