<?php
namespace ZN\ViewObjects;

class InternalHTML implements HTMLInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Common
	//----------------------------------------------------------------------------------------------------
	// 
	// attributes()
	// _input()
	//
	//----------------------------------------------------------------------------------------------------
	use Common\HyperTextTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Media Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* AUDIO                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <audio></audio> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. string var @content => HTML nesnesinin içeriği belirtilir.	  				          |
	| 3. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: audio('http://www.ornek.com/kaynak', 'İçerik', array('name' => 'nesne'))|
	| // <audio src="http://www.ornek.com/kaynak" name="nesne">İçerik</audio>				  | 
	|          																				  |
	******************************************************************************************/
	public function audio($src = "", $content = "", $attributes = [])
	{
		return $this->_mediaContent($src, $content, $_attributes, 'audio');
	}
	
	/******************************************************************************************
	* VIDEO                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <video></video> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 3 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. string var @content => HTML nesnesinin içeriği belirtilir.	  				          |
	| 3. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: video('http://www.ornek.com/kaynak', 'İçerik', array('name' => 'nesne'))|
	| // <video src="http://www.ornek.com/kaynak" name="nesne">İçerik</video>				  | 
	|          																				  |
	******************************************************************************************/
	public function video($src = "", $content = "", $attributes = [])
	{
		return $this->_mediaContent($src, $content, $_attributes, 'video');
	}
	
	/******************************************************************************************
	* EMBED                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <embed></embed> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: embed('http://www.ornek.com/kaynak', array('name' => 'nesne'));         |
	| // <embed src="http://www.ornek.com/kaynak" name="nesne">								  | 
	|          																				  |
	******************************************************************************************/ 
	public function embed($src = "", $_attributes = '')
	{
		return $this->_media($src, $_attributes, 'embed');
	}
	
	/******************************************************************************************
	* SOURCE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <source></source> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @src => HTML nesnesinin kaynağı belirtilir.	  				              |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: source('http://www.ornek.com/kaynak', array('name' => 'nesne'));        |
	| // <source src="http://www.ornek.com/kaynak" name="nesne">							  | 
	|          																				  |
	******************************************************************************************/
	public function source($src = "", $_attributes = [])
	{
		return $this->_media($src, $_attributes, 'source');
	}
	
	// HTML5 medya nesneleri için
	protected function _media($src, $_attributes, $type)
	{
		if( ! is_string($src) )  
		{
			$src = '';
		}
		
		return '<'.$type.'src="'.$src.'"'.$this->attributes($_attributes).'>'.EOL;
	}
	
	// HTML5 içerik eklenebilir medya nesneleri için.
	protected function _mediaContent($src, $content, $_attributes, $type)
	{
		if( ! is_string($src) )  
		{
			$src = '';
		}
		
		if( ! is_scalar($content) )  
		{
			$content = '';
		}
		
		return '<'.$type.'src="'.$src.'"'.$this->attributes($_attributes).'>'.$content."</$type>".EOL;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Media Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Designer Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	// Function: bold()
	// İşlev: Html <b> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function bold($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<b'.$this->attributes($attributes).'>'.$str.'</b>';
	}
	
	// Function: strong()
	// İşlev: Html <strong> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function strong($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<strong'.$this->attributes($attributes).'>'.$str.'</strong>';
	}
	
	// Function: italic()
	// İşlev: Html <i> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function italic($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<em'.$this->attributes($attributes).'>'.$str.'</em>';
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
			return \Errors::set('Error', 'stringParameter', 'src');
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
	
	//----------------------------------------------------------------------------------------------------
	// Label
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string $for
	// @param  string $value
	// @param  string $form
	// @param  array  $_attributes
	// @return string
	//
	//----------------------------------------------------------------------------------------------------
	public function label($for = '', $value = '', $form = '', $_attributes = [])
	{
		if( ! empty($for) ) 
		{
			$for = ' for="'.$for.'"';
		}
		
		if( ! empty($form) ) 
		{
			$form = ' form="'.$form.'"';
		}
		
		return '<label'.$for.$form.$this->attributes($_attributes).'>'.$value.'</label>';
	}
	
	/******************************************************************************************
	* CANVAS                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <canvas></canvas> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: canvas('İçerik', array('name' => 'nesne'));          					  |
	| // <canvas name="nesne">İçerik</canvas>											      | 
	|          																				  |
	******************************************************************************************/
	public function canvas($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'canvas');
	}
	
	/******************************************************************************************
	* ASIDE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <aside></aside> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: aside('İçerik');          											  |
	| // <aside>İçerik</aside>											       	              | 
	|          																				  |
	******************************************************************************************/
	public function aside($html = "")
	{
		return $this->_content($html, 'aside');
	}
	
	/******************************************************************************************
	* ARTICLE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <article></article> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: article('İçerik');          											  |
	| // <article>İçerik</article>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function article($html = "")
	{
		return $this->_content($html, 'article');
	}
	
	/******************************************************************************************
	* FOOTER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <footer></footer> tagının kullanımıdır.    			          	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: footer('İçerik');          											  |
	| // <footer>İçerik</footer>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function footer($html = "")
	{
		return $this->_content($html, 'footer');
	}
	
	/******************************************************************************************
	* HEADER                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <header></header> tagının kullanımıdır.    			          	  |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: header('İçerik');          											  |
	| // <header>İçerik</header>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function header($html = "")
	{
		return $this->_content($html, 'header');
	}
	
	/******************************************************************************************
	* NAV                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Html <nav></nav> tagının kullanımıdır.    			          	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: footer('İçerik');          											  |
	| // <nav>İçerik</nav>											       	          		  | 
	|          																				  |
	******************************************************************************************/
	public function nav($html = "")
	{
		return $this->_content($html, 'nav');
	}	
	
	/******************************************************************************************
	* SECTION                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <section></section> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: section('İçerik');          											  |
	| // <section>İçerik</section>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function section($html = "")
	{
		return $this->_content($html, 'section');
	}
	
	//----------------------------------------------------------------------------------------------------
	// Designer Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Link Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	// Function: anchor()
	// İşlev: Html <a> etiketini uygulamak için kullanılır
	// Parametreler
	// @url = Köprüye tıklanınca gidilecek url adresi.
	// @value = Köprünün görünen değeri.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function anchor($url = '', $value = '', $_attributes = [])
	{
		if( ! is_string($url) )
		{
			return \Errors::set('Error', 'valueParameter', 'url');
		}
		
		if( ! is_scalar($value) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'value');
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
			return \Errors::set('Error', 'stringParameter', 'mail');
		}
		
		if( ! isEmail($mail) ) 
		{
			return \Errors::set('Error', 'emailParameter', 'mail');
		}
		
		return '<a'.$this->attributes($_attributes).' href="mailto:'.$mail.'">'.$mail.'</a>';	
	}
	
	//----------------------------------------------------------------------------------------------------
	// Link Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Text Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	// Function: parag()
	// İşlev: Html <p> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function parag($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return	'<p'.$this->attributes($attributes).'>'.$str.'</p>';
	}
	
	// Function: overLine()
	// İşlev: Html <del> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function overLine($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<del'.$this->attributes($attributes).'>'.$str.'</del>';
	}
	
	// Function: overText()
	// İşlev: Html <sup> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function overText($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<sup'.$this->attributes($attributes).'>'.$str.'</sup>';
	}
	
	// Function: underLine()
	// İşlev: Html <u> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function underLine($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<u'.$this->attributes($attributes).'>'.$str.'</u>';
	}
	
	// Function: underText()
	// İşlev: Html <sub> etiketini uygulamak için kullanılır
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function underText($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<sub'.$this->attributes($attributes).'>'.$str.'</sub>';
	}
	
	// Function: font()
	// İşlev: Metne renk, biçim ve boyut eklemek için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function font($str = '', $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<font'.$this->attributes($attributes).'>'.$str.'</font>';
	}	
	
	/******************************************************************************************
	* HGROUP                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <hgroup></hgroup> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	|          																				  |
	| Örnek Kullanım: hgroup('İçerik');          											  |
	| // <hgroup>İçerik</hgroup>											       	          | 
	|          																				  |
	******************************************************************************************/
	public function hgroup($html = "")
	{
		return $this->_content($html, 'hgroup');
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
	
	// Function: heading()
	// İşlev: Başlık etiketi uygulamak için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @type = Uygulanacak olan başlık etiketinin türü. h1, h2, h3...
	// @attributes = Etikete özellik değer çifti eklemek için kullanılır.
	// Dönen Değer: Etiketin uygulanmış hali.
	public function heading($str = '', $type = 3, $attributes = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		if( ! is_numeric($type) ) 
		{
			$type = 3;
		}
		
		return '<h'.$type.$this->attributes($attributes).'>'.$str.'</h'.$type.'>';
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Text Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Element Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	// Function: html_element()
	// İşlev: Herhangi bir html elemanını oluşturmak için kullanılır.
	// Parametreler
	// @element = Hangi html elemanı kullanılacağı. Örnek: strong
	// @str = Html etiketinin uygulanacağı veri. Örnek: veri
	// @attributes = Etikete uygulanacak özellik değer çiftleri. array("id" => "12")
	// Dönen Değer: <strong id="12>veri</strong>
	public function element($element = '', $str = '', $attributes = [])
	{
		if( ! is_scalar($element) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'element');	
		}
		
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
		}
		
		return '<'.$element.$this->attributes($attributes).'>'.$str.'</'.$element.'>';
	}
	
	//----------------------------------------------------------------------------------------------------
	// Element Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

	// Function: multiAttr()
	// İşlev: Bir veriye birden fazla html etiketi uygulamak için kullanılır.
	// Parametreler
	// @str = Özelliklerin uygulanacağı metin.
	// @array = Uygulanacak html etikeleri. array("b", "i" => array("id" => 2))
	// Dönen Değer: Etiketlerin uygulanmış hali.
	public function multiAttr($str = '', $array = [])
	{
		if( ! is_scalar($str) ) 
		{
			return \Errors::set('Error', 'valueParameter', 'str');
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
		
		if( ! is_scalar($content) ) 
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
	
	/******************************************************************************************
	* COMMAND                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <command></command> tagının kullanımıdır.    			      	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: command('İçerik', array('name' => 'nesne'));          				  |
	| // <command name="nesne">İçerik</command>										 		  | 
	|          																				  |
	******************************************************************************************/ 
	public function command($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'command');
	}
	
	/******************************************************************************************
	* DATALIST                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <datalist></datalist> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: dataList('İçerik', array('name' => 'nesne'));          				  |
	| // <datalist name="nesne">İçerik</datalist>											  | 
	|          																				  |
	******************************************************************************************/
	public function dataList($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'datalist');
	}
	
	/******************************************************************************************
	* DETAILS                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <details></details> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: details('İçerik', array('name' => 'nesne'));          				  |
	| // <details name="nesne">İçerik</details>											      | 
	|          																				  |
	******************************************************************************************/
	public function details($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'details');
	}
	
	/******************************************************************************************
	* DIALOG                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <dialog></dialog> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: dialog('İçerik', array('name' => 'nesne'));          				  	  |
	| // <dialog name="nesne">İçerik</dialog>										 		  | 
	|          																				  |
	******************************************************************************************/ 
	public function dialog($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'dialog');
	}
	
	/******************************************************************************************
	* FIGCAPTION                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Html <figcaption></figcaption> tagının kullanımıdır.    			      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: figCaption('İçerik', array('name' => 'nesne'));          				  |
	| // <figcaption name="nesne">İçerik</figcaption>										  | 
	|          																				  |
	******************************************************************************************/
	public function figCaption($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'figcaption');
	}
	
	/******************************************************************************************
	* FIGURE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <figure></figure> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: figure('İçerik', array('name' => 'nesne'));          				      |
	| // <figure name="nesne">İçerik</figure>											      | 
	|          																				  |
	******************************************************************************************/
	public function figure($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'figure');
	}
	
	/******************************************************************************************
	* KEYGEN                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <keygen></keygen> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: Tek parametresi vardır.		                                              |
	| 1. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: keygen(array('name' => 'nesne'));          				  			  |
	| // <keygen name="nesne">										 	  				      | 
	|          																				  |
	******************************************************************************************/ 
	public function keygen($_attributes = '')
	{
		return '<keygen'.$this->attributes($_attributes).'>'.EOL;
	}
	
	/******************************************************************************************
	* MARK                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <mark></mark> tagının kullanımıdır.    			      			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: mark('İçerik', array('name' => 'nesne'));          				  	  |
	| // <mark name="nesne">İçerik</mark>										 			  | 
	|          																				  |
	******************************************************************************************/
	public function mark($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'mark');
	}
	
	/******************************************************************************************
	* METER                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Html <meter></meter> tagının kullanımıdır.    			      	      |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: meter('İçerik', array('name' => 'nesne'));          				      |
	| // <meter name="nesne">İçerik</meter>										 		      | 
	|          																				  |
	******************************************************************************************/ 
	public function meter($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'meter');
	}
	
	/******************************************************************************************
	* TIME                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Html <time></time> tagının kullanımıdır.    			      			  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: time('İçerik', array('name' => 'nesne'));          				  	  |
	| // <time name="nesne">İçerik</time>										 			  | 
	|          																				  |
	******************************************************************************************/ 
	public function time($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'time');
	}
	
	/******************************************************************************************
	* SUMMARY                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Html <summary></summary> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: summary('İçerik', array('name' => 'nesne'));          				  |
	| // <summary name="nesne">İçerik</summary>											      | 
	|          																				  |
	******************************************************************************************/
	public function summary($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'summary');
	}
	
	/******************************************************************************************
	* PROGRESS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Html <progress></progress> tagının kullanımıdır.    			      	  |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: progress('İçerik', array('name' => 'nesne'));          				  |
	| // <progress name="nesne">İçerik</progress>										 	  | 
	|          																				  |
	******************************************************************************************/ 
	public function progress($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'progress');
	}
	
	/******************************************************************************************
	* OUTPUT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Html <output></output> tagının kullanımıdır.    			              |
	|															                              |
	| Parametreler: 2 parametresi vardır.		                                              |
	| 1. string var @html => HTML nesnesinin içeriği belirtilir.	  				          |
	| 2. array var @attributes => HTML nesnesinin özellik ve değerleri.	  				      |
	|          																				  |
	| Örnek Kullanım: output('İçerik', array('name' => 'nesne'));          				      |
	| // <output name="nesne">İçerik</output>											      | 
	|          																				  |
	******************************************************************************************/
	public function output($content = "", $_attributes = '')
	{
		return $this->_contentAttribute($content, $_attributes, 'output');
	}
	
	// İçerik girilir tipteki html5 nesneleri için
	protected function _content($html, $type)
	{
		if( ! is_scalar($html) )  
		{
			$html = '';
		}
		
		$str = "<$type>$html</$type>";
		
		return $str;
	}
	
	// içerik ve özellik eklenebilir HTML5 nesneleri için
	protected function _contentAttribute($content, $_attributes, $type)
	{
		if( ! is_scalar($content) )  
		{
			$content = '';
		}
		
		return '<'.$type.$this->attributes($_attributes).'>'.$content."</$type>".EOL;
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Other Methods Bitiş
	//----------------------------------------------------------------------------------------------------
}