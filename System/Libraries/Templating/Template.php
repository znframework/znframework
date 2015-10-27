<?php
class __USE_STATIC_ACCESS__Template
{
	/***********************************************************************************/
	/* TEMPLATE LIBRARY	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Template
	/* Versiyon: 2.0.0 October
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->Template, zn::$use->Template, uselib('Template')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Left Delimiter Değişkeni
	 *  
	 * Ayırıcı başlangıç karakteri bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $ldel = '{';
	
	/* Right Delimiter Değişkeni
	 *  
	 * Ayırıcı bitiş karakteri bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $rdel = '}';
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Parser::$method()"));	
	}
	
	/******************************************************************************************
	* DATA                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Metinsel ifadelerde ayrıştırma işlemi yapmak için kullanılır.			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @string => Metinsel veri.					 							  |
	| 2. array var @data => Değiştirilecek veriler.					  					      |
	|          																				  |
	| Örnek Kullanım: ->data('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function data($string = '', $data = array())
	{
		// Parametre konrolleri sağlanıyor.
		if( ! is_string($string) )
		{
			return Error::set(lang('Error', 'stringParameter', 'string'));	
		}
	
		// Veri dizisi boş değilse işlemleri gerçekleştir.
		if( ! empty($data) ) 
		{
			$space = '\s*';
			$all   = '.*';
		
			foreach( $data as $key => $val )
			{
				// Eleman dizi değilse değiştirme işlemi gerçekleştir.
				if( ! is_array($val) )
				{
					$key = $this->ldel.$space.$key.$space.$this->rdel;
					
					$string = preg_replace('/'.$key.'/', $val, $string);	
				}
				else
				{
					$allString = '';
					$newResult = '';
		
					if( ! empty($val) )
					{
						
						$kstart = $this->ldel.$space.$key.$space.$this->rdel;
						$kend   = $this->ldel.$space.'\/'.$space.$key.$space.$this->rdel;
						
						preg_match('/'.$kstart.$all.$kend.'/s', $string, $result);
						
						if( ! empty($result) )
						{
							// Bloğu değiştirme ve çoğalatma
							// işlemi gerçekleştir.
							foreach( $result as $res )
							{
								// Değiştirme işlemlerini gerçekleştir.
								foreach( $data[$key] as $item )
								{
									$newResult = preg_replace('/'.$kstart.'/', '', $res);
									$newResult = preg_replace('/'.$kend.'/', '', $newResult);	
									
									$allString .= $this->data($newResult, $item).eol();
								}
								
								$string = str_replace($res, $allString, $string);
							}
						}
					}
				}
			}
		}
		
		$pattern = array
		(
			// Döngüler
			'/\s*@(foreach\s*\(.*\))/' 	=> '<?php $1: ?>',
			'/\s*@(while\s*\(.*\))/' 	=> '<?php $1: ?>',
			'/\s*@(for\s*\(.*\))/' 		=> '<?php $1: ?>',
			
			// Karar Yapıları
			'/\s*@(elseif\s*\(.*\))/'  	=> '<?php $1: ?>',
			'/\s*@(if\s*\(.*\))/' 		=> '<?php $1: ?>',
			'/\s*@(switch\s*\(.*\))/' 	=> '<?php $1: ?>',
			'/\s*@(else\s*)/'			=> '<?php $1: ?>',
			'/\s*@(case\s*)((\'.*\'|\".*\"|[0-9])*)/' => '<?php $1 $2: ?>',		
			
			// Kapatma Blokları
			'/\s*@(endif)/' 			=> '<?php $1 ?>',
			'/\s*@(endforeach)/'   		=> '<?php $1 ?>',
			'/\s*@(endfor)/' 			=> '<?php $1 ?>',
			'/\s*@(endswhile)/' 		=> '<?php $1 ?>',
			'/\s*@(endswitch)/' 		=> '<?php $1 ?>',
			
			// Anahtar Kelimeler
			'/\s*@(break)/'  		 	=> '<?php $1 ?>',
			'/\s*@(continue)/'  	 	=> '<?php $1 ?>',
			'/\s*@(default)/'  	 		=> '<?php $1: ?>',
			
			// Yazdırılabilir Fonksiyonlar
			'/\s*@@((\w+|\$|::|\-\>)*\s*\(.*\))/' 	=> '<?php echo $1 ?>',	
			
			// Fonksiyonlar
			'/\s*@((\w+|\$|::|\-\>)*\s*\(.*\))/'  	=> '<?php $1; ?>',
			
			// Yazdırılabilir Değişkenler
			'/\s*@(\$\w+\s*)/' 	=> '<?php echo $1 ?>',
			
			// Açıklama Satırları
			'/\{\-\-/'			 		=> '<!--',
			'/\-\-\}/'			 		=> '-->',
			
			// Yazdırmak Tagları
			'/\{\{/'			 		=> '<?php echo ',
			'/\}\}/'			 		=> ' ?>',	
			
			// PHP Tagları
			'/\{\[/'			 		=> '<?php ',
			'/\]\}/'			 		=> ' ?>',
		);
			
		$string = preg_replace(array_keys($pattern), array_values($pattern), $string);
		
		if( is_array($data) )
		{
			extract($data, EXTR_OVERWRITE);
		}
		
		ob_start(); 
		@eval("?>$string");
		$content = ob_get_contents(); 
		ob_end_clean(); 
		
		if( ! empty($content) )
		{
			return $content;
		}
		else
		{
			$lastError = Error::last();
			Exceptions::table($lastError['message'], '', $lastError['line']);
		}
	}	
	
	/******************************************************************************************
	* DELIMITER                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Ayrıştırma karakterlerini değiştirmek için kullanılır.			      |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @ldel => Başlangıç ayrıştırıcı karakteri. Varsayılan:{					  |
	| 2. string var @4del => Bitiş ayrıştırıcı karakteri. Varsayılan:}	     				  |
	|          																				  |
	| Örnek Kullanım: ->delimiter('[', ']') 		  	 		         					  |
	|          																				  |
	******************************************************************************************/
	public function delimiter($ldel = "{", $rdel = "}")
	{
		if( is_string($ldel) && is_string($rdel) )
		{
			$this->ldel = '\\'.$ldel;
			$this->rdel = '\\'.$rdel;	
		}
		
		return $this;
	}
}