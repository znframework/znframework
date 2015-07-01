<?php
/************************************************************/
/*                     BLADE COMPONENT                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* SECTION                                                                                 *
*******************************************************************************************
| Sınıfı Kullanırken      :	$this->cblade->       									      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class CBlade
{
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
	public function page($page = '', $data = '', $ob_get_contents = false)
	{
		$page_content = Import::page($page, $data, true);
		
		$page_content = $this->data($page_content, $data);
		
		if( $ob_get_contents === true )
		{
			return $page_content;
		}
		
		echo $page_content;
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
	public function data($str = '', $data = array())
	{
		if( ! is_string($str) )
		{
			return false;	
		}
		
		$bladechars = array
		(	
			'{{{'	=> '<?php echo "',
			'}}}'	=> '" ?>',
			'{{--' 	=> '<!-- ',
			'--}}'  => ' -->',
			'{{' 	=> '<?php echo ',
			'}}' 	=> ' ?>',	
		);

		$newdata = str_replace(array_keys($bladechars), array_values($bladechars), $str);
		
		$newdatas = array();

		preg_match_all('/\B@.+\B/', $newdata, $matchdata);
		
		$newval = '';
		
		if( ! empty($matchdata[0]) )foreach($matchdata[0] as $val)
		{
			$new = str_replace('@', '??', $val);
			$newdatas[$val] = $new.' ?>';
		}
	
		$newdata = str_replace(array_keys($newdatas), array_values($newdatas), $newdata);
		
		$newdata = preg_replace('/\?\?/', '<?php ', $newdata);
		
		if( is_array($data) )
		{
			extract($data, EXTR_OVERWRITE, 'extract');
		}
		
		ob_start(); 
		eval("?>$newdata");
		$content = ob_get_contents(); 
		ob_end_clean(); 
		
		return $content;
	}	
}