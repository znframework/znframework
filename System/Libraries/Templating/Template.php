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
		
		$regexChar      = '(([^@]|(\'\s*|\").*?(\s*\'|\s*\"))*)';
		$htmlRegexChar  = '.*?';
		
		$pattern = array
		(
			// HTML
			'/\s*\#end(\w+)/i' 									=> '</$1>',
			'/\#\#(\!*\w+)\s*\(('.$htmlRegexChar.')\)/i' 		=> '<$1 $2>',
			'/\s*\#\#(\w+)/i'									=> '</$1>',
			'/\#(\!*\w+)\s*\(('.$htmlRegexChar.')(\s*\,\s*('.$htmlRegexChar.'))*\)/i' => '<$1 $4>$2</$1>',
			'/\#(\!*\w+)\s*(\[('.$htmlRegexChar.')\])*\s*/i'	=> '<$1 $3>',
			'/\<(\!*\w+)\s+\>/i' 								=> '<$1>',	
			
			// IF - ELSE - ENDIF
			'/@(if)\s*(\('.$htmlRegexChar.'\))'.eol().'\s*/'  => '<?php $1$2: ?>',
			'/\s*@(elseif)\s*(\('.$htmlRegexChar.'\))'.eol().'\s*/'  => '<?php $1$2: ?>',
			'/\s*@(endif)/' 			=> '<?php $1 ?>',
			
			// FOREACH - ENDFOREACH
			'/@(foreach)\s*(\('.$htmlRegexChar.'\))'.eol().'\s*/'  => '<?php $1$2: ?>',
			'/\s*@(endforeach)/'   		=> '<?php $1 ?>',
			
			// FOR - ENDFOR
			'/@(for)\s*(\('.$htmlRegexChar.'\))'.eol().'\s*/'  => '<?php $1$2: ?>',
			'/\s*@(endfor)/' 			=> '<?php $1 ?>',
			
			// WHILE - ENDWHILE
			'/@(while)\s*(\('.$htmlRegexChar.'\))'.eol().'\s*/'  => '<?php $1$2: ?>',
			'/\s*@(endswhile)/' 		=> '<?php $1 ?>',			
			
			// KEYWORDS
			'/@(break)/'  	 => '<?php $1 ?>',
			'/@(continue)/'  => '<?php $1 ?>',
			'/@(default)/'   => '<?php $1: ?>',
			
			// PRINTABLE FUNCTIONS
			'/@@((\w+|\$|::|\s*\-\>\s*)*\s*\('.$regexChar.'\))/' => '<?php echo $1 ?>',		
			
			// FUNCTIONS
			'/@((\w+|\$|::|\s*\-\>\s*)*\s*\('.$regexChar.'\))/'  => '<?php $1 ?>',
			
			
			// PRITABLE VARIABLES
			'/@(\$\w+(\$|::|\s*\-\>\s*|\('.$regexChar.'\))*)/' 	 => '<?php echo $1 ?>',
			
			// COMMENTS
			'/\{\-\-\s*('.$htmlRegexChar.')\s*\-\-\}/'			 => '<!--$1-->',
			
			// HTMLENTITES PRINT
			'/\{\{\{\s*('.$htmlRegexChar.')\s*\}\}\}/'	=> '<?php echo htmlentities($1) ?>',
			
			// PRINT
			'/\{\{(\s*'.$htmlRegexChar.')\s*\}\}/'		=> '<?php echo $1 ?>',
			
			// PHP TAGS
			'/\{\[\s*('.$htmlRegexChar.')\s*\]\}/'		=> '<?php $1 ?>',
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
		
		if( $lastError = Error::last() )
		{
			Exceptions::table('', $lastError['message'], '', $lastError['line']);
		}
		else
		{
			return $content;
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