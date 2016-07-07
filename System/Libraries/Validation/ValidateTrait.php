<?php
namespace ZN\Validation;

trait ValidateTrait
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	/* Settings Değişkeni
	 *  
	 * Ayarlar bilgisini tutar.
	 *
	 */
	protected $settings = [];
	
	//----------------------------------------------------------------------------------------------------
	// name()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $name
	//
	//----------------------------------------------------------------------------------------------------
	public function name($name = '')
	{
		$this->settings['name'] = $name;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// method()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $method
	//
	//----------------------------------------------------------------------------------------------------
	public function method($method = 'post')
	{
		$this->settings['method'] = $method;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// value()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $value
	//
	//----------------------------------------------------------------------------------------------------
	public function value($value = '')
	{
		$this->settings['value'] = $value;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// required()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function required()
	{
		$this->settings['config'][] = 'required';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// numeric()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function numeric()
	{
		$this->settings['config'][] = 'numeric';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// match()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $match
	//
	//----------------------------------------------------------------------------------------------------
	public function match($match = '')
	{
		$this->settings['config']['match'] = $match;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// matchPassword()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $match
	//
	//----------------------------------------------------------------------------------------------------
	public function matchPassword($match = '')
	{
		$this->settings['config']['matchPassword'] = $match;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// oldPassword()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $oldPassword
	//
	//----------------------------------------------------------------------------------------------------
	public function oldPassword($oldPassword = '')
	{
		$this->settings['config']['oldPassword'] = $oldPassword;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// compare()
	//----------------------------------------------------------------------------------------------------
	//
	// @param numeric $min
	// @param numeric $max
	//
	//----------------------------------------------------------------------------------------------------
	public function compare($min = '', $max = '')
	{
		$this->settings['config']['minchar'] = $min;
		$this->settings['config']['maxchar'] = $max;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// validate()
	//----------------------------------------------------------------------------------------------------
	//
	// @param args
	//
	//----------------------------------------------------------------------------------------------------
	public function validate(...$args)
	{
		$this->settings['validate'] = $args;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// secure()
	//----------------------------------------------------------------------------------------------------
	//
	// @param args
	//
	//----------------------------------------------------------------------------------------------------
	public function secure(...$args)
	{
		$this->settings['secure'] = $args;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// pattern()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $pattern
	// @param string $char
	//
	//----------------------------------------------------------------------------------------------------
	public function pattern($pattern = '', $char = '')
	{
		$this->settings['config']['pattern'] = presuffix($pattern).$char;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// phone()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $design
	//
	//----------------------------------------------------------------------------------------------------
	public function phone($design = '')
	{
		if( empty($design) )
		{
			$this->settings['config'][] = 'phone';
		}
		else
		{
			$this->settings['config']['phone'] = $design;
		}
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// alpha()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function alpha()
	{
		$this->settings['config'][] = 'alpha';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// alnum()
	//----------------------------------------------------------------------------------------------------
	//
	// @param void
	//
	//----------------------------------------------------------------------------------------------------
	public function alnum()
	{
		$this->settings['config'][] = 'alnum';
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// captcha()
	//----------------------------------------------------------------------------------------------------
	//
	// @param string $captcha
	//
	//----------------------------------------------------------------------------------------------------
	public function captcha($captcha = '')
	{
		$this->settings['config']['captcha'] = $captcha;
		
		return $this;
	}
	
	/******************************************************************************************
	* IDENDITY                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Kimlik numarası kontrolü.		        		          				  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @no => Kontrol edilecek kimlik numarası bilgisi.                         |
	|          																				  |
	| Örnek Kullanım: identity(123213); // Çıktı: true veya false      		      			  |
	|          																				  |
	******************************************************************************************/
	public function identity($no = '')
	{
		if( ! is_numeric($no) ) 
		{
			return \Errors::set('Error', 'numericParameter', 'no');
		}
		
		$numone 	= ($no[0] + $no[2] + $no[4] + $no[6]  + $no[8]) * 7;
		$numtwo 	= $no[1] + $no[3] + $no[5] + $no[7];
		$result 	= $numone - $numtwo;
		$tenth  	= $result%10;
		$total  	= ($no[0] + $no[1] + $no[2] + $no[3] + $no[4] + $no[5] + $no[6] + $no[7] + $no[8] + $no[9]);
		$elewenth 	= $total%10;
		
		if($no[0] == 0)
		{
			return false;
		}
		elseif(strlen($no) != 11)
		{
			return false;
		}
		elseif($no[9] != $tenth)
		{
			return false;
		}
		elseif($no[10] != $elewenth)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* E-MAIL                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: E-posta kontrolü kontrolü.		        		          		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @data => Kontrol edilecek e-posta bilgisi.                               |
	|          																				  |
	| Örnek Kullanım: email('bilgi@zntr.net'); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public function email($data = '')
	{
		if( ! is_string($data) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'data');
		}
		if( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $data) ) 
		{
			return false; 
		}
		else 
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* URL                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: URL adres kontrolü kontrolü.		        		          		      |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @data => Kontrol edilecek url adres bilgisi.                             |
	|          																				  |
	| Örnek Kullanım: url('zntr.net'); // Çıktı: true veya false      		      	          |
	|          																				  |
	******************************************************************************************/
	public function url($data = '')
	{
		if( ! is_string($data) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'data');
		}
		if( ! preg_match('#^(\w+:)?//#i', $data) ) 
		{
			return false; 
		}
		else 
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* SPECIAL CHAR                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Özel karakter kontrolü kontrolü.		        		          		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. numeric var @data => Kontrol edilecek metin bilgisi.                                 |
	|          																				  |
	| Örnek Kullanım: specialChar('zntr.net'); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public function specialChar($data = '')
	{
		if( ! is_scalar($data) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'data');
		}
		
		if( ! preg_match('#[!\'^\#\\\+\$%&\/\(\)\[\]\{\}=\|\-\?:\.\,;_ĞÜŞİÖÇğüşıöç]+#', $data) ) 
		{
			return false; 
		}
		else 
		{
			return true;
		}
	}
	
	/******************************************************************************************
	* MAXCHAR                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Maksimum karakter kontrolü kontrolü.		        		          	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @data => Kontrol edilecek metin bilgisi.                                 |
	| 2. numeric var @char => Maksimum karakter sayısı.                                       |
	|          																				  |
	| Örnek Kullanım: maxchar('zntr.net', 10); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public function maxchar($data = '', $char = '')
	{
		if( ! is_scalar($data) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'data');
		}
		
		if( ! is_numeric($char) ) 
		{
			return \Errors::set('Error', 'numericParameter', 'char');
		}
		
		if( strlen($data) <= $char ) 
		{
			return true; 
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* MINCHAR                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Minimum karakter kontrolü kontrolü.		        		          	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. numeric var @data => Kontrol edilecek metin bilgisi.                                 |
	| 2. numeric var @char => Minimum karakter sayısı.                                        |
	|          																				  |
	| Örnek Kullanım: minchar('zntr.net', 5); // Çıktı: true veya false      		      	  |
	|          																				  |
	******************************************************************************************/
	public function minchar($data = '', $char = '')
	{
		if( ! is_scalar($data) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'data');
		}
		if( ! is_numeric($char) ) 
		{
			return \Errors::set('Error', 'numericParameter', 'char');
		}
		
		if( strlen($data) >= $char ) 
		{
			return true; 
		}
		else 
		{
			return false;
		}
	}
}