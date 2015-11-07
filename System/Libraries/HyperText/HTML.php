<?php
class __USE_STATIC_ACCESS__HTML
{
	/***********************************************************************************/
	/* HTML LIBRARY						                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: HTML
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: html::, $this->html, zn::$use->html, uselib('html')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	use HyperTextCommonTrait;
	
	/******************************************************************************************
	* CALL                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Geçersiz fonksiyon girildiğinde çağrılması için.						  |
	|          																				  |
	******************************************************************************************/
	public function __call($method = '', $param = '')
	{	
		die(getErrorMessage('Error', 'undefinedFunction', "HTML::$method()"));	
	}

	// Function: html_element()
	// İşlev: Herhangi bir html elemanını oluşturmak için kullanılır.
	// Parametreler
	// @element = Hangi html elemanı kullanılacağı. Örnek: strong
	// @str = Html etiketinin uygulanacağı veri. Örnek: veri
	// @attributes = Etikete uygulanacak özellik değer çiftleri. array("id" => "12")
	// Dönen Değer: <strong id="12>veri</strong>
	public function element($element = '', $str = '', $attributes = "")
	{
		if( ! isValue($element) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'element'));	
		}
		
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<'.$element.$this->attributes($attributes).'>'.$str.'</'.$element.'>';
	}	

	// Function: multiAttr()
	// İşlev: Bir veriye birden fazla html etiketi uygulamak için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @array = Uygulanacak html etikeleri. array("b", "i" => array("id" => 2))
	// Dönen Değer: Etiketlerin uygulanmış hali.
	public function multiAttr($str = '', $array = array())
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
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
						$att = $this->attributes($v);	
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
	public function heading($str = '', $type = 3, $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		if( ! is_numeric($type) ) 
		{
			$type = 3;
		}
		
		return '<h'.$type.$this->attributes($attributes).'>'.$str.'</h'.$type.'>';
	}	

	// Function: font()
	// İşlev: Metne renk, biçim ve boyut eklemek için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function font($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<font'.$this->attributes($attributes).'>'.$str.'</font>';
	}	

	// Function: parag()
	// İşlev: Html <p> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function parag($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return	'<p'.$this->attributes($attributes).'>'.$str.'</p>';
	}

	// Function: bold()
	// İşlev: Html <b> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function bold($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<bold'.$this->attributes($attributes).'>'.$str.'</bold>';
	}

	// Function: strong()
	// İşlev: Html <strong> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function strong($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<strong'.$this->attributes($attributes).'>'.$str.'</strong>';
	}

	// Function: italic()
	// İşlev: Html <i> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function italic($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<em'.$this->attributes($attributes).'>'.$str.'</em>';
	}

	// Function: underLine()
	// İşlev: Html <u> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function underLine($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<u'.$this->attributes($attributes).'>'.$str.'</u>';
	}

	// Function: overLine()
	// İşlev: Html <del> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function overLine($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<del'.$this->attributes($attributes).'>'.$str.'</del>';
	}

	// Function: overText()
	// İşlev: Html <sup> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function overText($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<sup'.$this->attributes($attributes).'>'.$str.'</sup>';
	}

	// Function: underText()
	// İşlev: Html <sub> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function underText($str = '', $attributes = "")
	{
		if( ! isValue($str) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'str'));
		}
		
		return '<sub'.$this->attributes($attributes).'>'.$str.'</sub>';
	}

	// Function: space()
	// İşlev: İstenilen sayıda boşluk eklemek için kullanılır.
	// Parametreler
	// @count = Boşluk sayısı.
	public function space($count = 5)
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
	public function anchor($url = '', $value = '', $_attributes = '')
	{
		if( ! is_string($url) )
		{
			return Error::set(lang('Error', 'valueParameter', 'url'));
		}
		
		if( ! isValue($value) ) 
		{
			return Error::set(lang('Error', 'valueParameter', 'value'));
		}
		
		if( ! isUrl($url) && ! strstr($url, '#'))
		{ 
			$url = siteUrl($url);
		}
		
		if( empty($value) )
		{ 
			$value = $url;
		}
		
		return '<a'.$this->attributes($_attributes).' href="'.$url.'">'.$value.'</a>';	
	}

	// Function: mailTo()
	// İşlev: Html <a> etiketini uygulamak için kullanılır.
	// Parametreler
	// @mail = E-posta adresi.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function mailTo($mail = '', $_attributes = '')
	{
		if( ! is_string($mail) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'mail'));
		}
		
		if( ! isEmail($mail) ) 
		{
			return Error::set(lang('Error', 'emailParameter', 'mail'));
		}
		
		return '<a'.$this->attributes($_attributes).' href="mailto:'.$mail.'">'.$mail.'</a>';	
	}

	// Function: image()
	// İşlev: Html <img> etiketini uygulamak için kullanılır.
	// Parametreler
	// @src = Resmin kaynağı.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function image($src = '', $_attributes = '')
	{
		if( ! is_string($src) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'src'));
		}
		
		if( ! isUrl($src) ) 
		{
			$src = baseUrl($src);
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
		
		return '<img src="'.$src.'"'.$this->attributes($_attributes).' '.$title.' '.$alt.' />';	
	}

	// Function: br()
	// İşlev: Html <br> etiketini uygulamak için kullanılır.
	// Parametreler
	// @count = Kaç alt satır bırakılacağı.
	public function br($count = 1)
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
	public function meta($name = '', $content = '' ,$type = 'name')
	{
		if( ! is_string($type) )
		{
			$type = 'name';
		}
		
		if( ! isValue($content) ) 
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
			
			foreach( $name as $val )
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