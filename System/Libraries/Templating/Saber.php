<?php
class __USE_STATIC_ACCESS__Saber
{
	/***********************************************************************************/
	/* SABER LIBRARY	     	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Saber
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: Saber::, $this->Saber, zn::$use->Saber, uselib('Saber')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "Template::$method()"));	
	}
	
	/******************************************************************************************
	* PAGE                                                                             		  *
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
	public function page($page = '', $data = '', $obGetContents = false)
	{
		$pageContent = Import::page($page, $data, true);
		
		$pageContent = $this->data($pageContent, $data);
		
		if( $obGetContents === true )
		{
			return $pageContent;
		}
		
		echo $pageContent;
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
	| Örnek Kullanım: ->view('test', array('test' => 'deneme'))         					  |
	|          																				  |
	******************************************************************************************/
	public function view($page = '', $data = array(), $output = false)
	{
		return $this->page($page, $data, $output);
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
	public function data($data = '', $datas = array())
	{
		$pattern = array
		(
			'/(\w+)\s*(\((.*)\))*\s*\{/' => '<$1 $3>',
			'/\}\s*(\w+)/' => '</$1>'
		);

		$data = preg_replace(array_keys($pattern), array_values($pattern), $data);

		$saberChars = array
		(	
			'[[e'	=> '<?php echo "',
			'e]]'	=> '" ?>',
			'[c' 	=> '<!-- ',
			'c]'  => ' -->',
			'[e' 	=> '<?php echo ',
			'e]' 	=> ' ?>',	
			'[p'    => '<?php',
			'p]'  	=> '?>'
  		);

  		$data = preg_replace('/\<(\w+)\s+\>/', '<$1>', $data);

		$data = str_replace(array_keys($saberChars), array_values($saberChars), $data);

		if( is_array($datas) )
		{
			extract($datas, EXTR_OVERWRITE, 'extract');
		}

		ob_start(); 
		eval("?>$data");
		$content = ob_get_contents(); 
		ob_end_clean(); 
		
		return $content;
	}
}