<?php
class __USE_STATIC_ACCESS__Parser
{
	/***********************************************************************************/
	/* PARSER LIBRARY	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Parser
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->Parser, zn::$use->Parser, uselib('Parser')
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
	* VIEW                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Görünüm sayfasında ayrıştırma işlemi yapmak için kullanılır.			  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Views/Pages/ dizininde yer alan sayfa ismi.					  |
	| 2. array var @data => Değiştirilecek veriler.					  					      |
	| 3. boolean var @output => Direk çıktı üretilsin mi, değer mi döndürülsün?.			  |
	|          																				  |
	| Örnek Kullanım: ->view('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function view($page = '', $data = array(), $output = false)
	{
		$stringData = Import::page($page, $data, true);
		
		$return = $this->data($stringData, $data);
		
		if( $output === true )
		{
			return $return;
		}
		
		echo $return;
	}
	
	/******************************************************************************************
	* PAGE / VIEW                                                                             *
	*******************************************************************************************
	| Genel Kullanım: Görünüm sayfasında ayrıştırma işlemi yapmak için kullanılır.			  |
	|															                              |
	| Parametreler: 3 parametresi vardır.                                                     |
	| 1. string var @page => Views/Pages/ dizininde yer alan sayfa ismi.					  |
	| 2. array var @data => Değiştirilecek veriler.					  					      |
	| 3. boolean var @output => Direk çıktı üretilsin mi, değer mi döndürülsün?.			  |
	|          																				  |
	| Örnek Kullanım: ->page('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function page($page = '', $data = array(), $output = false)
	{
		return $this->view($page, $data, $output);
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
		if( ! is_string($string) || ! is_array($data) )
		{
			return Error::set(lang('Error', 'stringParameter', 'string'));	
		}
		
		// Veri dizisi boş değilse işlemleri gerçekleştir.
		if( ! empty($data) ) 
		{
			$space = '\s*';
			$all   = '.*';
		
			foreach($data as $key => $val)
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
							foreach($result as $res)
							{
								// Değiştirme işlemlerini gerçekleştir.
								foreach($data[$key] as $item)
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
		
		return $string;
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