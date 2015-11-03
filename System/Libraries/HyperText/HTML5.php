<?php
class __USE_STATIC_ACCESS__HTML5
{
	/***********************************************************************************/
	/* HTML5 LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: HTML5
	/* Versiyon: 1.2
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: html5::, $this->html5, zn::$use->html5, uselib('html5')
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
		die(getErrorMessage('Error', 'undefinedFunction', "HTML5::$method()"));	
	}

	// Form Input Nesneleri
	protected function _input($name = "", $value = "", $_attributes = '', $type = '')
	{
		if( ! is_string($name) ) 
		{
			$name = '';
		}
		
		if( ! isValue($value) ) 
		{
			$value = '';		
		}
		
		$value = ( ! empty($value)) 
				 ? 'value="'.$value.'"' 
				 : "";
		
		// Herhangi bir id değeri tanımlanmamışsa
		// Id değeri olarak isim bilgisini kullan.
		$id = ( isset($_attributes["id"]) ) 
			  ? $_attributes["id"] 
			  : $name;
		
		// Id değer tanımlanmışsa
		// Id değeri olarak tanımalanan değeri kullan.
		$id_txt = ( isset($_attributes["id"]) ) 
			      ? ''
			      : "id=\"$id\"";
	
		return '<input type="'.$type.'" name="'.$name.'" '.$id_txt.' '.$value.Html::attributes($_attributes).'>'.eol();
	}
	
	/******************************************************************************************
	* INPUT OBJECT                                                                            *
	*******************************************************************************************
	| Genel Kullanım: Html <input type="xxxx"> tagının kullanımıdır.    			          |
	|															                              |
	| Parametreler: 4 parametresi vardır.		                                              |
	| 1. string var @type => Form nesnesinin türü belirtilir.	  				              |
	| 2. string var @name => Form nesnesinin ismi belirtilir.	  				              |
	| 3. string var @name => Form nesnesinin değerini belirtilir.	  				          |
	| 4. array var @attributes => Form nesnesine farklı özellik değer çifti belirtmek içindir.|
	|          																				  |
	| Örnek Kullanım: inputObject('text', 'nesne', 'Değer', array('style' => 'color:red'));  |
	| // <input type="text" name="nesne" value="Değer" style="color:red">       	          | 
	|          																				  |
	******************************************************************************************/
	public function input($type = "", $name = "", $value = "", $_attributes = '')
	{
		return $this->_input($name, $value, $_attributes, $type);
	}
	
	// İçerik girilir tipteki html5 nesneleri için
	protected function _content($html, $type)
	{
		if( ! isValue($html) )  
		{
			$html = '';
		}
		
		$str = "<$type>$html</$type>";
		
		return $str;
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
	
	// içerik ve özellik eklenebilir HTML5 nesneleri için
	protected function _contentAttribute($content, $_attributes, $type)
	{
		if( ! isValue($content) )  
		{
			$content = '';
		}
		
		return '<'.$type.Html::attributes($_attributes).'>'.$content."</$type>".eol();
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
		return '<keygen'.Html::attributes($_attributes).'>'.eol();
	}
	
	// HTML5 medya nesneleri için
	protected function _media($src, $_attributes, $type)
	{
		if( ! is_string($src) )  
		{
			$src = '';
		}
		
		return '<'.$type.'src="'.$src.'"'.Html::attributes($_attributes).'>'.eol();
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
	public function source($src = "", $_attributes = array())
	{
		return $this->_media($src, $_attributes, 'source');
	}
	
	// HTML5 içerik eklenebilir medya nesneleri için.
	protected function _mediaContent($src, $content, $_attributes, $type)
	{
		if( ! is_string($src) )  
		{
			$src = '';
		}
		
		if( ! isValue($content) )  
		{
			$content = '';
		}
		
		return '<'.$type.'src="'.$src.'"'.Html::attributes($_attributes).'>'.$content."</$type>".eol();
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
	public function video($src = "", $content = "", $attributes = array())
	{
		return $this->_mediaContent($src, $content, $_attributes, 'video');
	}
	
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
	public function audio($src = "", $content = "", $attributes = array(""))
	{
		return $this->_mediaContent($src, $content, $_attributes, 'audio');
	}
}