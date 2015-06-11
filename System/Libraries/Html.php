<?php
/************************************************************/
/*                     LIBRARY HTML                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* HTML                                                                               	  *
*******************************************************************************************
| Sınıfı Kullanırken : html::, $this->html, zn::$use->html, uselib('html')	  	  	      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Html
{
	// Function: self::attributes()
	// İşlev: Girilen dizi bilgisini html etiketlerinin özellik değer biglisi türüne dönüştürür.
	// Parametreler
	// @attributes = Özellik değer çifti içeren dizi bilgisi. Örnek array("a" => "b") dizi verisi, a="b" verisine dönüşür.
	// Dönen Değer: Dönüştürülmüş veri.
	protected static function attributes($attributes = '')
	{
		$attribute = '';
		
		if( is_array($attributes) )
		{
			foreach($attributes as $key => $values)
			{
				if( is_numeric($key) )
				{
					$key = $values;
				}
				
				$attribute .= ' '.$key.'="'.$values.'"';
			}	
		}
		
		return $attribute;	
	}

	// Function: html_element()
	// İşlev: Herhangi bir html elemanını oluşturmak için kullanılır.
	// Parametreler
	// @element = Hangi html elemanı kullanılacağı. Örnek: strong
	// @str = Html etiketinin uygulanacağı veri. Örnek: veri
	// @attributes = Etikete uygulanacak özellik değer çiftleri. array("id" => "12")
	// Dönen Değer: <strong id="12>veri</strong>
	public static function element($element = '', $str = '', $attributes = "")
	{
		if( ! is_value($element) ) 
		{
			return false;
		}
		
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<'.$element.self::attributes($attributes).'>'.$str.'</'.$element.'>';
	}	

	// Function: multi_attr()
	// İşlev: Bir veriye birden fazla html etiketi uygulamak için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @array = Uygulanacak html etikeleri. array("b", "i" => array("id" => 2))
	// Dönen Değer: Etiketlerin uygulanmış hali.
	public static function multi_attr($str = '', $array = array())
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		if( is_array($array) )
		{
			$open = '';
			$close = '';
			$att = '';
			
			foreach($array as $k => $v)
			{
				if( ! is_numeric($k) )
				{
					$element = $k;	
					
					if( ! is_array($v) )
					{
						$att = ' '.$v;
					}
					else
					{
						$att = self::attributes($v);	
					}
				}
				else
				{
					$element = $v;	
				}
				
				$open .= '<'.$element.$att.'>';
				$close = '</'.$element.'>'.$close;
			}
		}
		else
		{
			return $str;
		}
		
		return $open.$str.$close;
	}

	// Function: heading()
	// İşlev: Başlık etiketi uygulamak için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @type = Uygulanacak olan başlık etiketinin türü. h1, h2, h3...
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function heading($str = '', $type = 3, $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		if( ! is_numeric($type) ) 
		{
			$type = 3;
		}
		
		return '<h'.$type.self::attributes($attributes).'>'.$str.'</h'.$type.'>';
	}	

	// Function: font()
	// İşlev: Metne renk, biçim ve boyut eklemek için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function font($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<font'.self::attributes($attributes).'>'.$str.'</font>';
	}	

	// Function: parag()
	// İşlev: Html <p> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function parag($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		return	'<p'.self::attributes($attributes).'>'.$str.'</p>';
	}

	// Function: bold()
	// İşlev: Html <b> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function bold($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<bold'.self::attributes($attributes).'>'.$str.'</bold>';
	}

	// Function: strong()
	// İşlev: Html <strong> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function strong($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<strong'.self::attributes($attributes).'>'.$str.'</strong>';
	}

	// Function: italic()
	// İşlev: Html <i> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function italic($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<em'.self::attributes($attributes).'>'.$str.'</em>';
	}

	// Function: underline()
	// İşlev: Html <u> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function underline($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<u'.self::attributes($attributes).'>'.$str.'</u>';
	}

	// Function: overline()
	// İşlev: Html <del> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function overline($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<del'.self::attributes($attributes).'>'.$str.'</del>';
	}

	// Function: overtext()
	// İşlev: Html <sup> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function overtext($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<sup'.self::attributes($attributes).'>'.$str.'</sup>';
	}

	// Function: undertext()
	// İşlev: Html <sub> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function undertext($str = '', $attributes = "")
	{
		if( ! is_value($str) ) 
		{
			return false;
		}
		
		return '<sub'.self::attributes($attributes).'>'.$str.'</sub>';
	}

	// Function: space()
	// İşlev: İstenilen sayıda boşluk eklemek için kullanılır.
	// Parametreler
	// @count = Boşluk sayısı.
	public static function space($count = 5)
	{
		if( ! is_numeric($count) ) 
		{
			$count = 5;
		}
		
		return str_repeat("&nbsp;", $count);
	}

	// Function: anchor()
	// İşlev: Html <a> etiketini uygulamak için kullanılır
	// Parametreler
	// @url = Köprüye tıklanınca gidilecek url adresi.
	// @value = Köprünün görünen değeri.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function anchor($url = '', $value = '', $_attributes = '')
	{
		if( ! is_string($url) )
		{
			return false;
		}
		
		if( ! is_value($value) ) 
		{
			return false;
		}
		
		if( ! is_url($url) && ! strstr($url, '#'))
		{ 
			$url = site_url($url);
		}
		
		if( empty($value) )
		{ 
			$value = $url;
		}
		
		return '<a'.self::attributes($_attributes).' href="'.$url.'">'.$value.'</a>';	
	}

	// Function: mailto()
	// İşlev: Html <a> etiketini uygulamak için kullanılır.
	// Parametreler
	// @mail = E-posta adresi.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function mailto($mail = '', $_attributes = '')
	{
		if( ! is_string($mail) ) 
		{
			return false;
		}
		
		if( ! is_email($mail) ) 
		{
			return false;
		}
		
		return '<a'.self::attributes($_attributes).' href="mailto:'.$mail.'">'.$mail.'</a>';	
	}

	// Function: image()
	// İşlev: Html <img> etiketini uygulamak için kullanılır.
	// Parametreler
	// @src = Resmin kaynağı.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function image($src = '', $_attributes = '')
	{
		if( ! is_string($src) ) 
		{
			return false;
		}
		
		if( ! is_url($src) ) 
		{
			$src = base_url($src);
		}
		
		if( ! isset($_attributes["title"]) )
		{ 
			$title = 'title=""'; 
		}
		else
		{ 
			$title = '';
		}
		
		if( ! isset($_attributes["alt"]) )
		{ 
			$alt = 'alt=""'; 
		}
		else
		{ 
			$alt = '';
		}
		
		return '<img src="'.$src.'"'.self::attributes($_attributes).' '.$title.' '.$alt.' />';	
	}

	// Function: br()
	// İşlev: Html <br> etiketini uygulamak için kullanılır.
	// Parametreler
	// @count = Kaç alt satır bırakılacağı.
	public static function br($count = 1)
	{
		if( ! is_numeric($count) ) 
		{
			$count = 1;
		}
		
		return str_repeat("<br />", $count);
	}

	// Function: meta()
	// İşlev: Html <meta> etiketini uygulamak için kullanılır.
	// Parametreler
	// @name = Meta'nın isim bilgisi.
	// @content = Meta'nın içerik bilgisi.
	// @type = Meta isim bilgisinin türü. Parametrenin alabileceği değerler: name, http
	// Dönen Değer: Etiketin uygulanmış hali.
	public static function meta($name = '', $content = '' ,$type = 'name')
	{
		if( ! is_string($type) )
		{
			$type = 'name';
		}
		
		if( ! is_value($content) ) 
		{
			$content = '';
		}
		
		if( ! is_array($name) )
		{
			if( $type === 'name' && $name !== '' ) 
			{
				$name = ' name="'.$name.'"'; 
			}
			elseif( $type === 'http' && $name !== '' )
			{ 
				$name = ' http-equiv="'.$name.'"'; 
			}
			else
			{
				$name = '';
			}
			
			if( $content !== '' ) 
			{
				$content = ' content="'.$content.'"';	
			}
			else
			{ 
				$content = '';
			}
			
			return '<meta'.$name.$content.' />'."\n";
		}
		else
		{
			$metas = '';
			
			foreach($name as $val)
			{
				if( ! isset($val['name']) )
				{ 
					$val['name'] = '';
				}
				
				if( ! isset($val['content']) ) 
				{
					$val['content'] = '';
				}
				
				if( ! isset($val['type']) )
				{ 
					$val['type'] = 'name';
				}
				
				if( $val['type'] !== '' && $val['type'] === 'http' )
				{ 
					$type = ' http-equiv="'.$val['name'].'"';
				}
				
				if( $val['type'] !== '' && $val['type'] === 'name' )
				{
					$type = ' name="'.$val['name'].'"';			
				}
				
				if( $val['content'] !== '' )
				{
					$content = ' content="'.$val['content'].'"';
				}
				else
				{
					$content = '';
				}
				
				$metas .= '<meta'.$type.$content.' />'."\n";
			}
				
			return $metas;
		}
	}
}



