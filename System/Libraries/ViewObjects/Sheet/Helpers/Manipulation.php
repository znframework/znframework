<?php
namespace ZN\ViewObjects\Sheet\Helpers;

use ZN\ViewObjects\SheetTrait;

class Manipulation
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
	
	/* Manipulation Değişkeni
	 *  
	 * Değişiklik bilgisini tutması 
	 * için oluşturulumuştur. 
	 */
	protected $manipulation;

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
	public function attr($attr = [])
	{		
		if( ! is_array($attr) )
		{
			return \Errors::set('Error', 'arrayParameter', 'attr');	
		}

		$str  = $this->selector."{".EOL;	
		$str .= $this->_attr($attr).EOL;
		$str .= "}".EOL;
		
		$this->_defaultVariable();
		
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
			$this->manipulation['file'] = \File::contents($this->manipulation['filename']);
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
	| Örnek Kullanım: ->getSelector('.test');			 		         					  |
	|          																				  |
	******************************************************************************************/
	public function getSelector($selector = '')
	{
		if( ! is_string($selector) )
		{
			return \Errors::set('Error', 'stringParameter', 'selector');
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
	| Örnek Kullanım: ->setSelector('.test', array('color' => 'red'));			 		      |
	|          																				  |
	******************************************************************************************/
	public function setSelector($selector = '', $attr = [])
	{
		if( ! is_string($selector) || ! is_array($attr) )
		{
			\Errors::set('Error', 'stringParameter', 'selector');	
			\Errors::set('Error', 'arrayParameter', 'attr');
			
			return false;
		}	

		$file = $this->manipulation['file'];
		
		$value = $this->selector($selector)->attr($attr);
		
		$output = $this->_manipulation($selector);
		
		$output = str_replace($output, $value , $file);
		
		\File::write($this->manipulation['filename'], $output);
	}
	
	// Değişkenler varsayılan ayarlarına getiriliyor.
	protected function _defaultVariable()
	{
		$this->attr = NULL;
		$this->selector = 'this';
	}
}